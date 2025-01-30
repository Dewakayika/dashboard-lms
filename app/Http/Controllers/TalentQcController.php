<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Driver;
use App\Models\Meal;
use App\Models\Order;
use App\Models\User;
use App\Models\Talent;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ApplyProject;
use App\Models\Status;
use App\Models\ProjectLog;
use App\Models\ProjectRecord;
use App\Models\TalentQc;
use App\Models\Sop;
use App\Models\SopChecklist;
use App\Models\QcRecords;
use App\Models\ProjectRevise;
use App\Models\ProjectComplexity;
use App\Models\QcReview;
use App\Models\TalentReview;
use App\Models\TalentSop;


use Illuminate\Support\Facades\DB;
use App\Mail\ApplyProjectMail;
use App\Mail\NotifyTalentQcMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;




class TalentQcController extends Controller
{
    //
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Cek apakah pengguna memiliki data Talent
        if (!TalentQc::where('user_id', $user->id)->exists()) {
            return view('users.Partner.register-talentqc');
        } else {
            // Ambil data Talent berdasarkan user_id
            $talent_data = TalentQc::where('user_id', $user->id)->first();

        }

        // Ambil semua notifikasi yang berhubungan dengan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
        ->orWhere('email', $user->email) // For general notifications based on the authenticated user's email
        ->get();

        // Ambil semua proyek yang statusnya 'waiting talent' dan pastikan talent_qc bukan nama pengguna yang sedang login
        $projectsOffer = Project::where('status', 'waiting talent')
        ->where('talent_qc', '!=', $user->name)
        ->with(['projectComplexity' => function($query) {
            $query->select('comic_name',
                DB::raw('AVG(complexity) as average_complexity'))
            ->groupBy('comic_name');
        }])
        ->paginate(7);

        // Ambil proyek yang telah dilamar oleh pengguna berdasarkan user_id
        $appliedProjects = ApplyProject::where('user_id', $user->id)->get(); // Mengambil proyek yang dilamar oleh user_id

        // Ambil status proyek untuk proyek yang telah dilamar oleh user_id
        $projectStatuses = Status::whereIn('project_id', $appliedProjects->pluck('project_id'))->get();

        // Group project statuses by project_id
        $groupedProjectStatuses = $projectStatuses->groupBy('project_id');

        // Ambil data proyek log kemudian cek id proyek apakah proyek tersebut memiliki nama "talent" yang ter auth.
        $projectLogs = ProjectLog::whereIn('project_id', $appliedProjects->pluck('project_id'))
            ->where('talent_qc', $user->name)
            ->get();

        // Mengambil semua data project dengan nama talent sesuai user yang ter auth
        $projectOverview = Project::where('talent', $user->name)
            ->paginate(10);


        $projectQcOverview = Project::where('talent_qc', $user->name)
        ->paginate(10);
                // Data overview
        $onGoingProject = Project::where('talent', $user->name)
        // satatus tidak sama dengan "Done"
            ->where('status', '!=', 'Done')
            ->count();

        $projectThisMonth = Project::where('talent', $user->name)
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->count();

        $AllProject = Project::where('talent', $user->name)
            ->count();

        // Donut Chart Data
        $projectAssign = Project::where('talent', $user->name)
            ->where('status', 'Project Assign')
            ->count();

        $projectQc = Project::where('talent', $user->name)
            ->where('status', ['QC First Draft', 'QC Revise 1', 'QC Revise 2', 'QC Revise 3'])
            ->count();

        $projectDraft = Project::where('talent', $user->name)
            ->where('status', ['First Draft Submitted', 'Revise 1 Submitted', 'Revise 2 Submitted', 'Revise 3 Submitted'])
            ->count();

        $projectRevise = Project::where('talent', $user->name)
            ->where('status', ['Revise 1', 'Revise 2', 'Revise 3'])
            ->count();

        $projectCompleted = Project::where('talent', $user->name)
            ->where('status', 'Done')
            ->count();

