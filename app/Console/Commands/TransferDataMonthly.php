<?php

namespace App\Console\Commands;
use App\Models\ProjectRecap;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransferDataMonthly extends Command
{
    protected $signature = 'transfer:data';
    protected $description = 'Transfer only one row from table1 to table2 for the period 11th of last month to 10th of this month';

    public function handle()
    {
        // Cek apakah hari ini tanggal 10
        if (now()->day != 10) {
            $this->info('Hari ini bukan tanggal 10, proses dihentikan.');
            return;
        }

        try {
            DB::beginTransaction();

            // Tentukan tanggal periode transfer
            $now = now();
            $startDate = Carbon::createFromFormat('Y-m-d', $now->subMonthNoOverflow()->format('Y-m') . '-11')->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $now->format('Y-m') . '-10')->endOfDay();

            // Ambil hanya **1 row** dari periode tersebut (Misalnya, row terbaru)
            $row = ProjectRecap::table('table1')
                ->whereBetween('updated_at', [$startDate, $endDate])
                ->latest('updated_at') // Ambil row terbaru dalam periode
                ->first();

            if (!$row) {
                $this->info('Tidak ada data dalam periode ini.');
            } else {
                ProjectRecap::table('table2')->insert([
                    'user_id' => $row->user_id,
                    'total_panel' => $row->total_panel,
                    'total_project' => $row->total_project,
                    'periode' => $row->priode,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info('Sukses! Data dari ' . $startDate->format('d-m-Y') . ' sampai ' . $endDate->format('d-m-Y') . ' telah dipindahkan.');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
