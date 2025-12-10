<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@bus.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create sample regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@bus.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
