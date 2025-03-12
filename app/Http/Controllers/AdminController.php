<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\DonationFee;
use App\Models\Driver;
use App\Models\Feedback;
use App\Models\Meal;
use App\Models\Intern;
use App\Models\Order;
use App\Models\Talent;
use App\Models\Volunteer;
use App\Models\Roles;
use App\Models\TalentCV;
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

use App\Mail\DeclineEmail;
use App\Mail\ApproveEmail;
use App\Mail\TalentQcAssigned;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use Spatie\GoogleCalendar\Event;
use App\Mail\MeetingInvitation;
use Illuminate\Support\Facades\Session;
use Google\Service\Calendar\Event as GoogleEvent;
use Google\Service\Calendar;
use Google\Service\Calendar\EventDateTime;
use Google\Service\Calendar\ConferenceData;
use Google\Service\Calendar\ConferenceDataCreateRequest;
use Google\Service\Calendar\ConferenceSolutionKey;
use Illuminate\Support\Facades\Hash;
use Carbon\CarbonInterval;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;





class AdminController extends Controller
{
    public function index(){

        $admin_data = User::where('id', Auth::id())->first();

        // Count all Project based on Status
        $projectWaiting = Project::where('status', 'Waiting Talent')->count();
        $projectAssign = Project::where('status', 'Project Assign')->count();
        $projectDraft = Project::whereIn('status', ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted'])->count();
        $projectRevise = Project::whereIn('status', ['Revise 1', 'Revise 2', 'Revise 3'])->count();
        $projectQC = Project::where('status', ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3'])->count();
        $projectCompleted = Project::where('status', 'Done')->count();
        $totalProject = Project::count();

        // Menghitung total proyek di tahun ini
        $totalProjectThisYear = Project::whereYear('created_at', Carbon::now()->year)->count();

        //Menghitung total waktu timestamp yang diperlukan dari statusnya Project Assign ke First Draft Submitted pada tabel project_logs
        $projects = ProjectLog::select('project_id', 'status', 'timestamp')
        ->whereIn('status', ['Waiting Talent', 'First Draft Submitted'])
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
            ->orderBy('year', 'asc')
            ->pluck('year');

        // Get selected year (default to current year if not specified)
        $selectedYear = request('year', now()->year);


        // Get monthly data for selected year
        $projects = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $selectedYear)
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
        $totalPanel = Project::sum('number_of_panel');

        $notification = Notification::where('email', $admin_data->email)
            ->orWhere('notif_type', 'urgent')
            ->get();

        // Get Project with "Waiting Talent" status
        $waitingProjects = Project::where('status', 'waiting talent')->paginate(10);

        $talent_qc = User::where('role', 'talent_qc')->get();


        // Check talent status
        // $pendingUsers = Talent::whereNull('status')
        // // ->join('users', 'talent.user_id', '=', 'users.id')
        // // ->select('talent.*', 'users.name', 'users.email', 'users.created_at as registration_date')
        // ->get();

        // project type
        $projectTypes = ProjectType::all();


        return view ('users.Admin.overview')->with([
            'adminData' => $admin_data,
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

    public function createProject()
    {
        $admin_data = User::where('id', Auth::id())->first();

        $notification = Notification::get();

        // Mendapatkan list semua user dengan role 'talent_qc'
        $talent_qc = User::where('role', 'talent_qc')->get();

        $notification = Notification::where('email', $admin_data->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        return view('users.Admin.createNewProject')->with([
            'adminData' => $admin_data,
            'talentQc' => $talent_qc,
            'notification' => $notification
        ]);
    }

    public function approveUser($id)
    {
        try {
            $talent = Talent::where('id', $id)->firstOrFail();
            $talent->status = 'approved';
            $talent->save();

            $user = User::join('talent', 'users.id', '=', 'talent.user_id')
            ->where('talent.id', $id)
            ->select('users.id', 'users.name', 'users.email')
            ->first();


            // send email
            Mail::send('emails.userApprove',
                [
                    'user' => $user,
                    'name' => $user->name
                ],
                function($message) use ($user) {
                    $message->to($user->email)
                            ->from(config('mail.from.address'), config('mail.from.name'))
                            ->subject('Your Account Has Been Approved');
                }
            );

            return back()->with('success', 'User has been approved successfully.');
        } catch (\Exception $e) {
            \Log::error('Error in approveUser: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while approving the user.');
        }
    }



    public function declineUser($id)
    {
        try {

            // Find the talent record
            $talent = Talent::where('id', $id)->firstOrFail();
            $talent->status = 'declined';
            $talent->save();

            //             // Get the user
            // $user = User::join('talent', 'users.id', '=', 'talent.user_id')
            //         ->where('talent.id', $id)
            //         ->select('users.id', 'users.name', 'users.email')
            //         ->first();

            // // dd($user);

            // // Send email
            // Mail::send('emails.userDecline',
            //     [
            //         'user' => $user,
            //         'name' => $user->name
            //     ],
            //     function($message) use ($user) {
            //         $message->to($user->email)
            //                 ->from(config('mail.from.address'), config('mail.from.name'))
            //                 ->subject('Account Information Declined');
            //     }
            // );

            return redirect()->back()->with('success', 'User has been declined successfully.');

        } catch (\Exception $e) {
            \Log::error('Error in declineUser: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while declining the user.');
        }
    }



    public function projectTimeStatistic()
    {
        $user = auth()->user();
        $notifications = Notification::where('notif_type', 'urgent')
            ->orWhere('email', $user->email)
            ->get();

        $projects = Project::select('id as project_id', 'talent', 'talent_qc')->get();

        // Data for Talent (Project Time)
        $talentDurations = [];
        $talentProjectCounts = [];

        // Data for Talent QC (QC Time)
        $qcDurations = [];
        $qcProjectCounts = [];

        foreach ($projects as $project) {
            $projectLogs = ProjectLog::select('status', 'timestamp')
                ->where('project_id', $project->project_id)
                ->whereIn('status', ['Project Assign', 'QC First Draft', 'First Draft Submitted'])
                ->orderBy('timestamp')
                ->get();

            // Assign time
            $assignTime = Carbon::parse(optional($projectLogs->firstWhere('status', 'Project Assign'))->timestamp);
            $qcFirstDraftTime = Carbon::parse(optional($projectLogs->firstWhere('status', 'QC First Draft'))->timestamp);
            $firstDraftTime = Carbon::parse(optional($projectLogs->firstWhere('status', 'First Draft Submitted'))->timestamp);

            // Calculate talent project time
            if ($assignTime && $firstDraftTime) {
                $duration = $firstDraftTime->diffInSeconds($assignTime);
                if (!isset($talentDurations[$project->talent])) {
                    $talentDurations[$project->talent] = 0;
                    $talentProjectCounts[$project->talent] = 0;
                }
                $talentDurations[$project->talent] += $duration;
                $talentProjectCounts[$project->talent]++;
            }

            // Calculate QC project time
            if ($qcFirstDraftTime && $firstDraftTime && $project->talent_qc) {
                $qcDuration = $firstDraftTime->diffInSeconds($qcFirstDraftTime);
                if (!isset($qcDurations[$project->talent_qc])) {
                    $qcDurations[$project->talent_qc] = 0;
                    $qcProjectCounts[$project->talent_qc] = 0;
                }
                $qcDurations[$project->talent_qc] += $qcDuration;
                $qcProjectCounts[$project->talent_qc]++;
            }
        }

        // Prepare data for Talent Bar Chart
        $talentNames = array_keys($talentDurations);
        $averageProjectDurations = array_map(
            fn($talent) => $talentProjectCounts[$talent] > 0 ? round(($talentDurations[$talent] / $talentProjectCounts[$talent]) / 3600, 2) : 0,
            $talentNames
        );

        // Prepare data for QC Bar Chart
        $qcNames = array_keys($qcDurations);
        $averageQCDurations = array_map(
            fn($qc) => $qcProjectCounts[$qc] > 0 ? round(($qcDurations[$qc] / $qcProjectCounts[$qc]) / 3600, 2) : 0,
            $qcNames
        );

        // Prepare Leaderboard Data
        $leaderboardData = [];
        foreach ($talentNames as $index => $name) {
            $leaderboardData[] = [
                'talent_name' => $name,
                'email' => $this->getTalentEmail($name),
                'formatted_average_duration' => $this->formatDuration($averageProjectDurations[$index]),
            ];
        }

        // Sort leaderboard by average duration
        usort($leaderboardData, function($a, $b) {
            return $a['formatted_average_duration'] <=> $b['formatted_average_duration'];
        });

        // Now $projectSummaries contains the information about both talent and talent_qc

        return view('users.Admin.projectTimeOverview')->with([
            'adminData' => $user,
            'notification' => $notifications,
            'talentNames' => $talentNames,
            'averageProjectDurations' => $averageProjectDurations,
            'qcNames' => $qcNames,
            'averageQCDurations' => $averageQCDurations,
            'result' => $leaderboardData,
            'projects' => $projects, // Pass $projects to the view
        ]);
    }


    private function getTalentEmail($talentName)
    {
        // Assuming you have a Talent model or User model where you can get the email by name
        return User::where('name', $talentName)->first()->email ?? 'No Email';
    }

    private function formatDuration($durationInHours)
    {
        return $durationInHours > 0 ? $durationInHours . ' hours' : '0 hours';
    }


    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'project_type_id' => 'required|exists:project_types,id',
            'comic_name' => 'required|string|max:255',
            'chapter_number' => 'required|integer',
            'talent_qc' => 'required|exists:users,id', // Pastikan ID talent QC valid
            'number_of_panel' => 'nullable|integer',
            'file' => 'required|string',
        ]);

        // Cari data user berdasarkan ID talent_qc
        $talentQc = User::find($validated['talent_qc']);

        // First save the project
        $project = new Project();
        $project->project_type_id = $validated['project_type_id'];
        $project->user_id = auth()->id();
        $project->comic_name = $validated['comic_name'];
        $project->chapter_number = $validated['chapter_number'];
        $project->talent_qc = $talentQc->name; // Simpan nama talent QC
        $project->file = $validated['file'];
        $project->status = 'Waiting Talent';
        $project->save();

        // Then create the project log using the newly saved project's information
        $log = ProjectLog::create([
            'project_id' => $project->id,  // Get ID from the newly saved project
            'project_type_id' => $project->project_type_id,
            'user_id' => auth()->id(),     // Get current authenticated user's ID
            'talent_qc' => $project->talent_qc,  // Get talent_qc from the newly saved project
            'timestamp' => Carbon::now(),
            'status' => $project->status,   // Get status from the newly saved project
        ]);

        // Simpan detail email yang dikirim ke tabel "notifikasi"
        Notification::create([
            'notif_type' => "urgent",
            'subject' => "New Project Has been Created!",
            'message' => "{$talentQc->email} have been assigned as QC for the project '{$project->comic_name}' (Chapter {$project->chapter_number}). Please check your dashboard for details.",
            'email' => $talentQc->email,
        ]);

        return redirect()->back()->with('success', 'Project created successfully!');
    }



    // Admin Dashboard
    public function community()
    {
        // Hitung total user, intern, talent, dan role
        $user_data = User::count();
        $intern_data = Intern::count();
        $talent_data = Talent::count();
        $role_count = Roles::count();
        $role_data = Roles::paginate(10);

        $admin_data = User::where('id', Auth::id())->first();


        $notification = Notification::where('email', $admin_data->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        $pendingUsers = Talent::whereNull('status')
        ->get();

        // Ambil data leaderboard (total submission per user)
        $leaderboard = DB::table('users')
        ->leftJoin('Submission_Course', 'users.id', '=', 'Submission_Course.user_id')
        ->leftJoin('Assignment_Votes', 'Submission_Course.id', '=', 'Assignment_Votes.submission_id') // Join dengan tabel votes
        ->select(
            'users.id',
            'users.name',
            'users.email',
            DB::raw('COUNT(Submission_Course.id) as total_submissions'), // Hitung jumlah submission
            DB::raw('SUM(Assignment_Votes.vote_value) as total_votes'), // Hitung total votes
            DB::raw('MIN(Submission_Course.submission_date) as first_submission_date')
        )
        ->groupBy('users.id', 'users.name', 'users.email')
        ->orderBy('total_votes', 'DESC') // Urutkan berdasarkan total votes terbanyak
        ->orderBy('first_submission_date', 'ASC') // Kemudian urutkan berdasarkan tanggal submission paling awal
        ->paginate(5);

        // Get project Types
        $projectTypes = ProjectType::all();


        // Return ke view dengan data yang telah diambil
        return view('users.Admin.dashboard')->with([
            'adminData' => $admin_data,
            'userData' => $user_data,
            'internData' => $intern_data,
            'talentData' => $talent_data,
            'countRole' => $role_count,
            'roleData' => $role_data,
            'leaderboard' => $leaderboard,
            'notification' => $notification,
            'pendingUsers' => $pendingUsers,
            'projectTypes' => $projectTypes
        ]);
    }



    // Create Role and Registration Code | View
    public function createRole(){
        $admin_data = User::where('id', Auth::id())->first();

        // get all notification
        $notification = Notification::get();

        return view('users.Admin.createRole')->with([ 'adminData' => $admin_data, 'notification' => $notification]);

    }

    // Create new Role and Registration Code | Function
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'registration_code' => 'required|string|max:255|unique:roles,registration_code',
            'role_types' => 'required|string|max:255',
        ]);

        // Simpan data role ke database
        Roles::create([
            'registration_code' => $request->registration_code,
            'role_types' => $request->role_types,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin#index')->with('roleCreated', 'Registration Code successfully created!');
    }

    // Admin Delete Role & Registration Code
    public function deleteRole($id)
    {
        Roles::where('id', $id)->delete();
        return back()->with(['roleDeleted' => 'Registation Has Been Deleted Successfully!']);
    }

    // Admin Edit Role & Registration Code
    public function editRole($id)
    {
        $role_data = Roles::where('id', $id)->first();
        $notification = Notification::get();
        return view('users.Admin.updateRole')->with(['editRole' => $role_data, 'notification' => $notification]);
    }

    // Admin Update Role
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $id)
    {
        // Validasi agar registration_code unik
        $request->validate([
            'registration_code' => 'required|unique:roles,registration_code,' . $id,
            'role_types' => 'required',
        ]);

        $update_role = $this->requestUpdateRole($request);
        Roles::where('id', $id)->update($update_role);

        return redirect(route('admin#index'))->with(['userUpdated' => 'Registration Code Has Been Updated Successfully!']);
    }

    private function requestUpdateRole($request)
    {
        $arr = [
            'registration_code' => $request->registration_code,
            'role_types' => $request->role_types,
            'updated_at' => Carbon::now(),
        ];

        return $arr;
    }

    // Admin Profile
    public function adminProfile()
    {
        $adminData = User::where('id', Auth::id())->first();

        // get all notification
        $notification = Notification::where('email', $adminData->email)
        ->orWhere('notif_type', 'urgent')
        ->get();
        return view('users.Admin.adminProfile')
            ->with([
                'adminData' => $adminData,
                'notification' => $notification

        ]);
    }

    //Admin Edit Profile
    public function editProfile()
    {
        $admin_data = Admin::where('user_id', Auth::id())->first();
        return view('users.Admin.updateAdmin')->with(['adminData' =>  $admin_data]);
    }
    // Admin Update Profile
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(request $request)
    {
        $update_user = $this->requestUpdateAdmin($request);
        User::where('id', Auth::id())->update($update_user);

        return redirect()->route('admin#adminProfile');
    }

    private function requestUpdateAdmin($request)
    {
        $array = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now()
        ];
        return $array;
    }

