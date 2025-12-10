<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripSearchRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with('bus')
            ->available()
            ->orderBy('departure_date')
            ->orderBy('departure_time')
            ->paginate(12); // good for display

        return view('user.trips.index', compact('trips'));
    }

    public function search(TripSearchRequest $request)
    {
        $totalPassengers = $request->adults + ($request->children ?? 0);

        // Search outbound trips
        $query = Trip::with('bus')
            ->where('origin', $request->origin)
            ->where('destination', $request->destination)
            ->where('departure_date', $request->departure_date)
            ->where('available_seats', '>=', $totalPassengers)
            ->available();

        // Filter by bus type if specified
        if ($request->bus_type && $request->bus_type !== 'any') {
            $query->whereHas('bus', function($q) use ($request) {
                $q->where('bus_type', $request->bus_type);
            });
        }

        $trips = $query->orderBy('departure_time')->get();

        // Search return trips if round trip
        $returnTrips = null;
        if ($request->is_round_trip && $request->return_date) {
            $returnQuery = Trip::with('bus')
                ->where('origin', $request->destination) // Swap origin/destination
                ->where('destination', $request->origin)
                ->where('departure_date', $request->return_date)
                ->where('available_seats', '>=', $totalPassengers)
                ->available();

            if ($request->bus_type && $request->bus_type !== 'any') {
                $returnQuery->whereHas('bus', function($q) use ($request) {
                    $q->where('bus_type', $request->bus_type);
                });
            }

            $returnTrips = $returnQuery->orderBy('departure_time')->get();
        }

        // Store search params in session for booking
        session([
            'search_params' => [
                'adults' => $request->adults,
                'children' => $request->children ?? 0,
                'is_round_trip' => $request->is_round_trip ?? false,
                'origin' => $request->origin,
                'destination' => $request->destination,
            ]
        ]);

        return view('user.trips.search-results', compact('trips', 'returnTrips'));
    }

    public function show(Trip $trip)
    {
        $trip->load('bus', 'reservedSeats');
        return view('user.trips.trip-details', compact('trip'));
    }
}
