<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Notification;
use App\Models\Ewallet;
use App\Models\Withdraw;
use App\Models\Talent;
use App\Models\TalentQc;

use Illuminate\Support\Facades\Auth;

class EwaletController extends Controller
{
    // E-walet Talent Index
    public function indexTalent()
    {
        // Mengambil data user dan talent yang login
        $userData = Auth::user();
        $talent = Talent::where('user_id', $userData->id)->first();


        // Get Notification
        $notification = Notification::where('email', $userData->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        // Inisiate Variable Rentang Waktu
        $startDate = Carbon::now()->subMonth()->startOfMonth()->addDays(10);
        $endDate = Carbon::now()->startOfMonth()->addDays(12);

        // Get Data Project dari user yang login dengan status Done
        $projects = Project::where('status', 'Done')
            ->where('talent', $userData->name)
            ->whereBetween('finish_date', [$startDate, $endDate])
            ->count();

        // Get Total Panel yang dikerjakan oleh user pada setiap rentang waktu
        $totalPanel = Project::where('status', 'Done')
            ->where('talent', $userData->name)
            ->whereBetween('finish_date', [$startDate, $endDate])
            ->sum('number_of_panel');

        // Calculate Panel perRate
        if ($totalPanel < 40) {
            $panelRate = '7000';
        }elseif ($totalPanel >= 40 && $totalPanel <= 80 ){
            $panelRate = ' 6000';
        }else{
            $panelRate = '5000';
        }

        // Base Salary berdasarkan perhitungan panelRate x totalPanel
        $baseSalary = $totalPanel * $panelRate;

        // Bonus Besar dengan perhitungan 100 panel = Rp. 50.000
        if ($totalPanel >= 100) {
            $panelbonus = 50000;
        }else{
            $panelbonus = 0;
        }

        // Perfomance Bonus dengan panel 400 atau project 5 dan keliapatan 400
        if ($totalPanel >= 400 || $projects >= 5) {
            $perfomanceBonus = 500000 * floor($totalPanel / 400);
        } else {
            $perfomanceBonus = 0;
        }

        // Tax 10% dari Base Salary
        $tax = $baseSalary * 0.1;

        // Grand Total
        $grandTotal = $baseSalary + $panelbonus + $perfomanceBonus - $tax;

        // Total E-wallet alltime
        $ewalletHistory = Ewallet::where('user_id', $userData->id)->sum('total_ewallet');
        $amountWithdraw = Withdraw::where('user_id', $userData->id)
            ->where('status', 'approved')
            ->sum('withdraw_amount');

        $totalEwallet = $ewalletHistory + $grandTotal - $amountWithdraw;


        // Get List Withdraw
        $withdraws = Withdraw::where('user_id', $userData->id)->get();

        // Get List E-wallet
        $ewallets = Ewallet::where('user_id', $userData->id)->get();

        return view('users.Talent.ewaletOverview', compact(
            'projects',
            'userData',
            'talent',
            'notification',
            'totalPanel',
            'panelRate',
            'baseSalary',
            'panelbonus',
            'perfomanceBonus',
            'tax',
            'grandTotal',
            'totalEwallet',
            'withdraws',
            'ewallets'
        ));
    }


        // E-walet Talent Index
        public function indexTalentQc()
        {
            // Mengambil data user dan talent yang login
            $userData = Auth::user();
            $talent = TalentQc::where('user_id', $userData->id)->first();


            // Get Notification
            $notification = Notification::where('email', $userData->email)
            ->orWhere('notif_type', 'urgent')
            ->get();

            // Inisiate Variable Rentang Waktu
            $startDate = Carbon::now()->subMonth()->startOfMonth()->addDays(10);
            $endDate = Carbon::now()->startOfMonth()->addDays(12);

            // Get Data Project dari user yang login dengan status Done
            $projects = Project::where('status', 'Done')
                ->where('talent', $userData->name)
                ->whereBetween('finish_date', [$startDate, $endDate])
                ->count();

            // Get Total Panel yang dikerjakan oleh user pada setiap rentang waktu
            $totalPanel = Project::where('status', 'Done')
                ->where('talent', $userData->name)
                ->whereBetween('finish_date', [$startDate, $endDate])
                ->sum('number_of_panel');

            // Calculate Panel perRate
            if ($totalPanel < 40) {
                $panelRate = '7000';
            }elseif ($totalPanel >= 40 && $totalPanel <= 80 ){
                $panelRate = ' 6000';
            }else{
                $panelRate = '5000';
            }

            // Base Salary berdasarkan perhitungan panelRate x totalPanel
            $baseSalary = $totalPanel * $panelRate;

            // Bonus Besar dengan perhitungan 100 panel = Rp. 50.000
            if ($totalPanel >= 100) {
                $panelbonus = 50000;
            }else{
                $panelbonus = 0;
            }

            // Perfomance Bonus dengan panel 400 atau project 5 dan keliapatan 400
            if ($totalPanel >= 400 || $projects >= 5) {
                $perfomanceBonus = 500000 * floor($totalPanel / 400);
            } else {
                $perfomanceBonus = 0;
            }

            // Tax 10% dari Base Salary
            $tax = $baseSalary * 0.1;

            // Grand Total
            $grandTotal = $baseSalary + $panelbonus + $perfomanceBonus - $tax;

            // Total E-wallet alltime
            $ewalletHistory = Ewallet::where('user_id', $userData->id)->sum('total_ewallet');
            $amountWithdraw = Withdraw::where('user_id', $userData->id)
                ->where('status', 'approved')
                ->sum('withdraw_amount');

            $totalEwallet = $ewalletHistory + $grandTotal - $amountWithdraw;

            // Get List Withdraw
            $withdraws = Withdraw::where('user_id', $userData->id)->get();

            // Get List E-wallet
            $ewallets = Ewallet::where('user_id', $userData->id)->get();

            return view('users.TalentQC.ewaletOverview', compact(
                'projects',
                'userData',
                'talent',
                'notification',
                'totalPanel',
                'panelRate',
                'baseSalary',
                'panelbonus',
                'perfomanceBonus',
                'tax',
                'grandTotal',
                'totalEwallet',
                'withdraws',
                'ewallets'
            ));
        }

    public function requestWithdraw(Request $request){

        // Validasi Field
        $request->validate([
            'total_panel' => 'required',
            'total_project' => 'required',
            'withdraw_amount' => 'required',
            'panel_bonus' => 'required',
            'perfomance_bonus' => 'required',
            'bank_account' => 'required',
            'bank_name' => 'required',
        ]);

        // Simpan data ke tabel withdraw
        $withdraw = new Withdraw();
        $withdraw->user_id = Auth::user()->id;
        $withdraw->total_panel = $request->total_panel;
        $withdraw->total_project = $request->total_project;
        $withdraw->withdraw_date = Carbon::now();
        $withdraw->withdraw_amount = $request->withdraw_amount;
        $withdraw->panel_bonus = $request->panel_bonus;
        $withdraw->perfomance_bonus = $request->perfomance_bonus;
        $withdraw->bank_account = $request->bank_account;
        $withdraw->bank_name = $request->bank_name;
        $withdraw->status = 'requested';
        $withdraw->save();

        // Update total_ewallet pada tabel ewallet
        $ewallet = Ewallet::where('user_id', Auth::user()->id)->first();
        $ewallet->total_ewallet = $ewallet->total_ewallet - $request->withdraw_amount;
        $ewallet->save();

        return redirect()->back()->with('success', 'Withdraw request has been sent');

    }
}
