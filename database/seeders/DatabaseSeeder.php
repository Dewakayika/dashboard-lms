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
        $this->call([
            UsersTableSeeder::class,
        ]);
    }
}
