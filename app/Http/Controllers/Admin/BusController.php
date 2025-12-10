<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::withCount('trips')->latest()->paginate(10);
        return view('admin.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('admin.buses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bus_number' => 'required|string|unique:buses,bus_number|max:50',
            'bus_type' => 'required|in:deluxe,regular',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        // Auto-set capacity based on bus type
        $validated['capacity'] = $validated['bus_type'] === 'deluxe' ? 20 : 40;

        Bus::create($validated);

        return redirect()->route('admin.buses.index')
            ->with('success', 'Bus created successfully!');
    }

    public function show(Bus $bus)
    {
        $bus->load('trips');
        return view('admin.buses.show', compact('bus'));
    }

    public function edit(Bus $bus)
    {
        return view('admin.buses.edit', compact('bus'));
    }

    public function update(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'bus_number' => 'required|string|max:50|unique:buses,bus_number,' . $bus->id,
            'bus_type' => 'required|in:deluxe,regular',
            'status' => 'required|in:active,inactive,maintenance',
        ]);

        // Update capacity if bus type changed
        $validated['capacity'] = $validated['bus_type'] === 'deluxe' ? 20 : 40;

        $bus->update($validated);

        return redirect()->route('admin.buses.index')
            ->with('success', 'Bus updated successfully!');
    }

    public function destroy(Bus $bus)
    {
        // Check if bus has upcoming trips
        $hasUpcomingTrips = $bus->trips()
            ->where('departure_date', '>=', now())
            ->exists();

        if ($hasUpcomingTrips) {
            return redirect()->route('admin.buses.index')
                ->with('error', 'Cannot delete bus with upcoming trips!');
        }

        $bus->delete();

        return redirect()->route('admin.buses.index')
            ->with('success', 'Bus deleted successfully!');
    }
}
