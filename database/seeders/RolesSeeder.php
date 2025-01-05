<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data roles
        $roles = [
            [
                'registration_code' => 'PADMA2024',
                'role_types' => 'intern',
            ],
            [
                'registration_code' => 'PADMA2025',
                'role_types' => 'talent',
            ],
            [
                'registration_code' => 'PADMA2025',
                'role_types' => 'talentqc',
            ],
        ];

        // Insert data ke tabel roles
        foreach ($roles as $role) {
            Roles::create($role);
        }
    }
}
