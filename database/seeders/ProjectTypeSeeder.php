<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectType::create([
            'id' => 1,
            'name' => 'Vivion',
        ]);

        ProjectType::create([
            'id' => 2,
            'name' => 'sukawara',
        ]);

    }
}