    //Admin List User
    public function listUser(Request $request)
    {
        $admin_data = User::where('id', Auth::id())->first();
        // Notification
        $notification = Notification::where('email', $admin_data->email)
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

        return view('users.Admin.listUser')->with(['userData' => $user_data, 'role' => $role])
            ->with(['adminData' => $admin_data,
                    'notification' => $notification]);
    }


    // Profile User by Id
    public function profileUser($id)
    {
        $userData = User::findOrFail($id);
        $adminData = User::findOrFail(Auth::id());

        // Mengambil data talent dan talent QC berdasarkan user ID
        $talent = Talent::where('user_id', $id)->first();
        $talentQc = TalentQC::where('user_id', $id)->first();

        // Dekripsi data talent jika ada
        if ($talent) {
            foreach (['id_card', 'bank_name', 'bank_Account', 'swift_code', 'subjected_tax'] as $field) {
                try {
                    $talent->$field = Crypt::decrypt($talent->$field);
                } catch (\Exception $e) {
                    $talent->$field = 'Encrypted';
                }
            }
        }

        if ($talentQc) {
            foreach (['id_card', 'bank_name', 'bank_Account', 'swift_code', 'subjected_tax'] as $field) {
                try {
                    $talentQc->$field = Crypt::decrypt($talentQc->$field);
                } catch (\Exception $e) {
                    $talentQc->$field = 'Encrypted';
                }
            }
        }

        // Mengambil notifikasi
        $notification = Notification::where('email', $adminData->email)
            ->orWhere('notif_type', 'urgent')
            ->get();

        // Mengambil daftar tahun yang tersedia
        $availableYears = Project::selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'asc')
            ->pluck('year');

