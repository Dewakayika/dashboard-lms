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

use Google\Service\Calendar\Event as GoogleEvent;
use Google\Service\Calendar; // For Calendar service
use Google\Service\Calendar\EventDateTime; // For EventDateTime class
use Google\Service\Calendar\ConferenceData; // For ConferenceData class
use Google\Service\Calendar\ConferenceDataCreateRequest; // For ConferenceDataCreateRequest class
use Google\Service\Calendar\ConferenceSolutionKey;




class AdminController extends Controller
{
    public function index(){

        $admin_data = User::where('id', Auth::id())->first();

        // Count all Project based on Status
        $projectWaiting = Project::where('status', 'Waiting Talent')->count();
        $projectDraft = Project::whereIn('status', ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted'])->count();
        $projectRevise = Project::whereIn('status', ['Revise 1', 'Revise 2', 'Revise 3'])->count();
        $projectQC = Project::where('status', ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3'])->count();
        $projectCompleted = Project::where('status', 'Done')->count();
        $totalProject = Project::count();

        // Menghitung total proyek di tahun ini
        $totalProjectThisYear = Project::whereYear('created_at', Carbon::now()->year)->count();

        //Menghitung total waktu timestamp yang diperlukan dari statusnya Project Assign ke First Draft Submitted pada tabel project_logs
        $projects = ProjectLog::select('project_id', 'status', 'timestamp')
        ->whereIn('status', ['Project Assign', 'First Draft Submitted'])
        ->orderBy('project_id')
        ->orderBy('timestamp')
        ->get()
        ->groupBy('project_id');

        $totalDuration = 0;
        $projectCount = 0;

        foreach ($projects as $projectLogs) {
            $assignLog = $projectLogs->firstWhere('status', 'Project Assign');
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


            // Mengambil total proyek per bulan
        $projects = Project::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Mengonversi data ke format yang dapat digunakan di chart
        $months = [];
        $totals = [];

        foreach ($projects as $project) {
            $months[] = Carbon::createFromDate($project->year, $project->month, 1)->format('F Y');
            $totals[] = $project->total;
        }


        // Total Panel
        $totalPanel = Project::sum('number_of_panel');

        $notification = Notification::where('email', $admin_data->email)
            ->orWhere('notif_type', 'urgent')
            ->get();

        // Get Project with "Waiting Talent" status
        $waitingProjects = Project::where('status', 'waiting talent')->paginate(10);

        return view ('users.Admin.Overview')->with([
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


    // Project Time Statistic
    public function projectTimeStatistic(){
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang berhubungan dengan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
        ->orWhere('email', $user->email) // For general notifications based on the authenticated user's email
        ->get();

        // Mengambil data seluruh user dan menghitung jumlah proyek yang telah dia seleesaikan.
        $userProjects = Project::select(
            'talent',
            'users.id as user_id',  // Add this to get user ID
            DB::raw('COUNT(*) as total_projects'),
            DB::raw('SUM(number_of_panel) as total_panels')
        )
        ->join('users', 'users.name', '=', 'projects.talent')  // Join with users table
        ->where('projects.status', 'Done')   
        ->groupBy('talent', 'users.id')  
        ->get();



        // Mengambil nama talent di tabel project
        $projectOverview = Project::select('talent');
        
        // Melakukan kalkulasi waktu timestamp sejak status 'Project Assign' sampai 'First Draft Submitted' pada tabel project log kemudian mengambil project ID, setelah ID di temukan dilakukan pencarian siapa 'talent' dari project ID tersebut.
        // Retrieve all projects with their associated talent names
        $projects = Project::select('id as project_id', 'talent')->get();
        
        $talentDurations = [];
        $talentProjectCounts = []; // To track the number of projects for each talent

        foreach ($projects as $project) {
            // Retrieve project logs for the relevant statuses
            $projectLogs = ProjectLog::select('status', 'timestamp')
                ->where('project_id', $project->project_id)
                ->whereIn('status', ['Project Assign', 'First Draft Submitted'])
                ->orderBy('timestamp')
                ->get();

            // Check if we have both logs
            if ($projectLogs->count() < 2) {
                continue; // Skip if there are not enough logs
            }

            $assignLog = $projectLogs->firstWhere('status', 'Project Assign');
            $firstDraftLog = $projectLogs->firstWhere('status', 'First Draft Submitted');

            if ($assignLog && $firstDraftLog) {
                $assignTime = Carbon::parse($assignLog->timestamp);
                $firstDraftTime = Carbon::parse($firstDraftLog->timestamp);
                $duration = $firstDraftTime->diffInSeconds($assignTime);

                // Store the duration for the talent
                if (!isset($talentDurations[$project->talent])) {
                    $talentDurations[$project->talent] = 0;
                    $talentProjectCounts[$project->talent] = 0; // Initialize project count
                }

                $talentDurations[$project->talent] += $duration;
                $talentProjectCounts[$project->talent]++; // Increment project count
            }
        }

        // Prepare the final response with talent names, their total durations, and average durations
        $result = [];
        $talentNames = [];
        $totalDurations = [];
        $averageDurationsInHours = []; // New array to store average durations in hours

        foreach ($talentDurations as $talent => $totalDuration) {
            $averageDurationInSeconds = $talentProjectCounts[$talent] > 0 ? $totalDuration / $talentProjectCounts[$talent] : 0;
            
            // Calculate average duration in hours and format it
            $averageDurationInHours = $averageDurationInSeconds / 3600; // Convert seconds to hours
            $formattedAverageDuration = gmdate("H:i:s", $averageDurationInSeconds); // Format as hours:minutes:seconds

            $result[] = [
                'talent_name' => $talent,
                'total_seconds' => $totalDuration,
                'formatted_duration' => gmdate("H:i:s", $totalDuration), // Format as hours:minutes:seconds
                'average_seconds' => $averageDurationInSeconds,
                'average_hours' => $averageDurationInHours, // Store average in hours
                'formatted_average_duration' => $formattedAverageDuration // Format average duration
            ];

            // Prepare data for the chart
            $talentNames[] = $talent;
            $totalDurations[] = $totalDuration;
            $averageDurationsInHours[] = $averageDurationInHours; // Store average in hours for the chart
        }

        usort($result, function ($a, $b) {
            return $a['average_seconds'] <=> $b['average_seconds'];
        });

        // Fetch user data based on talent names
        $users = User::whereIn('name', $talentNames)->get()->keyBy('name');

        // Add email and profile information to the result
        foreach ($result as &$talent) {
            if (isset($users[$talent['talent_name']])) {
                $talent['email'] = $users[$talent['talent_name']]->email;
            } else {
                $talent['email'] = null; // Handle case where user is not found
            }
        }


        return view('users.Admin.projectTimeOverview')->with([
            'adminData' => $user,
            'notification' => $notifications,
            'projectOverview' => $projectOverview,
            'result' => $result,
            'talentNames' => $talentNames,
            'totalDurations' => $totalDurations,
            'averageDurations' => $averageDurationsInHours,
            'userProjects' => $userProjects,

        ]);
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'comic_name' => 'required|string|max:255',
            'chapter_number' => 'required|integer',
            'talent_qc' => 'required|exists:users,id', // Pastikan ID talent QC valid
            'number_of_panel' => 'required|integer',
            'file' => 'required|string',
        ]);

        // Cari data user berdasarkan ID talent_qc
        $talentQc = User::find($validated['talent_qc']);

        $project = new Project();
        $project->user_id = auth()->id();
        $project->comic_name = $validated['comic_name'];
        $project->chapter_number = $validated['chapter_number'];
        $project->talent_qc = $talentQc->name; // Simpan nama talent QC
        $project->number_of_panel = $validated['number_of_panel'];
        $project->file = $validated['file'];
        $project->status = 'Waiting Talent';
        $project->save();

        // Simpan detail email yang dikirim ke tabel "notifikasi"
        Notification::create([
            'notif_type' => "urgent",
            'subject' => "New Project Has been Created!",
            'message' => "{$talentQc->email} have been assigned as QC for the project '{$project->comic_name}' (Chapter {$project->chapter_number}). Please check your dashboard for details.",
            'email' => $talentQc->email,
        ]);

        return redirect()->route('admin#createNewProject')->with('success', 'Project created successfully, email sent to Talent QC, and notification recorded!');
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


        // Return ke view dengan data yang telah diambil
        return view('users.Admin.dashboard')->with([
            'adminData' => $admin_data,
            'userData' => $user_data,
            'internData' => $intern_data,
            'talentData' => $talent_data,
            'countRole' => $role_count,
            'roleData' => $role_data,
            'leaderboard' => $leaderboard, // Tambahkan leaderboard di sini
            'notification' => $notification
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
        $user_data = User::where('id', Auth::id())->first();
        return view('users.Admin.adminProfile')->with(['userData' => $user_data]);
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

        if ($role == 'Intern') {
            // Mendapatkan data Intern saja
            $user_data = User::whereHas('intern')->with('intern')->paginate(10);
        } elseif ($role == 'Talent') {
            // Mendapatkan data Talent saja
            $user_data = User::whereHas('talent')->with('talent')->paginate(10);
        } else {
            // Default: Mendapatkan semua data (Intern dan Talent)
            $user_data = User::with(['talent', 'intern'])->paginate(10);
        }

        return view('users.Admin.listUser')->with(['userData' => $user_data, 'role' => $role])
            ->with(['adminData' => $admin_data,
                    'notification' => $notification]);
    }


    // Profile User by Id
    public function profileUser($id)
    {
        $user_data = User::where('id', $id)->first();
        // mengambil data talent dan talent qc berdasarkan ID
        $talent=Talent::where('user_id', $id)->first();
        $talentQc=TalentQC::where('user_id', $id)->first();

        $admin_data = User::where('id', Auth::id())->first();

        $notification = Notification::where('email', $admin_data->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        $projects = Project::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
        ->where('talent', $user_data->name)  // Add this line to filter by talent name
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Convert data for chart
        $months = [];
        $totals = [];

        foreach ($projects as $project) {
            $months[] = Carbon::createFromDate($project->year, $project->month, 1)->format('F Y');
            $totals[] = $project->total;
        }



        $projectOverview = Project::where('talent', $user_data->name)
        ->where('status', 'Done')
        ->select(
            'id',
            'comic_name',
            'chapter_number',
            'number_of_panel',
            'updated_at',
            'status'
        )
        ->orderBy('updated_at', 'desc')
        ->get();
        

        return view('users.Admin.profileUser')->with([
            'userData' => $user_data, 
            'adminData' => $admin_data, 
            'notification' => $notification,
            'talent' => $talent,
            'talentQc' => $talentQc,
            'projectOverview' => $projectOverview,
            'months' => $months,
            'totals' => $totals,
        ]);
    }
    


    // Admin Delete User
    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['userDeleted' => 'User Has Been Deleted Successfully!']);
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

            // Ambil kode registrasi yang dipilih
            $registrationCode = $request->input('registration_code');

            // Kirim email pemberitahuan persetujuan dengan kode registrasi
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


        // Ambil semua data projects
        $projectOverview = Project::paginate(10);

        return view('users.Admin.manageProject')->with([
            'adminData' => $user,
            'notification' => $notifications,
            'projectOverview' => $projectOverview

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
        $qcRecords = QcRecords::where('project_id', $id)
            ->get();

        // Ambil semua data revise records
        $reviseRecords = ProjectRevise::where('project_id', $id)
            ->get();

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
            'reviseRecords' => $reviseRecords
        ]);
    }

        // admin submit revise
        public function storeProjectRevise(Request $request)
        {
            $validatedData = $request->validate([
                'project_id' => 'required|exists:projects,id',
                'user_id' => 'required|exists:users,id',
                'revise_stage' => 'required|string',
                'number_of_panel' => 'required|integer',
                'revise_message' => 'required|string',
            ]);

            // Simpan project revise menggunakan instance model
            $projectRecord = new ProjectRevise();
            $projectRecord->project_id = $validatedData['project_id'];
            $projectRecord->user_id = $validatedData['user_id'];
            $projectRecord->revise_stage = $validatedData['revise_stage'];
            $projectRecord->number_of_panel = $validatedData['number_of_panel'];
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

            if (isset($statusUpdates[$request->revise_stage])) {
                $statusData = $statusUpdates[$request->revise_stage];

                // Update status di tabel Project
                $project->update([
                    'status' => $statusData['status'],
                ]);

                // Simpan data baru ke tabel Statuses
                Status::create([
                    'project_id' => $project->id,
                    'status_type_id' => $statusData['status_type_id'],
                ]);

                // Menyimpan Data baru untuk project_log
                $log = ProjectLog::create([
                    'project_id' => $project->id,
                    'user_id' => $validatedData['user_id'],
                    'talent_qc' => $project->talent_qc ?? 'N/A',
                    'timestamp' => Carbon::now(),
                    'status' => $statusData['status'],
                ]);

                $deadline = Carbon::parse($log->timestamp)->addHours(30);

            }

            // Kirim email
            $talentName = $project->talent;
            $talent = User::where('name', $talentName)->first();
            $user = User::find($request->user_id);

            if ($talent) {
                // Kirim email ke Talent dan Talent QC
                Mail::send('emails.revise', [
                    'talentName' => $talent->name,
                    'projectStage' => $request->revise_stage,
                    'projectName' => $project->name
                ], function ($message) use ($talent, $user) {
                    $message->to([$talent->email, $user->email])
                            ->subject("Project Revision");
                });
            }

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

            // Alert sukses
            return redirect()->back()->with('success', 'You have successfully Add New Revise.');
        }


        // Project Mark as Done
    public function storeProjectDone(Request $request, $id){

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

        // Kirim email ke Talent dan talent_qc
        $talent = User::where('name', $project->talent)->first();
        $talentQc = User::where('name', $project->talent_qc)->first();

        if ($talent && $talentQc) {
            // Kirim email ke Talent dan Talent QC
            Mail::send('emails.projectDone', [
                'talentName' => $talent->name,
                'talentQcName' => $talentQc->name,
                'projectName' => $project->comic_name,
                'projectChapter' => $project->chapter_number,
            ], function ($message) use ($talent, $talentQc) {
                $message->to([$talent->email, $talentQc->email])
                        ->subject("Project Done");
            });
        }

        // Mengirim notifikasi ke Talent, talent qc, dan user yang ter auth
        Notification::create([
            'email' => $talent->email,
            'subject' => "Congrast! {$project->comic_name} Eps {$project->chapter_name} mark as Done",
            'message' => "The project has been successfully completed.",
            'notif_type' => 'general',
        ]);

        Notification::create([
            'email' => $talentQc->email,
            'subject' => "Congrast! {$project->comic_name} Eps {$project->chapter_name} mark as Done",
            'message' => "The project has been successfully completed.",
            'notif_type' => 'general',
        ]);

        Notification::create([
            'email' => Auth::user()->email,
            'subject' => "Congrast! {$project->comic_name} Eps {$project->chapter_name} mark as Done",
            'message' => "The project has been successfully completed.",
            'notif_type' => 'general',
        ]);


        return redirect()->back()->with('success', 'Project has been marked as Done!.');


    }

}
