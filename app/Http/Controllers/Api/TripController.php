<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\ReservedSeat;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Search trips
     * GET /api/trips/search
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string|different:origin',
            'departure_date' => 'required|date|after_or_equal:today',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'nullable|integer|min:0|max:10',
            'bus_type' => 'nullable|in:deluxe,regular',
        ]);

        $totalPassengers = $validated['adults'] + ($validated['children'] ?? 0);

        $query = Trip::with('bus')
            ->where('origin', $validated['origin'])
            ->where('destination', $validated['destination'])
            ->where('departure_date', $validated['departure_date'])
            ->where('available_seats', '>=', $totalPassengers)
            ->available();

        if (isset($validated['bus_type'])) {
            $query->whereHas('bus', function($q) use ($validated) {
                $q->where('bus_type', $validated['bus_type']);
            });
        }

        $trips = $query->orderBy('departure_time')->get();

        return response()->json([
            'trips' => $trips->map(function($trip) {
                return [
                    'id' => $trip->id,
                    'origin' => $trip->origin,
                    'destination' => $trip->destination,
                    'departure_date' => $trip->departure_date->format('Y-m-d'),
                    'departure_time' => $trip->formatted_time,
                    'available_seats' => $trip->available_seats,
                    'price' => $trip->price,
                    'bus' => [
                        'id' => $trip->bus->id,
                        'bus_number' => $trip->bus->bus_number,
                        'bus_type' => $trip->bus->bus_type,
                        'capacity' => $trip->bus->capacity,
                    ],
                ];
            }),
        ]);
    }

    /**
     * Get trip details
     * GET /api/trips/{id}
     */
    public function show(Trip $trip)
    {
        $trip->load('bus');

        return response()->json([
            'trip' => [
                'id' => $trip->id,
                'origin' => $trip->origin,
                'destination' => $trip->destination,
                'departure_date' => $trip->departure_date->format('Y-m-d'),
                'departure_time' => $trip->formatted_time,
                'available_seats' => $trip->available_seats,
                'price' => $trip->price,
                'bus' => [
                    'id' => $trip->bus->id,
                    'bus_number' => $trip->bus->bus_number,
                    'bus_type' => $trip->bus->bus_type,
                    'capacity' => $trip->bus->capacity,
                ],
                'occupancy_rate' => $trip->occupancy_rate,
            ],
        ]);
    }

    /**
     * Get available seats for a trip
     * GET /api/trips/{id}/seats
     */
    public function seats(Trip $trip)
    {
        $reservedSeats = ReservedSeat::where('trip_id', $trip->id)
            ->pluck('seat_number')
            ->toArray();

        $allSeats = range(1, $trip->bus->capacity);
        $availableSeats = array_values(array_diff($allSeats, $reservedSeats));

        return response()->json([
            'trip_id' => $trip->id,
            'total_capacity' => $trip->bus->capacity,
            'available_count' => count($availableSeats),
            'available_seats' => $availableSeats,
            'reserved_seats' => $reservedSeats,
        ]);
    }
}
