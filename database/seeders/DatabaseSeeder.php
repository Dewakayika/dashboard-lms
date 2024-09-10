<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Intern;
use App\Models\Talent;
use App\Models\Admin;;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'id' => '1',
            'name' => 'Intern',
            'gender' => '1',
            'phone' => '+62811421',
            'address' => 'Jalan Buntu',
            'role' => 'intern',
            'email' => 'intern@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        Intern::factory()->create();

        User::factory()->create([
            'id' => '2',
            'name' => 'Talent',
            'gender' => '1',
            'phone' => '+62811421',
            'address' => 'Jalan Buntu',
            'role' => 'talent',
            'email' => 'talent@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        Talent::factory()->create();

        User::factory()->create([
            'id' => '3',
            'name' => 'Admin',
            'gender' => '1',
            'phone' => '+62811421',
            'address' => 'Jalan Buntu',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        Admin::factory()->create();

        Roles::factory()->create([
            'registration_code' => 'PADMA2024',
            'role_types' => 'intern',
        ]);

        Roles::factory()->create([
            'registration_code' => 'PADMA2025',
            'role_types' => 'talent',
        ]);
    }
}
