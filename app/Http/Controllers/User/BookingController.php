<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
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

//    public function showSeats(Trip $trip)
//    {
//        $search = session('search_params', [
//            'adults' => 1,
//            'children' => 0,
//        ]);
//
//        $totalSeats = $search['adults'] + $search['children'];
//
//        // Check if trip has enough seats
//        if ($trip->available_seats < $totalSeats) {
//            return redirect()->back()
//                ->with('error', 'Not enough seats available for this trip.');
//        }
//
//        // Get reserved seats for this trip
//        $reservedSeats = ReservedSeat::where('trip_id', $trip->id)
//            ->pluck('seat_number')
//            ->toArray();
//
//        return view('user.booking.seat-selection', compact('trip', 'search', 'reservedSeats'));
//    }
    public function showSeats(Request $request, Trip $trip)
    {
        // Get adults and children from request or session defaults
        $search = [
            'adults' => $request->input('adults', session('search_params.adults', 1)),
            'children' => $request->input('children', session('search_params.children', 0)),
        ];

        // Save current search to session for later use (optional)
        session(['search_params' => $search]);

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

            // Redirect to payment page instead of confirmation
            return redirect()->route('payment.page', $reservation->id)
                ->with('success', 'Reservation pending, Please complete payment.');

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

    /**
     * @throws \Exception
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

        // Restore available seats (update ReservedSeat or Trip table)
        $reservedSeats = $reservation->reservedSeats; // relationship
        $trip = $reservation->trip;

        foreach ($reservedSeats as $seat) {
            $seat->delete(); // remove reserved seat
            $trip->available_seats += 1;
        }
        $trip->save();

        // Update reservation status
        $reservation->status = 'cancelled';
        $reservation->save();

        // TODO: Send cancellation email via Mailtrap (next step)

        return back()->with('success', 'Your reservation has been cancelled.');
    }
}
