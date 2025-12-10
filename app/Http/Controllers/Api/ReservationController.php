<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\BookingService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Get user's reservations
     * GET /api/reservations
     */
    public function index(Request $request)
    {
        $reservations = $request->user()
            ->reservations()
            ->with(['trip.bus', 'returnTrip.bus', 'reservedSeats'])
            ->latest()
            ->get();

        return response()->json([
            'reservations' => $reservations->map(function($reservation) {
                return [
                    'id' => $reservation->id,
                    'reservation_code' => $reservation->reservation_code,
                    'trip' => [
                        'id' => $reservation->trip->id,
                        'origin' => $reservation->trip->origin,
                        'destination' => $reservation->trip->destination,
                        'departure_date' => $reservation->trip->departure_date->format('Y-m-d'),
                        'departure_time' => $reservation->trip->formatted_time,
                        'bus_number' => $reservation->trip->bus->bus_number,
                    ],
                    'return_trip' => $reservation->returnTrip ? [
                        'id' => $reservation->returnTrip->id,
                        'origin' => $reservation->returnTrip->origin,
                        'destination' => $reservation->returnTrip->destination,
                        'departure_date' => $reservation->returnTrip->departure_date->format('Y-m-d'),
                        'departure_time' => $reservation->returnTrip->formatted_time,
                    ] : null,
                    'seats' => $reservation->reservedSeats->pluck('seat_number'),
                    'passengers' => [
                        'adults' => $reservation->adults,
                        'children' => $reservation->children,
                        'names' => $reservation->passenger_names,
                    ],
                    'total_price' => $reservation->total_price,
                    'status' => $reservation->status,
                    'created_at' => $reservation->created_at->toDateTimeString(),
                ];
            }),
        ]);
    }

    /**
     * Create new reservation
     * POST /api/reservations
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'return_trip_id' => 'nullable|exists:trips,id',
            'seat_numbers' => 'required|array|min:1',
            'seat_numbers.*' => 'required|integer|min:1',
            'return_seat_numbers' => 'nullable|array',
            'return_seat_numbers.*' => 'nullable|integer|min:1',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'nullable|integer|min:0|max:10',
            'passenger_names' => 'required|array',
            'passenger_names.*' => 'required|string|max:100',
        ]);

        try {
            // Store in session for BookingService
            session([
                'search_params' => [
                    'adults' => $validated['adults'],
                    'children' => $validated['children'] ?? 0,
                ],
            ]);

            $reservation = $this->bookingService->createReservation($validated);

            return response()->json([
                'message' => 'Reservation created successfully',
                'reservation' => [
                    'id' => $reservation->id,
                    'reservation_code' => $reservation->reservation_code,
                    'total_price' => $reservation->total_price,
                    'status' => $reservation->status,
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Reservation failed',
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Get single reservation
     * GET /api/reservations/{id}
     */
    public function show(Request $request, $id)
    {
        $request->headers->set('Accept', 'application/json');

        $reservation = $request->user()
            ->reservations()
            ->with(['trip.bus', 'returnTrip.bus', 'reservedSeats'])
            ->findOrFail($id);

        return response()->json([
            'reservation' => [
                'id' => $reservation->id,
                'reservation_code' => $reservation->reservation_code,
                'trip' => [
                    'origin' => $reservation->trip->origin,
                    'destination' => $reservation->trip->destination,
                    'departure_date' => $reservation->trip->formatted_date,
                    'departure_time' => $reservation->trip->formatted_time,
                    'bus' => $reservation->trip->bus->bus_number,
                ],
                'seats' => $reservation->reservedSeats->where('trip_id', $reservation->trip_id)->pluck('seat_number'),
                'passenger_names' => $reservation->passenger_names,
                'total_price' => $reservation->total_price,
                'status' => $reservation->status,
            ],
        ]);
    }

    /**
     * Cancel reservation
     * DELETE /api/reservations/{id}
     */
    public function destroy(Request $request, $id)
    {
        $reservation = $request->user()
            ->reservations()
            ->findOrFail($id);

        try {
            $this->bookingService->cancelReservation($reservation);

            return response()->json([
                'message' => 'Reservation cancelled successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Cancellation failed',
                'error' => $e->getMessage(),
            ], 422);
        }
    }
}
