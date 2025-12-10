<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\Trip;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buses' => Bus::count(),
            'active_buses' => Bus::where('status', 'active')->count(),
            'total_trips' => Trip::count(),
            'upcoming_trips' => Trip::where('departure_date', '>=', now())->count(),
            'total_reservations' => Reservation::count(),
            'confirmed_reservations' => Reservation::where('status', 'confirmed')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'revenue' => Reservation::where('status', 'confirmed')->sum('total_price'),
        ];

        $recent_reservations = Reservation::with(['user', 'trip.bus'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_reservations'));
    }
}
