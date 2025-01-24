<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Intern;
use App\Models\Talent;
use App\Models\Admin;
use App\Models\TalentQc;
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
            'role' => 'intern',
            'email' => 'intern@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'PADMA',
        ]);

        Intern::factory()->create();

        User::factory()->create([
            'id' => '2',
            'name' => 'Talent',
            'role' => 'talent',
            'email' => 'talent@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'PADMA',
        ]);

        Talent::factory()->create();



        User::factory()->create([
            'id' => '3',
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'admin',
        ]);

        Admin::factory()->create();

        User::factory()->create([
            'id' => '4',
            'name' => 'Talent Qc',
            'role' => 'talent_qc',
            'email' => 'talentqc@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'admin',
        ]);

        TalentQc::factory()->create();


        User::factory()->create([
            'id' => '5',
            'name' => 'Talent',
            'role' => 'talent2',
            'email' => 'talent2@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'PADMA',
        ]);

        Talent::factory()->create();

        User::factory()->create([
            'id' => '5',
            'name' => 'Talent',
            'role' => 'talent3',
            'email' => 'talent3@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'PADMA',
        ]);

        Talent::factory()->create();



    }
}
