<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Trip;
use App\Models\ReservedSeat;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function showSeats(Trip $trip)
    {
        $search = session('search_params', [
            'adults' => 1,
            'children' => 0,
        ]);

        $totalSeats = $search['adults'] + $search['children'];

        // Check if trip has enough seats
        if ($trip->available_seats < $totalSeats) {
            return redirect()->back()
                ->with('error', 'Not enough seats available for this trip.');
        }

        // Get reserved seats for this trip
        $reservedSeats = ReservedSeat::where('trip_id', $trip->id)
            ->pluck('seat_number')
            ->toArray();

        return view('user.booking.seat-selection', compact('trip', 'search', 'reservedSeats'));
    }

    public function store(ReservationRequest $request)
    {
        try {
            $reservation = $this->bookingService->createReservation($request->validated());

            return redirect()->route('booking.confirmation', $reservation->id)
                ->with('success', 'Booking confirmed successfully!');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function confirmation($id)
    {
        $reservation = auth()->user()
            ->reservations()
            ->with(['trip.bus', 'returnTrip.bus', 'reservedSeats'])
            ->findOrFail($id);

        return view('user.booking.confirmation', compact('reservation'));
    }
}
