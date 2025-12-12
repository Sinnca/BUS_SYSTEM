<?php

namespace App\Services;

use App\Models\Trip;
use App\Models\Reservation;
use App\Models\ReservedSeat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Create a new reservation with transaction safety
     * Prevents double-booking and race conditions
     *
     * @param array $data
     * @return Reservation
     * @throws \Exception
     */
    public function createReservation(array $data): Reservation
    {
        return DB::transaction(function () use ($data) {
            // Step 1: Lock the trip row to prevent concurrent bookings
            $trip = Trip::lockForUpdate()->findOrFail($data['trip_id']);

            // Step 2: Get search parameters from session
            $search = session('search_params', []);
            $totalPassengers = ($search['adults'] ?? $data['adults'] ?? 1) + ($search['children'] ?? $data['children'] ?? 0);

            // Step 3: Validate seat availability
            if ($trip->available_seats < $totalPassengers) {
                throw new \Exception('Not enough seats available. Only ' . $trip->available_seats . ' seats left.');
            }

            // Step 4: Check for seat conflicts
            $this->checkSeatConflicts($trip->id, $data['seat_numbers']);

            // Step 5: Calculate total price
            $totalPrice = $trip->price * $totalPassengers;

            // Step 6: Handle return trip if round trip
            $returnTrip = null;
            if (isset($data['return_trip_id']) && $data['return_trip_id']) {
                $returnTrip = Trip::lockForUpdate()->findOrFail($data['return_trip_id']);

                if ($returnTrip->available_seats < $totalPassengers) {
                    throw new \Exception('Not enough seats available on return trip.');
                }

                if (isset($data['return_seat_numbers']) && !empty($data['return_seat_numbers'])) {
                    $this->checkSeatConflicts($returnTrip->id, $data['return_seat_numbers']);
                }

                $totalPrice += $returnTrip->price * $totalPassengers;
            }

            // Step 7: Create main reservation
            $reservation = Reservation::create([
                'user_id' => auth()->id(),
                'trip_id' => $trip->id,
                'return_trip_id' => $data['return_trip_id'] ?? null,
                'reservation_code' => $this->generateReservationCode(),
                'adults' => $search['adults'] ?? $data['adults'] ?? 1,
                'children' => $search['children'] ?? $data['children'] ?? 0,
                'total_price' => $totalPrice,
//                'status' => 'confirmed',
                'status' => 'pending',
                'passenger_names' => $data['passenger_names'],
            ]);

            // Step 8: Reserve seats for outbound trip
            $this->reserveSeats($trip->id, $data['seat_numbers'], $reservation->id);

            // Step 9: Update trip capacity
            $trip->decrement('available_seats', $totalPassengers);

            // Step 10: Handle return trip seats
            if ($returnTrip && isset($data['return_seat_numbers']) && !empty($data['return_seat_numbers'])) {
                $this->reserveSeats($returnTrip->id, $data['return_seat_numbers'], $reservation->id);
                $returnTrip->decrement('available_seats', $totalPassengers);
            }

            // Step 11: Clear search session
            session()->forget('search_params');

            return $reservation->fresh(['trip', 'returnTrip', 'reservedSeats']);
        });
    }


    /**
     * Check if any seats are already reserved
     * Throws exception if conflict found
     *
     * @param int $tripId
     * @param array $seatNumbers
     * @return void
     * @throws \Exception
     */
    protected function checkSeatConflicts(int $tripId, array $seatNumbers): void
    {
        $conflictingSeats = ReservedSeat::where('trip_id', $tripId)
            ->whereIn('seat_number', $seatNumbers)
            ->pluck('seat_number')
            ->toArray();

        if (!empty($conflictingSeats)) {
            throw new \Exception(
                'Seats ' . implode(', ', $conflictingSeats) . ' are already reserved. Please select different seats.'
            );
        }
    }

    /**
     * Reserve multiple seats for a trip
     *
     * @param int $tripId
     * @param array $seatNumbers
     * @param int $reservationId
     * @return void
     */
    protected function reserveSeats(int $tripId, array $seatNumbers, int $reservationId): void
    {
        foreach ($seatNumbers as $seatNumber) {
            ReservedSeat::create([
                'trip_id' => $tripId,
                'seat_number' => $seatNumber,
                'reservation_id' => $reservationId,
            ]);
        }
    }

    /**
     * Generate unique reservation code
     *
     * @return string
     */
    protected function generateReservationCode(): string
    {
        do {
            $code = 'BUS' . strtoupper(Str::random(6));
        } while (Reservation::where('reservation_code', $code)->exists());

        return $code;
    }

    /**
     * Cancel a reservation and return seats
     *
     * @param Reservation $reservation
     * @return bool
     * @throws \Exception
     */
    public function cancelReservation(Reservation $reservation): bool
    {
        return DB::transaction(function () use ($reservation) {

            $departure = \Carbon\Carbon::parse($reservation->trip->departure_date . ' ' . $reservation->trip->departure_time);
            $now = now();
            $diffHours = $now->diffInHours($departure, false);

            // Prevent cancellation if less than 24 hours before departure
            if ($diffHours < 24) {
                throw new \Exception('You can only cancel reservations at least 24 hours before departure.');
            }

            // Check if trip hasn't departed (optional, extra safety)
            if ($departure->isPast()) {
                throw new \Exception('Cannot cancel past trips.');
            }

            // Check if already cancelled
            if ($reservation->status === 'cancelled') {
                throw new \Exception('This reservation is already cancelled.');
            }

            // Update reservation status
            $reservation->update(['status' => 'cancelled']);

            // Return seats to trip
            $totalSeats = $reservation->total_passengers;
            $reservation->trip->increment('available_seats', $totalSeats);

            // Return seats for return trip if exists
            if ($reservation->return_trip_id) {
                $reservation->returnTrip->increment('available_seats', $totalSeats);
            }

            return true;
        });
    }



    /**
     * Get available seats for a trip
     * Returns array of seat numbers
     *
     * @param Trip $trip
     * @return array
     */
    public function getAvailableSeats(Trip $trip): array
    {
        $reservedSeats = ReservedSeat::where('trip_id', $trip->id)
            ->pluck('seat_number')
            ->toArray();

        $allSeats = range(1, $trip->bus->capacity);

        return array_values(array_diff($allSeats, $reservedSeats));
    }

    /**
     * Get reserved seats for a trip
     *
     * @param Trip $trip
     * @return array
     */
    public function getReservedSeats(Trip $trip): array
    {
        return ReservedSeat::where('trip_id', $trip->id)
            ->pluck('seat_number')
            ->toArray();
    }

    /**
     * Check if specific seats are available
     *
     * @param int $tripId
     * @param array $seatNumbers
     * @return bool
     */
    public function areSeatsAvailable(int $tripId, array $seatNumbers): bool
    {
        $reservedSeats = ReservedSeat::where('trip_id', $tripId)
            ->whereIn('seat_number', $seatNumbers)
            ->count();

        return $reservedSeats === 0;
    }

}
