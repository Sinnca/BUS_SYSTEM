<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ScheduleGeneratorService;
use App\Models\Bus;
use Illuminate\Http\Request;

class ScheduleGeneratorController extends Controller
{
    protected $scheduleGenerator;

    public function __construct(ScheduleGeneratorService $scheduleGenerator)
    {
        $this->scheduleGenerator = $scheduleGenerator;
    }

    /**
     * Show schedule generator form
     */
    public function index()
    {
        $buses = Bus::where('status', 'active')->get();
        $departureTimes = $this->scheduleGenerator->getDepartureTimes();

        return view('admin.schedules.generator', compact('buses', 'departureTimes'));
    }

    /**
     * Generate trips automatically
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'bus_ids' => 'required|array|min:1',
            'bus_ids.*' => 'exists:buses,id',
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100|different:origin',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'price' => 'required|numeric|min:0|max:99999.99',
        ]);

        try {
            $results = $this->scheduleGenerator->generateTripsForMultipleBuses($validated);

            $totalCreated = collect($results)->sum('created');
            $totalSkipped = collect($results)->sum('skipped');

            return redirect()->route('admin.schedules.generator')
                ->with('success', "Successfully generated {$totalCreated} trips! {$totalSkipped} trips were skipped (already exist).")
                ->with('results', $results);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to generate trips: ' . $e->getMessage());
        }
    }
}
