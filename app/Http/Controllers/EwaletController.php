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
use App\Models\User;
use App\Models\ProjectRecap;


use App\Mail\NotifyTalentQcMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Carbon\CarbonInterval;




class EwaletController extends Controller
{
    // E-walet Talent Index
    public function indexTalent()
    {
        // Mengambil data user dan talent yang login
        $userData = Auth::user();
        $talent = Talent::where('user_id', $userData->id)->first();

        if ($talent) {
            try {
                $talent->id_card = Crypt::decrypt($talent->id_card);
            } catch (\Exception $e) {
                $talent->id_card = 'Encrypted';
            }

            try {
                $talent->bank_name = Crypt::decrypt($talent->bank_name);
            } catch (\Exception $e) {
                $talent->bank_name = 'Encrypted';
            }

            try {
                $talent->bank_Account = Crypt::decrypt($talent->bank_Account);
            } catch (\Exception $e) {
                $talent->bank_Account = 'Encrypted';
            }

            try {
                $talent->swift_code = Crypt::decrypt($talent->swift_code);
            } catch (\Exception $e) {
                $talent->swift_code = 'Encrypted';
            }

            try {
                $talent->subjected_tax = Crypt::decrypt($talent->subjected_tax);
            } catch (\Exception $e) {
                $talent->subjected_tax = 'Encrypted';
            }
        }


        // Get Notification
        $notification = Notification::where('email', $userData->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        // Get List Withdraw
        $withdraws = Withdraw::where('user_id', $userData->id)->get();

        // Get List E-wallet
        $ewallets = Ewallet::where('user_id', $userData->id)->get();



        $now = Carbon::now();

        // Jika sudah tanggal 11 atau lebih, gunakan bulan ini sebagai periode
        if ($now->day >= 11) {
            $startDate = Carbon::createFromFormat('Y-m-d', $now->format('Y-m') . '-11')->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $now->copy()->addMonthNoOverflow()->format('Y-m') . '-10')->endOfDay();
        } else {
            // Jika masih tanggal 1-10, gunakan periode bulan lalu
            $startDate = Carbon::createFromFormat('Y-m-d', $now->copy()->subMonthNoOverflow()->format('Y-m') . '-11')->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $now->format('Y-m') . '-10')->endOfDay();
        }

        // Nama periode berdasarkan bulan dari startDate
        $periode = $startDate->format('F');

        // Get Project Recap On Periode
        $recapProject = ProjectRecap::where('user_id', $userData->id)
                        ->where('periode', $periode )
                        ->sum('total_project');

        // Get Project Recap Panel
        $recapPanel = ProjectRecap::where('user_id', $userData->id)
                        ->where('periode', $periode)
                        ->sum('total_panel');


        if ($recapPanel < 40) {
            $recapPanelRate = '7000';
        }elseif ($recapPanel >= 40 && $recapPanel <= 80 ){
            $recapPanelRate = ' 6000';
        }else{
            $recapPanelRate = '5000';
        }

        $baseSalary = $recapPanel * $recapPanelRate;


        // Get all ewallet money recap - withdraw
        $totalPanelRecap = ProjectRecap::where('user_id', $userData->id)
                ->whereNot('periode', $periode)
                ->sum('total_panel');

        $projects = ProjectRecap::where('user_id', $userData->id)
                ->whereNot('updated_at', $periode)
                ->sum('total_project');

        if ($totalPanelRecap < 40) {
            $recapPanelRate = '7000';
        }elseif ($totalPanelRecap >= 40 && $totalPanelRecap <= 80 ){
            $recapPanelRate = ' 6000';
        }else{
            $recapPanelRate = '5000';
        }


        $baseSalaryforWithdraw = $totalPanelRecap * $recapPanelRate;

        // Bonus Besar dengan perhitungan 100 panel = Rp. 50.000
        if ($totalPanelRecap >= 100) {
            $panelbonus = 50000;
        }else{
            $panelbonus = 0;
        }