        $projectQc = Project::where('talent_qc', $user->name)
            ->count();

        $projectQcOverview = Project::where('talent_qc', $user->name)
            ->paginate(10);

            $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login
            $userName = auth()->user()->name; // Mendapatkan nama pengguna yang sedang login

            $projectsWithoutComplexity = Project::where('status', 'Done') // Filter proyek dengan status 'Done'
                ->where('talent', $userName) // Filter proyek dengan talent_qc yang sesuai dengan nama pengguna yang sedang login
                ->leftJoin('project_complexities', function ($join) use ($userId) {
                    $join->on('projects.id', '=', 'project_complexities.project_id')
                         ->where('project_complexities.user_id', '=', $userId); // Filter berdasarkan user_id
                })
                ->whereNull('project_complexities.id') // Pastikan entri di project_complexities belum ada
                ->select('projects.*') // Ambil data proyek yang sudah disaring
                ->get();

            $projectsqcWithoutComplexity = Project::where('status', 'Done') // Filter proyek dengan status 'Done'
                ->where('talent_qc', $userName) // Filter proyek dengan talent_qc yang sesuai dengan nama pengguna yang sedang login
                ->leftJoin('project_complexities', function ($join) use ($userId) {
                    $join->on('projects.id', '=', 'project_complexities.project_id')
                         ->where('project_complexities.user_id', '=', $userId); // Filter berdasarkan user_id
                })
                ->whereNull('project_complexities.id') // Pastikan entri di project_complexities belum ada
                ->select('projects.*') // Ambil data proyek yang sudah disaring
                ->get();


