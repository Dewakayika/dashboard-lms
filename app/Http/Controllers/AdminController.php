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
    public function overview(){
        $admin_data = User::where('id', Auth::id())->first();

        $notification = Notification::get();
        // Get Project with "Waiting Talent" status
        $waitingProjects = Project::where('status', 'waiting talent')->paginate(10);

        return view ('users.Admin.Overview')->with([
            'adminData' => $admin_data,
            'projectsList' => $waitingProjects,
            'notification' => $notification
        ]);
    }

    public function createProject()
    {
        $admin_data = User::where('id', Auth::id())->first();

        $notification = Notification::get();

        // Mendapatkan list semua user dengan role 'talent_qc'
        $talent_qc = User::where('role', 'talent_qc')->get();

        return view('users.Admin.createNewProject')->with([
            'adminData' => $admin_data,
            'talentQc' => $talent_qc,
            'notification' => $notification
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

        // Kirim email ke talent QC
        Mail::to($talentQc->email)->send(new TalentQcAssigned($project));

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
    public function index()
    {
        // Hitung total user, intern, talent, dan role
        $user_data = User::count();
        $intern_data = Intern::count();
        $talent_data = Talent::count();
        $role_count = Roles::count();
        $role_data = Roles::paginate(10);

        $admin_data = User::where('id', Auth::id())->first();

        $notification = Notification::get();

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

        return view('users.Admin.createRole')->with([ 'adminData' => $admin_data,]);
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
        return view('users.Admin.updateRole')->with(['editRole' => $role_data]);
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

        return view('users.Admin.listUser')->with(['userData' => $user_data, 'role' => $role]);
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
        return view('users.Admin.listPartner')->with(['talentData' => $talent_data]);
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

        // Ambil data pengguna beserta submission dan vote
        $user = User::with(['submissions' => function ($query) {
            $query->with(['votes' => function ($query) {
                $query->selectRaw('submission_id, SUM(vote_value) as total_vote_value')
                      ->groupBy('submission_id');
            }]);
        }])->findOrFail($userId);

        // Kembalikan view dengan data yang diperlukan
        return view('users.Admin.submission', compact('user', 'adminData'));
    }



}
