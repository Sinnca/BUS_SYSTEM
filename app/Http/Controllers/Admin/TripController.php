<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Bus;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $query = Trip::with('bus');

        // Apply filters if provided
        if ($request->filled('origin')) {
            $query->where('origin', 'like', '%' . $request->origin . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        // Order by date and time
        $trips = $query->orderBy('departure_date', 'desc')
            ->orderBy('departure_time', 'desc')
            ->paginate(15)
            ->withQueryString(); // keeps the filter in pagination links

        return view('admin.trips.index', compact('trips'));
    }


    public function create()
    {
        $buses = Bus::where('status', 'active')->get();
        return view('admin.trips.create', compact('buses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100|different:origin',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|in:08:00:00,12:00:00,16:00:00',
            'price' => 'required|numeric|min:0|max:99999.99',
        ]);

        // Check if trip already exists
        $exists = Trip::where('bus_id', $validated['bus_id'])
            ->where('departure_date', $validated['departure_date'])
            ->where('departure_time', $validated['departure_time'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['bus_id' => 'This bus already has a trip at this time.'])
                ->withInput();
        }

        $bus = Bus::findOrFail($validated['bus_id']);
        $validated['available_seats'] = $bus->capacity;

        Trip::create($validated);

        return redirect()->route('admin.trips.index')
            ->with('success', 'Trip created successfully!');
    }

    public function show(Trip $trip)
    {
        $trip->load('bus', 'reservations');
        return view('admin.trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        $buses = Bus::where('status', 'active')->get();
        return view('admin.trips.edit', compact('trip', 'buses'));
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100|different:origin',
            'departure_date' => 'required|date',
            'departure_time' => 'required|in:08:00:00,12:00:00,16:00:00',
            'price' => 'required|numeric|min:0|max:99999.99',
        ]);

        $trip->update($validated);

        return redirect()->route('admin.trips.index')
            ->with('success', 'Trip updated successfully!');
    }

    public function destroy(Trip $trip)
    {
        // Check if trip has reservations
        if ($trip->reservations()->exists()) {
            return redirect()->route('admin.trips.index')
                ->with('error', 'Cannot delete trip with existing reservations!');
        }

        $trip->delete();

        return redirect()->route('admin.trips.index')
            ->with('success', 'Trip deleted successfully!');
    }
}