            // Kirim data Talent, User, Notifikasi, Proyek, dan Status Proyek ke view
            return view('users.TalentQC.talentIndex')->with([
                'talentData' => $talent_data,
                'userData' => $user,
                'notification' => $notifications,
                'projects' => $projectsOffer,
                'groupedProjectStatuses' => $groupedProjectStatuses,
                'projectLogs' => $projectLogs,
                'projectOverview' => $projectOverview,
                'onGoingProject' => $onGoingProject,
                'projectThisMonth' => $projectThisMonth,
                'AllProject' => $AllProject,
                'projectAssign' => $projectAssign,
                'projectQc' => $projectQc,
                'projectDraft' => $projectDraft,
                'projectRevise' => $projectRevise,
                'projectCompleted' => $projectCompleted,
                'projectQc' => $projectQc,
                'projectQcOverview' => $projectQcOverview,
                'projectsWithoutComplexity' => $projectsWithoutComplexity,
                'projectsqcWithoutComplexity' => $projectsqcWithoutComplexity,

            ]);

    }


    public function apply(Request $request, $projectId)
    {
        $user = Auth::user();

        // Cek apakah user sudah pernah apply ke project ini
        if (ApplyProject::where('project_id', $projectId)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this project.');
        }

        // Simpan data ke tabel apply_projects
        $apply = ApplyProject::create([
            'project_id' => $projectId,
            'user_id' => $user->id,
        ]);

        // Perbarui status dan talent pada tabel projects
        $project = Project::findOrFail($projectId);
        $project->update([
            'status' => 'Project Assign',
            'talent' => $user->name, // Mengisi kolom talent dengan nama user yang apply
        ]);

        // Simpan data ke tabel statuses
        Status::create([
            'project_id' => $projectId,
            'status_type_id' => 1, // Status Type ID untuk "Project Assign"
        ]);

        ProjectLog::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'talent_qc' => $project->talent_qc ?? 'N/A',
            'timestamp' => Carbon::now(),
            'status' => 'Project Assign',
        ]);

        // Simpan notifikasi untuk Talent yang apply
        Notification::create([
            'email' => $user->email,
            'subject' => "{$user->name} has been applied to {$project->comic_name} Chapter {$project->chapter_number}",
            'message' => "You have successfully applied for the project {$project->name}.",
            'notif_type' => 'general',
        ]);

        return redirect()->back()->with('success', 'You have successfully applied for the project.');
    }


    // Project List Overview
    public function projectOverview(){
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang berhubungan dengan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
        ->orWhere('email', $user->email) // For general notifications based on the authenticated user's email
        ->get();


        // Ambil semua data projects
        $projectOverview = Project::where('talent', $user->name)
        ->paginate(10);

        return view('users.TalentQC.projectList')->with([
            'userData' => $user,
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

        $checkSop = Project::where('id', $id)
            ->where('status', 'First Draft Submitted')
            ->exists();

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

        $projectComplexity = ProjectComplexity::where('user_id', $user->id)
            ->get();

        // Kirim data proyek ke tampilan
        return view('users.TalentQC.projectDetail')->with([
            'userData' => $user,
            'notification' => $notifications,
            'projectData' => $project,
            'projectLogs' => $projectLogs,
            'statuses' => $projectStatuses,
            'projectRecords' => $records,
            'sops' => $sops,
            'sopChecklists' => $sopChecklists,
            'qcRecords' => $qcRecords,
            'reviseRecords' => $reviseRecords,
            'projectComplexity' => $projectComplexity,
            'checkSop' => $checkSop,
        ]);
    }

    public function detailOwnProject($id)
    {

        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang bersifat 'urgent' atau notifikasi berdasarkan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
            ->orWhere('email', $user->email)
            ->get();

        // Cari proyek berdasarkan ID yang telah didekripsi
        $project = Project::findOrFail($id);

        $checkSop = Project::where('id', $id)
            ->where('status', 'First Draft Submitted')
            ->exists();


        // Ambil data project Records
        $records = ProjectRecord::where('project_id', $id)->get();

        // Ambil data project log berdasarkan project_id
        $projectLogs = ProjectLog::where('project_id', $id)
            ->get();


        // Ambil data status berdasarkan project_id
        $projectStatuses = Status::where('project_id', $id)->get();

        // Ambil semua data SOPs
        $sops = TalentSop::all();

        // Mengambil data SOP Checklists
        $sopChecklists = SopChecklist::where('project_id', $id)
            ->get();

        // Mengambil project QC records
        $qcRecords = ProjectRecord::where('project_id', $id)
            ->get();

        // Ambil semua data revise records
        $reviseRecords = ProjectRevise::where('project_id', $id)
            ->get();

        $projectComplexity = ProjectComplexity::where('project_id', $id)
            ->get();

        // Kirim data proyek ke tampilan
        return view('users.TalentQC.ownprojectDetail')->with([
            'userData' => $user,
            'notification' => $notifications,
            'projectData' => $project,
            'projectLogs' => $projectLogs,
            'statuses' => $projectStatuses,
            'projectRecords' => $records,
            'sops' => $sops,
            'sopChecklists' => $sopChecklists,
            'qcRecords' => $qcRecords,
            'reviseRecords' => $reviseRecords,
            'projectComplexity' => $projectComplexity,
            'checkSop' => $checkSop,
        ]);
    }

    public function projectRecord(Request $request)
    {
        // First validate the basic required fields
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'qc_message' => 'nullable|string',
            'link_google_drive' => 'required|url',
            'agree_terms' => 'accepted',
        ]);

        // Get the current project
        $project = Project::findOrFail($request->project_id);

        // Determine project_stage based on current status
        $projectStageMap = [
            'Project Assign' => 'First Draft',
            'Revise 1' => 'Revise 1',
            'Revise 2' => 'Revise 2',
            'Revise 3' => 'Revise 3',
        ];

        $validatedData['project_stage'] = $projectStageMap[$project->status] ?? 'Unknown Stage';

        // Save project record
        $projectRecord = new ProjectRecord();
        $projectRecord->project_id = $validatedData['project_id'];
        $projectRecord->user_id = $validatedData['user_id'];
        $projectRecord->project_stage = $validatedData['project_stage'];
        if (isset($validatedData['qc_message'])) {
            $projectRecord->qc_message = $validatedData['qc_message'];
        }
        $projectRecord->link_google_drive = $validatedData['link_google_drive'];
        $projectRecord->save();

        // Validate and save checklist
        $validated = $request->validate([
            'checklist' => 'required|array',
            'checklist.*' => 'required|boolean',
        ]);

        // Save checklist items
        foreach ($validated['checklist'] as $sopId => $isChecked) {
            SopChecklist::updateOrCreate(
                [
                    'sop_id' => $sopId,
                    'project_id' => $validatedData['project_id'],
                    'user_id' => auth()->id(),
                ],
                ['is_checked' => $isChecked]
            );
        }

        // Status update mapping
        $statusUpdates = [
            'First Draft' => ['status' => 'QC First Draft', 'status_type_id' => 2],
            'Revise 1' => ['status' => 'QC Revise 1', 'status_type_id' => 5],
            'Revise 2' => ['status' => 'QC Revise 2', 'status_type_id' => 8],
            'Revise 3' => ['status' => 'QC Revise 3', 'status_type_id' => 11],
        ];

        // Get user and QC information
        $user = User::findOrFail($validatedData['user_id']);
        $talentQCName = $project->talent_qc;

        // Update status if valid project stage
        if (isset($statusUpdates[$validatedData['project_stage']])) {
            $statusData = $statusUpdates[$validatedData['project_stage']];

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

            // Create notification
            Notification::create([
                'email' => $user->email,
                'subject' => "{$user->name} already submit {$validatedData['project_stage']} of {$project->name}",
                'message' => "The project stage has been successfully submitted. Please contact {$talentQCName} for QC.",
                'notif_type' => 'general',
            ]);


        return redirect()->back()->with('success', 'You have successfully Add New Records.');
        }

    }

    // Project QC Overview
    public function projectQcOverview()
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang berhubungan dengan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
            ->orWhere('email', $user->email) // For general notifications based on the authenticated user's email
            ->get();

        // Ambil semua data projects dengan talent_qc sesuai user yang ter auth
        $projectQcOverview = Project::where('talent_qc', $user->name)
            ->paginate(10);

        return view('users.TalentQC.projectQcList')->with([
            'userData' => $user,
            'notification' => $notifications,
            'projectQcOverview' => $projectQcOverview
        ]);
    }


    // Store new SOP Record
    public function storeSop(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id', // Pastikan project_id valid
            'checklist' => 'required|array', // Pastikan checklist adalah array
            'checklist.*' => 'required|boolean', // Setiap nilai dalam checklist harus boolean
        ]);

        // Loop melalui checklist dan simpan ke database
        foreach ($validated['checklist'] as $sopId => $isChecked) {
            SopChecklist::updateOrCreate(
                [
                    'sop_id' => $sopId,
                    'project_id' => $validated['project_id'],
                    'user_id' => auth()->id(),
                ],
                [
                    'is_checked' => $isChecked,
                ]
            );
        }
        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Checklist berhasil diperbarui.');
    }

    // Fungsi store QC
    public function storeQc(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id', // Pastikan project_id valid
            'qc_stage' => 'required|string', // Pastikan qc_stage adalah string
            'qc_message' => 'required|string', // Pastikan qc_message adalah string
        ]);

        // Simpan data QC ke database
        QcRecords::create([
            'project_id' => $validated['project_id'],
            'user_id' => auth()->id(),
            'qc_stage' => $validated['qc_stage'],
            'qc_message' => $validated['qc_message'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'QC SOP has been send in to Talent');
    }

    // fungsi store qc records
    public function storeQcRecords(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id', // Pastikan project_id valid
            'qc_stage' => 'required|string', // Pastikan qc_stage adalah string
            'qc_message' => 'required|string', // Pastikan qc_message adalah string
        ]);

        // Simpan data QC ke database
        QcRecords::create([
            'project_id' => $validated['project_id'],
            'user_id' => auth()->id(),
            'qc_stage' => $validated['qc_stage'],
            'qc_message' => $validated['qc_message'],
        ]);

        // Fungsi Mengirim email ke Talent yang ada di project
        $project = Project::find($request->project_id);
        $talent = User::where('name', $project->talent)->first();


        // Simpan notifikasi untuk Talent
        Notification::create([
            'email' => $talent->email,
            'subject' => "Talent QC Sending QC Document",
            'message' => "Talent QC has sent a QC Document for the project.",
            'notif_type' => 'general',
        ]);

        // Simpan notifikasi untuk Talent QC
        Notification::create([
            'email' => auth()->user()->email,
            'subject' => "You have successfully sending QC Document and Message",
            'message' => "You have successfully sent a QC Document for the project.",
            'notif_type' => 'general',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'QC Message has been send in to Talent');
    }

    // Talent QC Update project records
    public function qcstoreProjectRecord(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'qc_message' => 'nullable|string',
            'link_google_drive' => 'required|url',
            'checklist' => 'nullable|array',
            'checklist.*' => 'nullable|boolean',
        ]);

        // Get the current project
        $project = Project::findOrFail($request->project_id);

        // Determine project_stage based on current status
        $projectStageMap = [
            'QC First Draft' => 'First Draft Submitted',
            'QC Revise 1' => 'Revise 1 Submitted',
            'QC Revise 2' => 'Revise 2 Submitted',
            'QC Revise 3' => 'Revise 3 Submitted',
        ];

        $validatedData['project_stage'] = $projectStageMap[$project->status] ?? 'Unknown Stage';

        // Simpan project record menggunakan instance model
        $projectRecord = new ProjectRecord();
        $projectRecord->project_id = $validatedData['project_id'];
        $projectRecord->user_id = $validatedData['user_id'];
        $projectRecord->project_stage = $validatedData['project_stage'];
        if (isset($validatedData['qc_message'])) {
            $projectRecord->qc_message = $validatedData['qc_message'];
        }
        $projectRecord->link_google_drive = $validatedData['link_google_drive'];
        $projectRecord->save();

                // Step 5: Save checklist items, if provided
        if (!empty($validatedData['checklist'])) {
            foreach ($validatedData['checklist'] as $sopId => $isChecked) {
                SopChecklist::updateOrCreate(
                    [
                        'sop_id' => $sopId,
                        'project_id' => $validatedData['project_id'],
                        'user_id' => auth()->id(),
                    ],
                    ['is_checked' => $isChecked]
                );
            }
        }

        // Ambil project yang terkait
        $project = Project::find($request->project_id);

        // Update status berdasarkan project_stage dan simpan data baru di tabel Statuses
        $statusUpdates = [
            'First Draft Submitted' => ['status' => 'First Draft Submitted', 'status_type_id' => 3],
            'Revise 1 Submitted' => ['status' => 'Revise 1 Submitted', 'status_type_id' => 6],
            'Revise 2 Submitted' => ['status' => 'Revise 2 Submitted', 'status_type_id' => 9],
            'Revise 3 Submitted' => ['status' => 'Revise 3 Submitted', 'status_type_id' => 12],
        ];


        $talentName = $project->talent;
        $talent = User::where('name', $talentName)->first();
        $user = User::findOrFail($validatedData['user_id']);

        if (isset($statusUpdates[$validatedData['project_stage']])) {
            $statusData = $statusUpdates[$validatedData['project_stage']];

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
                'subject' => "You Already submit {$request->project_stage} of {$project->comic_name} Chapter {$project->chapter_number}",
                'message' => "The project stage has been successfully submitted. Please wait for the next stage.",
                'notif_type' => 'general',
            ]);

            // Notifikasi untuk Talent dengan email talent
            Notification::create([
                'email' => $talent->email,
                'subject' => "{$user->name} Already Submit Draft of {$project->comic_name} Chapter {$project->chapter_number}",
                'message' => "The project stage has been successfully submitted. Please wait for the next stage.",
                'notif_type' => 'general',
            ]);


        }



        // Alert sukses
        return redirect()->back()->with('success', 'You have successfully Add New Records.');
    }

    public function projectReview(Request $request)
    {
        // Validate request data
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'complexity' => 'required|string',
            'number_of_panel' => 'nullable|integer',
            'message' => 'nullable|string',
        ]);

        // Save or Update project Complexity
        ProjectComplexity::updateOrCreate(
            [
                'project_id' => $request->project_id,
                'user_id' => auth()->id(),
            ],
            [
                'complexity' => $request->complexity
            ]
        );

        // Save or Update QC Review
        QcReview::updateOrCreate(
            [
                'user_id' => auth()->id(),
            ],
            [
                'qc_reviews' => $request->qc_reviews
            ],
            [
                'message' => $request->message
            ]
        );

        // Update project
        Project::where('id', $request->project_id)
            ->update(['number_of_panel' => $request->number_of_panel]);

        return redirect()->back()->with('success', 'Project Review and Complexity has been saved.');
    }


    public function projectReviewTalent(Request $request)
    {
        // Validate request data
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'complexity' => 'required|string',
            'message' => 'nullable|string',
            'comic_name' => 'nullable|string',
            'talent_review' => 'nullable|string',
        ]);

        // Save or Update project Complexity
        ProjectComplexity::updateOrCreate(
            [
                'project_id' => $request->project_id,
                'user_id' => auth()->id(),
                'comic_name' => $request->comic_name,
            ],
            [
                'complexity' => $request->complexity
            ]
        );

        // Save or Update QC Review
        TalentReview::updateOrCreate(
            [
                'user_id' => auth()->id(),
            ],
            [
                'talent_review' => $request->talent_review
            ],
            [
                'message' => $request->message
            ]
        );

        return redirect()->back()->with('success', 'Project Review and Complexity has been saved.');
    }


        // Store Profile
        public function submitData(Request $request)
        {
            // Validate the form data
            $validatedData = $request->validate([
                'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'full_name' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:500'],
                'phone_number' => ['required', 'numeric'],
                'gender' => ['required', 'string'],
                'date_of_birth' => ['required', 'date'],
                'id_card' => ['required', 'numeric'],
                'bank_name' => ['required', 'string', 'max:255'],
                'bank_Account' => ['required', 'string'],
                'swift_code' => ['required', 'string', 'max:10'],
                'subjected_tax' => ['nullable', 'string', 'max:255'],
            ]);

            // Handle the file upload if a profile photo is provided
            $profilePhotoPath = null;
            if ($request->hasFile('profile_photo')) {
                $profilePhoto = $request->file('profile_photo');
                $profilePhotoPath = $profilePhoto->store('profile_photos', 'public');
            }

            // Check if the user already has a Talent record
            $user = Auth::user();
            $talent = $user->talent ?? new TalentQc(); // Create a new Talent if none exists

            // Assign values to the Talent instance
            $talent->profile_photo = $profilePhotoPath ?? $talent->profile_photo;
            $talent->full_name = $validatedData['full_name'];
            $talent->address = $validatedData['address'];
            $talent->phone_number = $validatedData['phone_number'];
            $talent->gender = $validatedData['gender'];
            $talent->date_of_birth = $validatedData['date_of_birth'];
            $talent->id_card = Crypt::encrypt($validatedData['id_card']);
            $talent->bank_name = Crypt::encrypt($validatedData['bank_name']);
            $talent->bank_Account = Crypt::encrypt($validatedData['bank_Account']);
            $talent->swift_code = Crypt::encrypt($validatedData['swift_code']);
            $talent->subjected_tax = Crypt::encrypt($validatedData['subjected_tax']);           
            $talent->user_id = $user->id;

            // Save the Talent record
            $talent->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Your additional information has been successfully submitted!');
        }


    public function profile(){

        $userData = Auth::user();
        // data talent yang ada id dengan user auth
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

        $notification = Notification::where('email', $userData->email)
        ->orWhere('notif_type', 'urgent')
        ->get();

        
        // Mengambil data untuk drop down berdasarkan tahun
        $availableYears = Project::selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'asc')
            ->pluck('year');
        
        // Get selected year (default to current year if not specified)
        $selectedYear = request('year', now()->year);
        
        // Get monthly data for selected year and talent
        $projects = Project::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('talent', $userData->name)  // Filter by talent
            ->whereYear('created_at', $selectedYear)  // Filter by the selected year
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        // Create an array with all months (1-12) initialized to 0
        $monthlyData = array_combine(range(1, 12), array_fill(0, 12, 0));
        
        // Fill the array with actual data for the selected year and talent
        foreach ($projects as $project) {
            $monthlyData[$project->month] = $project->total;
        }
        
        // Prepare data for chart
        $months = [];
        $totals = [];
        
        foreach ($monthlyData as $month => $total) {
            $months[] = Carbon::createFromDate($selectedYear, $month, 1)->format('F Y');
            $totals[] = $total;
        }
        


        $projectOverview = Project::where('talent', $userData->name)
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
        ->paginate(3);


        return view('users.TalentQC.profile', compact(
            'userData',
            'talent',
            'notification',
            'months',
            'totals',
            'projectOverview',
            'availableYears',
           'selectedYear'
        
        ));
    }

    public function updateProfile(Request $request)
    {
        try {
            // Validate the form data
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'gender' => 'required|string',
                'date_of_birth' => 'required|date',
                'phone_number' => 'required|string|max:15',
                'bank_name' => 'required|string|max:255',
                'bank_Account' => 'required|string|max:255',
                'swift_code' => 'required|string|max:255',
                'subjected_tax' => 'nullable|string|max:255',
                'id_card' => 'required|string|max:255',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Encrypt sensitive data
            if (array_key_exists('bank_name', $validatedData)) {
                $validatedData['bank_name'] = Crypt::encrypt($validatedData['bank_name']);
            }
            if (array_key_exists('bank_Account', $validatedData)) {
                $validatedData['bank_Account'] = Crypt::encrypt($validatedData['bank_Account']);
            }
            if (array_key_exists('swift_code', $validatedData)) {
                $validatedData['swift_code'] = Crypt::encrypt($validatedData['swift_code']);
            }
            if (array_key_exists('subjected_tax', $validatedData)) {
                $validatedData['subjected_tax'] = Crypt::encrypt($validatedData['subjected_tax']);
            }
            if (array_key_exists('id_card', $validatedData)) {
                $validatedData['id_card'] = Crypt::encrypt($validatedData['id_card']);
            }

            // Get or create TalentQc record for the authenticated user
            $talentQc = TalentQc::where('user_id', auth()->id())->first();
            
            if (!$talentQc) {
                $talentQc = new TalentQc();
                $talentQc->user_id = auth()->id();
            }

            // Check if a new profile photo was uploaded
            if ($request->hasFile('profile_photo')) {
                // Delete the old profile photo if it exists
                if ($talentQc->profile_photo && Storage::disk('public')->exists($talentQc->profile_photo)) {
                    Storage::disk('public')->delete($talentQc->profile_photo);
                }

                // Store the new profile photo
                $profilePhoto = $request->file('profile_photo');
                $profilePhotoPath = $profilePhoto->store('profile_photos', 'public');
                $validatedData['profile_photo'] = $profilePhotoPath;
            }

            // Update the TalentQc record with validated data
            $talentQc->fill($validatedData);
            $talentQc->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
            
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update profile. Please try again.')
                ->withInput();
        }
    }


    public function additionalInfo(){
        $userData = Auth::user();
        $talent = TalentQc::where('user_id', $userData->id)->first();


        return view('users.Partner.register-talentqc', compact(
            'userData',
            'talent',
            'notification'
        ));
    }





}
