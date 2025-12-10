<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'trip.bus', 'returnTrip']);

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search by reservation code or user name
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('reservation_code', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $reservations = $query->latest()->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'trip.bus', 'returnTrip', 'reservedSeats']);
        return view('admin.reservations.show', compact('reservation'));
    }
}
