<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        $buses = [
            ['bus_number' => 'DLX-001', 'bus_type' => 'deluxe', 'capacity' => 20, 'status' => 'active'],
            ['bus_number' => 'DLX-002', 'bus_type' => 'deluxe', 'capacity' => 20, 'status' => 'active'],
            ['bus_number' => 'REG-001', 'bus_type' => 'regular', 'capacity' => 40, 'status' => 'active'],
            ['bus_number' => 'REG-002', 'bus_type' => 'regular', 'capacity' => 40, 'status' => 'active'],
            ['bus_number' => 'REG-003', 'bus_type' => 'regular', 'capacity' => 40, 'status' => 'active'],
        ];

        foreach ($buses as $bus) {
            Bus::create($bus);
        }
    }
}