        // Perfomance Bonus dengan panel 400 atau project 5 dan keliapatan 400
        if ($totalPanelRecap >= 400 || $projects >= 5) {
            $perfomanceBonus = 500000 * floor($totalPanelRecap / 400);
        } else {
            $perfomanceBonus = 0;
        }

        // Tax 10% dari Base Salary
        $tax = $baseSalaryforWithdraw * 0.1;

        // Grand Total
        $grandTotal = $baseSalaryforWithdraw + $panelbonus + $perfomanceBonus - $tax;

        // Total E-wallet alltime
        $amountWithdraw = Withdraw::where('user_id', $userData->id)
                    ->whereIn('status', ['requested', 'approved'])
                    ->sum('withdraw_amount');


        $totalEwallet = $grandTotal - $amountWithdraw;

        return view('users.Talent.ewaletOverview', compact(
            'projects',
            'userData',
            'talent',
            'notification',
            'baseSalary',
            'panelbonus',
            'perfomanceBonus',
            'tax',
            'grandTotal',
            'totalEwallet',
            'withdraws',
            'ewallets',
            'recapPanel',
            'recapProject',
            'baseSalaryforWithdraw',
            'totalPanelRecap',
            'periode'

        ));
    }


        // E-walet Talent Index
        public function indexTalentQc()
        {// Mengambil data user dan talent yang login
        $userData = Auth::user();
        $talent = TalentQc::where('user_id', $userData->id)->first();

        if ($talent) {
            try {
                $talent->id_card = Crypt::decrypt($talent->id_card);
            } catch (\Exception $e) {
                $talent->id_card = 'Encrypted';
            }

            try {
                $talent->bank_name = Crypt::decrypt($talent->bank_name);
            } catch (\Exception $e) {
                $talent->bank_name = 'Encrypted';
            }

            try {
                $talent->bank_Account = Crypt::decrypt($talent->bank_Account);
            } catch (\Exception $e) {
                $talent->bank_Account = 'Encrypted';
            }

            try {
                $talent->swift_code = Crypt::decrypt($talent->swift_code);
            } catch (\Exception $e) {
                $talent->swift_code = 'Encrypted';
            }

            try {
                $talent->subjected_tax = Crypt::decrypt($talent->subjected_tax);
            } catch (\Exception $e) {
                $talent->subjected_tax = 'Encrypted';
            }
        }


        // Get Notification
        $notification = Notification::where('email', $userData->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        // Get List Withdraw
        $withdraws = Withdraw::where('user_id', $userData->id)->get();

        // Get List E-wallet
        $ewallets = Ewallet::where('user_id', $userData->id)->get();



        $now = Carbon::now();

        // Jika sudah tanggal 11 atau lebih, gunakan bulan ini sebagai periode
        if ($now->day >= 11) {
            $startDate = Carbon::createFromFormat('Y-m-d', $now->format('Y-m') . '-11')->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $now->copy()->addMonthNoOverflow()->format('Y-m') . '-10')->endOfDay();
        } else {
            // Jika masih tanggal 1-10, gunakan periode bulan lalu
            $startDate = Carbon::createFromFormat('Y-m-d', $now->copy()->subMonthNoOverflow()->format('Y-m') . '-11')->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $now->format('Y-m') . '-10')->endOfDay();
        }

        // Nama periode berdasarkan bulan dari startDate
        $periode = $startDate->format('F');

        // Get Project Recap On Periode
        $recapProject = ProjectRecap::where('user_id', $userData->id)
                        ->where('periode', $periode )
                        ->sum('total_project');

        // Get Project Recap Panel
        $recapPanel = ProjectRecap::where('user_id', $userData->id)
                        ->where('periode', $periode)
                        ->sum('total_panel');


        if ($recapPanel < 40) {
            $recapPanelRate = '7000';
        }elseif ($recapPanel >= 40 && $recapPanel <= 80 ){
            $recapPanelRate = ' 6000';
        }else{
            $recapPanelRate = '5000';
        }

        $baseSalary = $recapPanel * $recapPanelRate;


        // Get all ewallet money recap - withdraw
        $totalPanelRecap = ProjectRecap::where('user_id', $userData->id)
                ->whereNot('periode', $periode)
                ->sum('total_panel');

        $projects = ProjectRecap::where('user_id', $userData->id)
                ->whereNot('updated_at', $periode)
                ->sum('total_project');

        if ($totalPanelRecap < 40) {
            $recapPanelRate = '7000';
        }elseif ($totalPanelRecap >= 40 && $totalPanelRecap <= 80 ){
            $recapPanelRate = ' 6000';
        }else{
            $recapPanelRate = '5000';
        }


        $baseSalaryforWithdraw = $totalPanelRecap * $recapPanelRate;

        // Bonus Besar dengan perhitungan 100 panel = Rp. 50.000
        if ($totalPanelRecap >= 100) {
            $panelbonus = 50000;
        }else{
            $panelbonus = 0;
        }

        // Perfomance Bonus dengan panel 400 atau project 5 dan keliapatan 400
        if ($totalPanelRecap >= 400 || $projects >= 5) {
            $perfomanceBonus = 500000 * floor($totalPanelRecap / 400);
        } else {
            $perfomanceBonus = 0;
        }

        // Tax 10% dari Base Salary
        $tax = $baseSalaryforWithdraw * 0.1;

        // Grand Total
        $grandTotal = $baseSalaryforWithdraw + $panelbonus + $perfomanceBonus - $tax;

        // Total E-wallet alltime
        $amountWithdraw = Withdraw::where('user_id', $userData->id)
                    ->whereIn('status', ['requested', 'approved'])
                    ->sum('withdraw_amount');


        $totalEwallet = $grandTotal - $amountWithdraw;

        return view('users.TalentQC.ewaletOverview', compact(
            'projects',
            'userData',
            'talent',
            'notification',
            'baseSalary',
            'panelbonus',
            'perfomanceBonus',
            'tax',
            'grandTotal',
            'totalEwallet',
            'withdraws',
            'ewallets',
            'recapPanel',
            'recapProject',
            'baseSalaryforWithdraw',
            'totalPanelRecap',
            'periode'

        ));        }

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
        // $ewallet = Ewallet::where('user_id', Auth::user()->id)->first();
        // $ewallet->total_ewallet = $ewallet->totalEwallet - $request->withdraw_amount;
        // $ewallet->save();

        // Email to user dengan role admin
        $admins = User::where('role', 'admin')->get();

        // send mail to admin
        foreach ($admins as $admin) {
            $data = [
                'name' => $admin->name,
                'email' => $admin->email
            ];

            Mail::send('emails.requestWithdraw', ['data' => $data], function($message) use ($admin) {
                $message->to($admin->email)
                        ->subject('New Withdrawal Request');
            });
        }

        return redirect()->back()->with('success', 'Withdraw request has been sent');

    }

    // Ewallet list from user in admin dashboard
    public function ewalletRequest(){
        $adminData = Auth::user();

        $withdraws = Withdraw::where('status', 'requested')->get();

        $withdrawsHistory = Withdraw::where('status', 'approved')->get();

        $notification = Notification::where('email', $adminData->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        return view('users.Admin.ewaletOverview', compact('withdraws', 'adminData',  'notification', 'withdrawsHistory'  ));
    }

    public function approveWithdraw(Request $request){
        $withdraw = Withdraw::find($request->withdraw_id);
        if (!$withdraw) {
            return redirect()->back()->with('error', 'Withdraw request not found.');
        }

        $withdraw->status = 'approved';
        $withdraw->save();

        // send email to user
        $user = User::find($withdraw->user_id);
        $data = [
            'name' => $user->name,
            'email' => $user->email
        ];
        Mail::send('emails.approveWithdraw', ['data' => $data], function($message) use ($user) {
            $message->to($user->email)
                    ->subject('Withdrawal Request Approved');
        });

        return redirect()->back()->with('success', 'Withdraw request has been approved.');
    }

    public function validatePassword(Request $request) {
        $admin = Auth::user();
        if (Hash::check($request->password, $admin->password)) {
            return response()->json(['valid' => true]);
        }
        return response()->json(['valid' => false]);
    }

}
