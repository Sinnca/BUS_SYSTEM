<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $upcomingReservations = $user->reservations()
            ->with(['trip.bus', 'returnTrip'])
            ->whereHas('trip', function($q) {
                $q->where('departure_date', '>=', now()->format('Y-m-d'));
            })
            ->where('status', 'confirmed')
            ->orderBy('created_at', 'desc')
            ->get();

        $pastReservations = $user->reservations()
            ->with(['trip.bus', 'returnTrip'])
            ->whereHas('trip', function($q) {
                $q->where('departure_date', '<', now()->format('Y-m-d'));
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('user.dashboard.index', compact('upcomingReservations', 'pastReservations'));
    }

    public function bookings()
    {
        $reservations = auth()->user()
            ->reservations()
            ->with(['trip.bus', 'returnTrip', 'reservedSeats'])
            ->latest()
            ->paginate(10);

        return view('user.dashboard.bookings', compact('reservations'));
    }
}
