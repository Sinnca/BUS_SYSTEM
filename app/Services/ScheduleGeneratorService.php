<?php
namespace App\Services;

use App\Models\Trip;
use App\Models\Bus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleGeneratorService
{
    /**
     * Preset departure times
     */
    protected array $departureTimes = [
        '08:00:00', // 8:00 AM
        '12:00:00', // 12:00 PM
        '16:00:00', // 4:00 PM
    ];

    /**
     * Generate trips automatically based on parameters
     *
     * @param array $params [
     *   'bus_id' => int,
     *   'origin' => string,
     *   'destination' => string,
     *   'start_date' => date,
     *   'end_date' => date,
     *   'days_of_week' => array ['monday', 'tuesday', ...],
     *   'price' => float
     * ]
     * @return array ['created' => count, 'skipped' => count, 'trips' => collection]
     */
    public function generateTrips(array $params): array
    {
        $created = 0;
        $skipped = 0;
        $trips = collect();

        $bus = Bus::findOrFail($params['bus_id']);
        $startDate = Carbon::parse($params['start_date']);
        $endDate = Carbon::parse($params['end_date']);
        $daysOfWeek = $params['days_of_week'] ?? ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];

        return DB::transaction(function () use ($bus, $startDate, $endDate, $daysOfWeek, $params, &$created, &$skipped, &$trips) {
            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                // Check if this day is active
                $dayName = strtolower($currentDate->format('l')); // 'monday', 'tuesday', etc.

                if (in_array($dayName, $daysOfWeek)) {
                    // Generate trips for each preset time
                    foreach ($this->departureTimes as $time) {
                        // Check if trip already exists
                        $exists = Trip::where('bus_id', $bus->id)
                            ->where('departure_date', $currentDate->format('Y-m-d'))
                            ->where('departure_time', $time)
                            ->where('origin', $params['origin'])
                            ->where('destination', $params['destination'])
                            ->exists();

                        if (!$exists) {
                            $trip = Trip::create([
                                'bus_id' => $bus->id,
                                'origin' => $params['origin'],
                                'destination' => $params['destination'],
                                'departure_date' => $currentDate->format('Y-m-d'),
                                'departure_time' => $time,
                                'available_seats' => $bus->capacity,
                                'price' => $params['price'],
                            ]);

                            $trips->push($trip);
                            $created++;
                        } else {
                            $skipped++;
                        }
                    }
                }

                $currentDate->addDay();
            }

            return [
                'created' => $created,
                'skipped' => $skipped,
                'trips' => $trips,
            ];
        });
    }

    /**
     * Generate trips for multiple buses
     *
     * @param array $params [
     *   'bus_ids' => array,
     *   'origin' => string,
     *   'destination' => string,
     *   'start_date' => date,
     *   'end_date' => date,
     *   'days_of_week' => array,
     *   'price' => float
     * ]
     */
    public function generateTripsForMultipleBuses(array $params): array
    {
        $results = [];

        foreach ($params['bus_ids'] as $busId) {
            $busParams = array_merge($params, ['bus_id' => $busId]);
            $result = $this->generateTrips($busParams);

            $results[] = [
                'bus_id' => $busId,
                'bus_number' => Bus::find($busId)->bus_number,
                'created' => $result['created'],
                'skipped' => $result['skipped'],
            ];
        }

        return $results;
    }

    /**
     * Generate trips for a route with auto bus allocation
     *
     * @param array $params
     * @return array
     */
    public function generateRouteSchedule(array $params): array
    {
        // Get all active buses
        $buses = Bus::where('status', 'active')->get();

        if ($buses->isEmpty()) {
            throw new \Exception('No active buses available for schedule generation.');
        }

        $results = [
            'total_created' => 0,
            'total_skipped' => 0,
            'buses_used' => [],
        ];

        foreach ($buses as $bus) {
            $busParams = array_merge($params, ['bus_id' => $bus->id]);
            $result = $this->generateTrips($busParams);

            $results['total_created'] += $result['created'];
            $results['total_skipped'] += $result['skipped'];
            $results['buses_used'][] = [
                'bus' => $bus->bus_number,
                'type' => $bus->bus_type,
                'trips_created' => $result['created'],
            ];
        }

        return $results;
    }

    /**
     * Get available departure times
     */
    public function getDepartureTimes(): array
    {
        return $this->departureTimes;
    }
}
