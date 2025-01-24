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

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'id' => '6',
            'name' => 'Talent',
            'role' => 'talent3',
            'email' => 'talent3@gmail.com',
            'password' => Hash::make('123123'),
            'registration_code' => 'PADMA',
        ]);

        Talent::factory()->create();
    }
}
