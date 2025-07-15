<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'registration_code' => 'PADMA2025',
            // Add other required fields if needed
        ]);

        User::create([
            'name' => 'Talent User',
            'email' => 'talent@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'talent',
            'registration_code' => 'PADMA2025',
            // Add other required fields if needed
        ]);

        // Talent QC
        User::create([
            'name' => 'Talent QC User',
            'email' => 'talentqc@example.com',
            'password' => Hash::make('password'),
            'role' => 'talentqc',
            'registration_code' => 'PADMA2025',
        ]);

    }
}
