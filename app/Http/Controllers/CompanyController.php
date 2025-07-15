<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Admin;
use App\Models\Talent;
use App\Models\Roles;
use App\Models\Project;
use App\Models\TalentQc;
use App\Models\Notification;
use App\Models\ProjectLog;
use App\Models\ProjectRecord;
use App\Models\Status;
use App\Models\Sop;
use App\Models\SopChecklist;
use App\Models\QcRecords;
use App\Models\ProjectRevise;
use App\Models\ProjectRecap;
use App\Models\ProjectType;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Spatie\GoogleCalendar\Event;
use App\Mail\MeetingInvitation;
use Illuminate\Support\Facades\Session;
use Google\Service\Calendar\Event as GoogleEvent;
use Google\Service\Calendar;
use Google\Service\Calendar\EventDateTime;
use Google\Service\Calendar\ConferenceData;
use Google\Service\Calendar\ConferenceDataCreateRequest;
use Google\Service\Calendar\ConferenceSolutionKey;
use Carbon\CarbonInterval;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function showRegistrationForm()
    {
        $companyTypes = [
            'Webtoon Studio',
            'Anime Studio',
            'Manga Studio',
            'Design Agency'
        ];
        return view('auth.register-company', compact('companyTypes'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'company_type' => ['required', 'string', 'in:Webtoon Studio,Anime Studio,Manga Studio,Design Agency'],
            'country' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'contact_person_name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'work_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'terms' => ['required', 'accepted']
        ], [
            'company_name.required' => 'Company name is required',
            'company_name.regex' => 'Company name can only contain letters and spaces',
            'company_name.max' => 'Company name cannot exceed 255 characters',

            'company_type.required' => 'Company type must be selected',
            'company_type.in' => 'Invalid company type',

            'country.required' => 'Country is required',
            'country.regex' => 'Country name can only contain letters and spaces',
            'country.max' => 'Country name cannot exceed 255 characters',

            'contact_person_name.required' => 'Contact person name is required',
            'contact_person_name.regex' => 'Contact person name can only contain letters and spaces',
            'contact_person_name.max' => 'Contact person name cannot exceed 255 characters',

            'work_email.required' => 'Email is required',
            'work_email.email' => 'Invalid email format',
            'work_email.unique' => 'Email is already registered',
            'work_email.max' => 'Email cannot exceed 255 characters',

            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'password.regex' => 'Password must contain uppercase, lowercase, number, and special character',

            'terms.required' => 'You must agree to the terms and conditions',
            'terms.accepted' => 'You must agree to the terms and conditions'
        ]);

        try {
            DB::beginTransaction();

            // Create company
            $company = Company::create([
                'name' => $request->company_name,
                'type' => $request->company_type,
                'country' => $request->country
            ]);

            // Generate registration code
            $registrationCode = 'COMP-' . strtoupper(Str::random(8));

            // Create admin user
            $user = User::create([
                'name' => $request->contact_person_name,
                'email' => $request->work_email,
                'password' => Hash::make($request->password),
                'role' => 'company',
                'registration_code' => $registrationCode
            ]);

            DB::commit();

            // Login the user
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang di dashboard.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error
            Log::error('Company Registration Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return back()
                ->with('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Index view index.blade.php
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        $notification = Notification::where('email', $user->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        // Count all Project based on Status
        $projectWaiting = Project::where('status', 'Waiting Talent')->where('user_id', $user->id)->count();
        $projectAssign = Project::where('status', 'Project Assign')->where('user_id', $user->id)->count();
        $projectDraft = Project::whereIn('status', ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted'])->where('user_id', $user->id)->count();
        $projectRevise = Project::whereIn('status', ['Revise 1', 'Revise 2', 'Revise 3'])->where('user_id', $user->id)->count();
        $projectQC = Project::where('status', ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3'])->where('user_id', $user->id)->count();
        $projectCompleted = Project::where('status', 'Done')->where('user_id', $user->id)->count();
        $totalProject = Project::where('user_id', $user->id)->count();
        $totalProjectThisYear = Project::whereYear('created_at', Carbon::now()->year)->where('user_id', $user->id)->count();
        $projects = ProjectLog::select('project_id', 'status', 'timestamp')
        ->whereIn('status', ['Waiting Talent', 'First Draft Submitted'])
        ->where('user_id', $user->id)
        ->orderBy('project_id')
        ->orderBy('timestamp')
        ->get()
        ->groupBy('project_id');

        $totalDuration = 0;
        $projectCount = 0;

        foreach ($projects as $projectLogs) {
            $assignLog = $projectLogs->firstWhere('status', 'Waiting Talent');
            $firstDraftLog = $projectLogs->firstWhere('status', 'First Draft Submitted');

            if ($assignLog && $firstDraftLog) {
                $assignTime = Carbon::parse($assignLog->timestamp);
                $firstDraftTime = Carbon::parse($firstDraftLog->timestamp);
                $duration = $firstDraftTime->diffInSeconds($assignTime);
                $totalDuration += $duration;
                $projectCount++;
            }
        }

        $averageDuration = $projectCount > 0 ? $totalDuration / $projectCount : 0;
        $formattedDuration = CarbonInterval::seconds($averageDuration)->cascade()->format('%H:%I:%S');


        // Mengambil data untuk drop down based on year
        $availableYears = Project::selectRaw('DISTINCT YEAR(created_at) as year')
            ->where('user_id', $user->id)
            ->orderBy('year', 'asc')
            ->pluck('year');

        // Get selected year (default to current year if not specified)
        $selectedYear = request('year', now()->year);


        // Get monthly data for selected year
        $projects = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $selectedYear)
            ->where('user_id', $user->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Create array with all months (1-12) initialized to 0
        $monthlyData = array_combine(range(1, 12), array_fill(0, 12, 0));

        // Merge actual data with the zero-filled array
        $monthlyData = array_replace($monthlyData, $projects);

        // Prepare data for chart
        $months = [];
        $totals = [];

        foreach ($monthlyData as $month => $total) {
            $months[] = Carbon::createFromDate($selectedYear, $month, 1)->format('F Y');
            $totals[] = $total;
        }

        // Total Panel
        $totalPanel = Project::where('user_id', $user->id)->sum('number_of_panel');

        // Get Project with "Waiting Talent" status
        $waitingProjects = Project::where('status', 'waiting talent')->where('user_id', $user->id)->paginate(10);

        $talent_qc = User::where('role', 'talent_qc')->get();

        $projectTypes = ProjectType::all();



        return view('users.CompanyAdmin.index', [
            'user' => $user,
            'notification' => $notification,
            'projectsList' => $waitingProjects,
            'notification' => $notification,
            'projectWaiting' => $projectWaiting,
            'projectDraft' => $projectDraft,
            'projectQC' => $projectQC,
            'projectRevise' => $projectRevise,
            'projectCompleted' => $projectCompleted,
            'totalProject' => $totalProject,
            'totalPanel' => $totalPanel,
            'totalProjectThisYear' => $totalProjectThisYear,
            'averageDuration' => $averageDuration,
            'months' => $months,
            'totals' => $totals,
            'talentQc' => $talent_qc,
            'projectAssign' => $projectAssign,
            'availableYears' => $availableYears,
            'selectedYear' => $selectedYear,
            'formatedDuration'=> $formattedDuration,
            'projectTypes' => $projectTypes,
        ]);
    }

    // Users Data View listUser
    public function listUser(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        // Notification
        $notification = Notification::where('email', $user->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        $role = $request->input('role'); // Mendapatkan role dari request (Intern atau Talent)

        if ($role == 'talent_qc') {
            // Mendapatkan data Intern saja
            $user_data = User::whereHas('talent_qc')->with('talent_qc')->get();
        } elseif ($role == 'talent') {
            // Mendapatkan data Talent saja
            $user_data = User::whereHas('talent')->with('talent')->get();
        } else {
            // Default: Mendapatkan semua data (Intern dan Talent)
            $user_data = User::with(['talent', 'intern'])->get();
        }

        $email = User::where('user_id', $user->id)->get();

        return view('users.CompanyAdmin.listUser')
            ->with(['userData' => $user_data, 'role' => $role])
            ->with(['user' => $user,'notification' => $notification]);
    }



}
