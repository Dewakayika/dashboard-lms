<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusTypes = [
            'Project Assign',
            'QC First Draft',
            'First Draft Submitted',
            'Revision 1',
            'QC Revise 1',
            'Revise 1 Submitted',
            'Revision 2',
            'QC Revise 2',
            'Revise 2 Submitted',
            'Revision 3',
            'QC Revise 3',
            'Revise 3 Submitted',
            'Done',
        ];

        foreach ($statusTypes as $status) {
            DB::table('status_types')->insert([
                'name' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