        // Tahun yang dipilih (default ke tahun saat ini jika tidak ada)
        $selectedYear = request('year', now()->year);

        // Mengambil data proyek per bulan berdasarkan tahun yang dipilih
        $projects = Project::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('talent', $userData->name)
            ->whereYear('created_at', $selectedYear)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Inisialisasi data bulan dengan 0
        $monthlyData = array_combine(range(1, 12), array_fill(0, 12, 0));
        foreach ($projects as $project) {
            $monthlyData[$project->month] = $project->total;
        }

        // Menyiapkan data untuk chart
        $months = [];
        $totals = [];
        foreach ($monthlyData as $month => $total) {
            $months[] = Carbon::createFromDate($selectedYear, $month, 1)->format('F Y');
            $totals[] = $total;
        }

        // Mengambil daftar proyek yang telah selesai
        $projectOverview = Project::where('talent', $userData->name)
            ->where('status', 'Done')
            ->select('id', 'comic_name', 'chapter_number', 'number_of_panel', 'updated_at', 'status')
            ->orderBy('updated_at', 'desc')
            ->paginate(3);

        return view('users.Admin.profileUser', compact(
            'userData', 'adminData', 'notification', 'talent', 'talentQc',
            'months', 'totals', 'projectOverview', 'availableYears', 'selectedYear'
        ));
    }




    // Admin Delete User
    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return back()->with('success', 'You have been delete user data.');
    }

    // Admin Edit User
    public function editUser($id)
    {
        $user_data = User::where('id', $id)->first();
        return view('users.Admin.updateUser')->with(['editUser' => $user_data]);
    }

    // Admin Update User
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $update_user = $this->requestUpdateUser($request);
        User::where('id', $id)->update($update_user);

        return redirect(route('admin#listUser'))->with(['userUpdated' => 'User Has Been Updated Successfully!']);
    }
    private function requestUpdateUser($request)
    {
        $arr = [
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'updated_at' => Carbon::now(),
        ];

        return $arr;
    }


    //Partner Role
    public function listTalent()
    {
        $talent_data = Talent::paginate(10);
        $admin_data = User::where('id', Auth::id())->first();
        $notification = Notification::where('email', $admin_data->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        return view('users.Admin.listPartner')
        ->with(['talentData' => $talent_data
        , 'adminData' => $admin_data    , 'notification' => $notification]);

    }

    // Admin Delete Partner
    public function deletePartner($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['partnerDeleted' => 'Partner Has Been Deleted Successfully!']);
    }

    // Admin Edit Partner
    public function editPartner($id)
    {
        $partner_data = Partner::where('id', $id)->first();
        return view('users.Admin.updatePartner')->with(['editPartner' => $partner_data]);
    }

    // Admin Update Partner
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePartner(Request $request, $id)
    {
        $update_partner = $this->requestUpdatePartner($request);
        Partner::where('id', $id)->update($update_partner);
        return redirect()->route('admin#listPartner')->with(['partnerUpdated' => 'Partner Has Been Updated Successfully!']);
    }
    private function requestUpdatePartner($request)
    {
        $array = [
            'partner_organization' => $request->partner_organization,
            'partnership_timeline' => $request->partnership_timeline,
            'updated_at' => Carbon::now()
        ];
        return $array;
    }

    // Member Role
    public function listIntern()
    {
        $intern_data = Intern::paginate(10);
        return view('users.Admin.listMember')->with(['internData' => $intern_data]);
    }

    // Admin Delete Member
    public function deleteMember($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['memberDeleted' => 'Member Has Been Deleted Successfully!!!']);
    }

    // Admin Edit Member
    public function editMember($id)
    {
        $member_data = Member::where('id', $id)->first();
        return view('users.Admin.updateMember')->with(['editMember' => $member_data]);
    }

    // Admin Update Member
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMember(Request $request, $id)
    {
        $update_member = $this->requestUpdateMember($request);
        Member::where('id', $id)->update($update_member);
        return redirect()->route('admin#listMember')->with(['memberUpdated' => 'Member Has Been Updated Successfully!']);
    }
    private function requestUpdateMember($request)
    {
        $array = [
            'member_caregiver_name' => $request->member_caregiver_name,
            'member_caregiver_relation' => $request->member_caregiver_relation,
            'member_caregiver_number' => $request->member_caregiver_number,
            'member_medical_condition' => $request->member_medical_condition,
            'member_start_service' => $request->member_start_service,
            'member_end_service' => $request->member_end_service,
            'updated_at' => Carbon::now()
        ];

        return $array;
    }

    public function talentCV(Request $request)
    {
        $admin_data = User::where('id', Auth::id())->first();

        // Notification
        $notification = Notification::where('email', $admin_data->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        // Dapatkan nilai status dari request, defaultnya adalah null
        $status = $request->input('status');

        // Query CV dengan filter status jika status diberikan
        $query = TalentCV::query();
        if ($status) {
            $query->where('status', $status);
        }

        // Paginate hasil query
        $talent_cv = $query->paginate(10);

        $registrationCodes = Roles::all();

        // Mengirimkan status yang dipilih ke view untuk form filter
        return view('users.Admin.listTalentCV')->with([
            'talentCV' => $talent_cv,
            'status' => $status,
            'registrationCodes' => $registrationCodes,
            'adminData' => $admin_data,
            'notification' => $notification
        ]);
    }


    // Admin Delete User
    public function deleteCV($id)
    {
        TalentCV::where('id', $id)->delete();
        return back()->with(['CVDeleted' => 'Talent CV Has Been Deleted Successfully!']);
    }


    public function declineCV($id){

        $cv = TalentCV::find($id);

        if ($cv) {
            // Ambil email dari data TalentCV
            $userEmail = $cv->email;
            $userName = $cv->name;

            // Kirim email penolakan
            Mail::to($userEmail)->send(new DeclineEmail($userName));

            $cv->status = 'decline';
            $cv->save();


            return redirect()->back()->with(['successCV' => 'CV declined and user notified.']);
        }

        return redirect()->back()->with(['errorCV' => 'CV not found.']);

    }

    public function approveCV(Request $request, $id)
    {
        // Validasi kode registrasi
        $request->validate([
            'registration_code' => 'required|exists:roles,registration_code',
        ]);

        // Ambil data CV berdasarkan ID
        $cv = TalentCV::find($id);

        if ($cv) {
            // Update status menjadi approved
            $cv->status = 'approve';
            $cv->save();


            $registrationCode = $request->input('registration_code');

            Mail::to($cv->email)->send(new ApproveEmail($registrationCode));

            return redirect()->back()->with(['successCV' =>'CV approved, registration code sent to user.']);
        }

        return redirect()->back()->with(['errorCV' => 'CV not found.']);
    }


    public function booking(Request $request, $id)
    {


        try {
            // Set timezone to Bali
            $timezone = 'Asia/Makassar';

            // Parse input date and time and set Bali time zone
            $startTime = Carbon::createFromFormat('Y-m-d H:i', $request->input('meeting_date') . ' ' . $request->input('meeting_time'), $timezone);

            // Add one hour for the end time in Bali time
            $endTime = (clone $startTime)->addHour();

            // Convert to UTC for Google Calendar
            $startDateTimeUTC = $startTime->copy()->setTimezone('UTC');
            $endDateTimeUTC = $endTime->copy()->setTimezone('UTC');

            // Create event in Google Calendar with UTC times
            Event::create([
                'name' => $request->input('name'),
                'startDateTime' => $startDateTimeUTC,
                'endDateTime' => $endDateTimeUTC,
            ]);

            // Retrieve specific emails from input
            $selectedEmails = $request->input('selected_emails');

            // Send invitation emails with Bali time
            foreach ($selectedEmails as $email) {
                Mail::to($email)->send(new MeetingInvitation($startTime, $endTime));
            }

            // If emails were sent successfully, update CV status to "Interview Process"
            $cv = TalentCV::find($id);
            if ($cv) {
                $cv->status = 'Interview Process';
                $cv->save();
            } else {
                return redirect()->back()->with(['error' => 'CV not found']);
            }

            return redirect()->back()->with(['successCV' => 'The invitation has been successfully sent, and the CV status has been updated.']);

        } catch (\Exception $e) {
            \Log::error("Error in booking function: " . $e->getMessage());
            return redirect()->back()->with(['errorCV' => 'An error occurred while sending the invitation.']);
        }
    }


    public function getUserSubmissions($encryptedId)
    {
        // Ambil data admin berdasarkan ID pengguna yang login
        $adminData = User::find(Auth::id());

        // Dekripsi ID pengguna
        $userId = Crypt::decrypt($encryptedId);

        // Get notification
        $notification = Notification::get();

        // Ambil data pengguna beserta submission dan vote
        $user = User::with(['submissions' => function ($query) {
            $query->with(['votes' => function ($query) {
                $query->selectRaw('submission_id, SUM(vote_value) as total_vote_value')

                    ->groupBy('submission_id');

            }]);
        }])->findOrFail($userId);

        // Kembalikan view dengan data yang diperlukan
        return view('users.Admin.submission', compact('user', 'adminData', 'notification'));
    }


    // Manage Project
    public function projectOverview(){
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang berhubungan dengan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
        ->orWhere('email', $user->email) // For general notifications based on the authenticated user's email
        ->get();

        $talent_qc = User::where('role', 'talent_qc')->get();


        // Ambil semua data projects
        $projectOverview = Project::get();

        // Project Type
        $projectTypes = ProjectType::all();

        return view('users.Admin.manageProject')->with([
            'adminData' => $user,
            'notification' => $notifications,
            'projectOverview' => $projectOverview,
            'talentQc' => $talent_qc,
            'projectTypes' => $projectTypes

        ]);
    }

    public function detail($id)
    {

        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang bersifat 'urgent' atau notifikasi berdasarkan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
            ->orWhere('email', $user->email)
            ->get();

        // Cari proyek berdasarkan ID yang telah didekripsi
        $project = Project::findOrFail($id);

        // Ambil data project Records
        $records = ProjectRecord::where('project_id', $id)->get();

        // Ambil data project log berdasarkan project_id
        $projectLogs = ProjectLog::where('project_id', $id)
            ->get();


        // Ambil data status berdasarkan project_id
        $projectStatuses = Status::where('project_id', $id)->get();

        // Ambil semua data SOPs
        $sops = Sop::all();

        // Mengambil data SOP Checklists
        $sopChecklists = SopChecklist::where('project_id', $id)
            ->get();

        // Mengambil project QC records
        $qcRecords = ProjectRecord::where('project_id', $id)
            ->get();

        // Ambil semua data revise records
        $reviseRecords = ProjectRevise::where('project_id', $id)
            ->get();

        // // // Menghitung waktu project duration dari Project assign sampai Done
        // $projectLogs = ProjectLog::where('project_id', $id)
        //     ->whereIn('status', ['Project Assign', 'Done'])
        //     ->orderBy('timestamp')
        //     ->get();


        // // Get the start time (Project Assign)
        // $startTime = $projectLogs->where('status', 'Project Assign')->first();

        // // Get the end time (Done)
        // $endTime = $projectLogs->where('status', 'Done')->first();

        // $start = Carbon::parse($startTime->timestamp);
        // $end = Carbon::parse($endTime->timestamp);


        // // Calculate the total difference in minutes first
        // $totalMinutes = $end->diffInMinutes($start);

        // // Calculate days, hours, and remaining minutes
        // $days = floor($totalMinutes / 1440); // 1440 minutes in a day
        // $hours = floor(($totalMinutes % 1440) / 60); // Remaining hours
        // $minutes = $totalMinutes % 60; // Remaining minutes

        // // Format the duration string
        // $formatted_duration = '';

        // if ($days > 0) {
        //     $formatted_duration .= $days . ' ' . ($days == 1 ? 'day' : 'days');
        // }

        // if ($hours > 0) {
        //     if ($formatted_duration !== '') {
        //         $formatted_duration .= ', ';
        //     }
        //     $formatted_duration .= $hours . ' ' . ($hours == 1 ? 'hour' : 'hours');
        // }

        // if ($minutes > 0) {
        //     if ($formatted_duration !== '') {
        //         $formatted_duration .= ', ';
        //     }
        //     $formatted_duration .= $minutes . ' ' . ($minutes == 1 ? 'minute' : 'minutes');
        // }

        // // If duration is less than a minute
        // if ($formatted_duration === '') {
        //     $formatted_duration = 'Less than a minute';
        // }



        // Kirim data proyek ke tampilan
        return view('users.Admin.projectDetail')->with([
            'adminData' => $user,
            'notification' => $notifications,
            'projectData' => $project,
            'projectLogs' => $projectLogs,
            'statuses' => $projectStatuses,
            'projectRecords' => $records,
            'sops' => $sops,
            'sopChecklists' => $sopChecklists,
            'qcRecords' => $qcRecords,
            'reviseRecords' => $reviseRecords,
            // 'formatted_duration' => $formatted_duration

        ]);
    }

        // admin submit revise
        public function storeProjectRevise(Request $request)
        {
            $validatedData = $request->validate([
                'project_id' => 'required|exists:projects,id',
                'user_id' => 'required|exists:users,id',
                'revise_message' => 'required|string',
            ]);

                        // Get the current project
            $project = Project::findOrFail($request->project_id);

            // Determine project_stage based on current status
            $projectStageMap = [
                'First Draft Submitted' => 'Revise 1',
                'Revise 1 Submitted' => 'Revise 2',
                'Revise 2 Submitted' => 'Revise 3',
            ];

            $validatedData['revise_stage'] = $projectStageMap[$project->status] ?? 'Unknown Stage';

            // Simpan project revise menggunakan instance model
            $projectRecord = new ProjectRevise();
            $projectRecord->project_id = $validatedData['project_id'];
            $projectRecord->user_id = $validatedData['user_id'];
            $projectRecord->revise_stage = $validatedData['revise_stage'];
            $projectRecord->revise_message = $validatedData['revise_message'];
            $projectRecord->save();

            // Validasi apabila project tidak di save
            if (!$projectRecord) {
                return redirect()->back()->with('error', 'Failed to save project record.');
            }

            // Ambil project yang terkait
            $project = Project::find($request->project_id);

            // Update status berdasarkan project_stage dan simpan data baru di tabel Statuses
            $statusUpdates = [
                'Revise 1' => ['status' => 'Revise 1', 'status_type_id' => 4],
                'Revise 2' => ['status' => 'Revise 2', 'status_type_id' => 7],
                'Revise 3' => ['status' => 'Revise 3', 'status_type_id' => 10],
            ];

            $talentName = $project->talent;
            $talent = User::where('name', $talentName)->first();
            $user = User::find($request->user_id);

            if (isset($statusUpdates[$validatedData['revise_stage']])) {
                $statusData = $statusUpdates[$validatedData['revise_stage']];

                // Update project status
                $project->update(['status' => $statusData['status']]);

                // Create status record
                Status::create([
                    'project_id' => $project->id,
                    'status_type_id' => $statusData['status_type_id'],
                ]);

                // Create project log
                ProjectLog::create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                    'talent_qc' => $project->talent_qc ?? 'N/A',
                    'timestamp' => now(),
                    'status' => $statusData['status'],
                ]);

                // Simpan notifikasi
                Notification::create([
                    'email' => $user->email,
                    'subject' => "You Already send {$request->project_stage} of {$project->comic_name} Chapter {$project->chapter_number}",
                    'message' => "The project stage has been successfully submitted. Please wait for the next stage.",
                    'notif_type' => 'general',
                ]);

                // Notifikasi untuk Talent dengan email talent
                Notification::create([
                    'email' => $talent->email,
                    'subject' => "{$user->name} Already Submit revise of {$project->comic_name} Chapter {$project->chapter_number}",
                    'message' => "The project stage has been successfully submitted. Please wait for the next stage.",
                    'notif_type' => 'general',
                ]);


            }

            // Alert sukses
            return redirect()->back()->with('success', 'You have successfully Add New Revise.');
        }


        // Project Mark as Done
        public function storeProjectDone(Request $request, $id)
        {


            // Mengambil data project berdasarkan ID
            $project = Project::findOrFail($id);

            // Melakukan Update Project Status menjadi Done dan finish date hari ini
            $project->update([
                'status' => 'Done',
                'finish_date' => Carbon::now(),
            ]);

            // Menyimpan data baru ke tabel 'statuses' dengan status_type_id = 13
            Status::create([
                'project_id' => $id,
                'status_type_id' => 13,
            ]);

            // Menyimpan data baru ke tabel 'project_logs'
            ProjectLog::create([
                'project_id' => $id,
                'user_id' => Auth::id(),
                'talent_qc' => $project->talent_qc ?? 'N/A',
                'timestamp' => Carbon::now(),
                'status' => 'Done',
            ]);

            // Kirim email ke Talent dan Talent QC
            $talent = User::where('name', $project->talent)->first();
            $talentQc = User::where('name', $project->talent_qc)->first();

            // Mengirim notifikasi ke Talent, Talent QC, dan user yang ter-auth
            Notification::create([
                'email' => $talent->email,
                'subject' => "Congrats! {$project->comic_name} Eps {$project->chapter_name} marked as Done",
                'message' => "The project has been successfully completed.",
                'notif_type' => 'general',
            ]);

            Notification::create([
                'email' => $talentQc->email,
                'subject' => "Congrats! {$project->comic_name} Eps {$project->chapter_name} marked as Done",
                'message' => "The project has been successfully completed.",
                'notif_type' => 'general',
            ]);

            Notification::create([
                'email' => Auth::user()->email,
                'subject' => "Congrats! {$project->comic_name} Eps {$project->chapter_name} marked as Done",
                'message' => "The project has been successfully completed.",
                'notif_type' => 'general',
            ]);


            return redirect()->back()->with('success', 'Project has been marked as Done!');
        }





    public function validatePassword(Request $request) {
        $admin = Auth::user();
        if (Hash::check($request->password, $admin->password)) {
            return response()->json(['valid' => true]);
        }
        return response()->json(['valid' => false]);
    }



    public function submitCSV(Request $request)
    {
        try {
            // Validate file
            $request->validate([
                'csv_file' => 'required|mimes:csv,txt|max:2048'
            ]);

            // Ensure we have an authenticated user
            if (!Auth::check()) {
                return redirect()->back()->with('error', 'You must be logged in to import projects');
            }

            $file = $request->file('csv_file');
            $csvData = array_map('str_getcsv', file($file->getRealPath()));

            // Remove header row
            array_shift($csvData);

            DB::beginTransaction();

            foreach ($csvData as $row) {
                // Skip empty rows
                if (empty(array_filter($row))) {
                    continue;
                }

                // Create project with data directly from CSV
                $project = new Project();
                $project->user_id = Auth::id(); // Explicitly set user_id
                $project->project_type_id = trim($row[0]);
                $project->comic_name = trim($row[1]);
                $project->chapter_number = (int)trim($row[2]);
                $project->talent_qc = trim($row[3]);
                $project->talent = trim($row[4]);
                $project->number_of_panel = !empty($row[5]) ? (int)trim($row[5]) : null;
                $project->finish_date = !empty($row[6]) ? Carbon::parse(trim($row[6])) : null;
                $project->file = trim($row[7]);
                $project->status = !empty($row[8]) ? trim($row[8]) : 'Done';
                $project->save();

                // Create project log entry
                ProjectLog::create([
                    'project_id' => $project->id,
                    'project_type_id' => $project->project_type_id,
                    'user_id' => Auth::id(),
                    'talent_qc' => $project->talent_qc,
                    'timestamp' => now(),
                    'status' => $project->status
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Projects imported successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error importing CSV: ' . $e->getMessage());
        }
    }

    public function storeProjectType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_types,name'
        ]);

        $projectType = new ProjectType();
        $projectType->name = $request->name;
        $projectType->save();

        return redirect()->back()->with('success', 'Project type created successfully');
    }

    // update project Types
    public function updateProjectType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_types,name'
        ]);

    }

    // delete project Types
    public function deleteProjectType($id)
    {
        $projectType = ProjectType::find($id);
        $projectType->delete();
        return redirect()->back()->with('success', 'Project type deleted successfully');
    }

    public function deleteProject($id)
    {
        try {
            $project = Project::findOrFail($id);

            // Delete related records first
            ProjectLog::where('project_id', $id)->delete();
            ProjectRecord::where('project_id', $id)->delete();
            SopChecklist::where('project_id', $id)->delete();
            QcRecords::where('project_id', $id)->delete();
            ProjectRevise::where('project_id', $id)->delete();

            // Finally delete the project
            $project->delete();

            return redirect()->back()->with('success', 'Project deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete project. ' . $e->getMessage());
        }
    }

    public function updateProject(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'project_type_id' => 'required|exists:project_types,id',
                'comic_name' => 'required|string|max:255',
                'chapter_number' => 'required|integer',
                'talent_qc' => 'required|exists:users,id',
                'file' => 'required|string',
            ]);

            $project = Project::findOrFail($id);

            // Get talent QC name from ID
            $talentQc = User::find($validated['talent_qc']);

            // Update project
            $project->project_type_id = $validated['project_type_id'];
            $project->comic_name = $validated['comic_name'];
            $project->chapter_number = $validated['chapter_number'];
            $project->talent_qc = $talentQc->name;
            $project->file = $validated['file'];
            $project->save();

            // Create project log for the update
            ProjectLog::create([
                'project_id' => $project->id,
                'project_type_id' => $project->project_type_id,
                'user_id' => auth()->id(),
                'talent_qc' => $project->talent_qc,
                'timestamp' => Carbon::now(),
                'status' => $project->status,
            ]);

            // Create notification for the new QC
            Notification::create([
                'notif_type' => "general",
                'subject' => "Project Updated",
                'message' => "Project '{$project->comic_name}' (Chapter {$project->chapter_number}) has been updated.",
                'email' => $talentQc->email,
            ]);

            return redirect()->back()->with('success', 'Project updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update project. ' . $e->getMessage());
        }
    }

    public function updateRevise(Request $request, $id)
    {
        try {
            $revise = ProjectRevise::findOrFail($id);

            $request->validate([
                'revise_message' => 'required|string'
            ]);

            $revise->update([
                'revise_message' => $request->revise_message
            ]);

            return redirect()->back()->with('success', 'Revision updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update revision');
        }
    }

    public function deleteRevise($id)
    {
        try {
            $revise = ProjectRevise::findOrFail($id);
            $revise->delete();

            return redirect()->back()->with('success', 'Revision deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete revision');
        }
    }

    // upday



}
