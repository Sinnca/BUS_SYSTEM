<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Mail\ReservationCancelled;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\ReservedSeat;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Mail;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Show seat selection page
     * SUPPORTS ROUND TRIP
     */
    public function showSeats(Request $request, Trip $trip)
    {
        // Get search parameters from request or session
//        $search = [
//            'adults' => $request->input('adults', session('search_params.adults', 1)),
//            'children' => $request->input('children', session('search_params.children', 0)),
//            'is_round_trip' => $request->input('is_round_trip', session('search_params.is_round_trip', false)),
//        ];
//
//        // Save to session for later use
//        session(['search_params' => $search]);
        $search = [
            'adults' => $request->input('adults', session('search_params.adults', 1)),
            'children' => $request->input('children', session('search_params.children', 0)),
            'is_round_trip' => $request->input('is_round_trip', session('search_params.is_round_trip', false)),
            'origin' => $request->input('origin', session('search_params.origin', $trip->origin)),
            'destination' => $request->input('destination', session('search_params.destination', $trip->destination)),
            'departure_date' => $request->input('departure_date', session('search_params.departure_date', $trip->departure_date)),
        ];

        // Save to session for later use
        session(['search_params' => $search]);


        $totalSeats = $search['adults'] + $search['children'];

        // Check if trip has enough seats
        if ($trip->available_seats < $totalSeats) {
            return redirect()->back()
                ->with('error', 'Not enough seats available for this trip.');
        }

        // Get reserved seats for outbound trip
        $reservedSeats = ReservedSeat::where('trip_id', $trip->id)
            ->pluck('seat_number')
            ->toArray();

        // Handle round trip
        $returnTrip = null;
        $returnReservedSeats = [];

        if ($request->has('return_trip_id')) {
            $returnTrip = Trip::findOrFail($request->return_trip_id);

            // Check return trip availability
            if ($returnTrip->available_seats < $totalSeats) {
                return redirect()->back()
                    ->with('error', 'Not enough seats available on return trip.');
            }

            // Get reserved seats for return trip
            $returnReservedSeats = ReservedSeat::where('trip_id', $returnTrip->id)
                ->pluck('seat_number')
                ->toArray();
        }

        return view('user.booking.seat-selection', compact(
            'trip',
            'search',
            'reservedSeats',
            'returnTrip',
            'returnReservedSeats'
        ));
    }

    /**
     * Store reservation
     * SUPPORTS ROUND TRIP
     */
    public function store(ReservationRequest $request)
    {
        try {
            $reservation = $this->bookingService->createReservation($request->validated());

            // Redirect to payment page instead of confirmation
            return redirect()->route('payment.page', $reservation->id)
                ->with('success', 'Reservation pending. Please complete payment.');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show booking confirmation
     * SUPPORTS ROUND TRIP
     */
    public function confirmation($id)
    {
        $reservation = auth()->user()
            ->reservations()
            ->with(['trip.bus', 'returnTrip.bus', 'reservedSeats'])
            ->findOrFail($id);

        return view('user.booking.confirmation', compact('reservation'));
    }

    /**
     * Cancel reservation
     * SUPPORTS ROUND TRIP - Cancels both trips if round trip
     */
    public function cancel(Request $request, $id)
    {
        // Find reservation for the logged-in user
        $reservation = Reservation::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Prevent cancellation if trip already departed
        if ($reservation->trip->departure_date <= now()->toDateString()) {
            return back()->with('error', 'You can no longer cancel this reservation.');
        }

        // Prevent double cancellation
        if ($reservation->status === 'cancelled') {
            return back()->with('error', 'Reservation is already cancelled.');
        }

        // Restore seats for OUTBOUND trip
        $this->restoreSeatsForTrip($reservation->trip_id, $reservation->id);

        // Restore seats for RETURN trip (if round trip)
        if ($reservation->return_trip_id) {
            $this->restoreSeatsForTrip($reservation->return_trip_id, $reservation->id);
        }

        // Update reservation status
        $reservation->status = 'cancelled';
        $reservation->save();

        // Send cancellation email
        try {
            Mail::to($reservation->user->email)
                ->send(new ReservationCancelled($reservation));
        } catch (\Exception $e) {
            // Log email error but don't fail the cancellation
            \Log::error('Failed to send cancellation email: ' . $e->getMessage());
        }

        return back()->with('success', 'Your reservation has been cancelled successfully.');
    }

    /**
     * Helper method to restore seats for a specific trip
     */
    private function restoreSeatsForTrip($tripId, $reservationId)
    {
        // Get all reserved seats for this trip and reservation
        $reservedSeats = ReservedSeat::where('trip_id', $tripId)
            ->where('reservation_id', $reservationId)
            ->get();

        // Count seats to restore
        $seatCount = $reservedSeats->count();

        // Delete reserved seat records
        foreach ($reservedSeats as $seat) {
            $seat->delete();
        }

        // Restore available seats on the trip
        $trip = Trip::find($tripId);
        if ($trip) {
            $trip->available_seats += $seatCount;
            $trip->save();
        }
    }

    /**
     * List all reservations for the logged-in user
     * Supports optional filtering by status
     */
    public function index(Request $request)
    {
        // Start a query for the current user's reservations
        $query = Reservation::where('user_id', auth()->id())
            ->with(['trip.bus', 'returnTrip.bus', 'reservedSeats']);

        // Apply status filter if provided
        if ($request->has('status') && in_array($request->status, ['pending', 'confirmed', 'cancelled'])) {
            $query->where('status', $request->status);
        }

        // Order by latest booking first
        $reservations = $query->orderBy('created_at', 'desc')->paginate(10);

        // Return view with paginated results
        return view('user.dashboard.bookings', compact('reservations'));
    }

}
