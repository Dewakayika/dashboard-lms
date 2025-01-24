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
use App\Models\Sop;
use App\Models\SopChecklist;
use App\Models\QcRecords;
use App\Models\ProjectRevise;


use App\Mail\ApplyProjectMail;
use App\Mail\NotifyTalentQcMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class TalentController extends Controller
{
    //
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = auth()->user();

        // Ambil semua notifikasi yang berhubungan dengan email pengguna yang sedang login
        $notifications = Notification::where('notif_type', 'urgent')
        ->orWhere('email', $user->email) // For general notifications based on the authenticated user's email
        ->get();

        // Ambil semua proyek yang statusnya 'waiting talent' dan pastikan talent_qc bukan nama pengguna yang sedang login
        $projectsOffer = Project::where('status', 'waiting talent')
            ->where('talent_qc', '!=', $user->name)
            ->paginate(7);

        // Ambil proyek yang telah dilamar oleh pengguna berdasarkan user_id
        $appliedProjects = ApplyProject::where('user_id', $user->id)->get(); // Mengambil proyek yang dilamar oleh user_id

        // Ambil status proyek untuk proyek yang telah dilamar oleh user_id
        $projectStatuses = Status::whereIn('project_id', $appliedProjects->pluck('project_id'))->get();

        // Group project statuses by project_id
        $groupedProjectStatuses = $projectStatuses->groupBy('project_id');

        // Ambil data proyek log
        $projectLogs = ProjectLog::with('project')
            ->where('user_id', Auth::id())
            ->get();

        // Cek apakah proyek status terbaru di database adalah 'Project Assign' atau 'QC First Draft'
        $latestStatus = Project::orderBy('created_at', 'desc')->first();

        // Mengambil semua data project dengan nama talent sesuai user yang ter auth
        $projectOverview = Project::where('talent', $user->name)
            ->paginate(10);

        // Cek apakah pengguna memiliki data Talent
        if (!Talent::where('user_id', $user->id)->exists()) {
            return view('users.Partner.register-talent');
        } else {
            // Ambil data Talent berdasarkan user_id
            $talent_data = Talent::where('user_id', $user->id)->first();



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



            // Kirim data Talent, User, Notifikasi, Proyek, dan Status Proyek ke view
            return view('users.Talent.talentIndex')->with([
                'talentData' => $talent_data,
                'userData' => $user,
                'notification' => $notifications,
                'projects' => $projectsOffer,
                'groupedProjectStatuses' => $groupedProjectStatuses,
                'projectLogs' => $projectLogs,
                'projectOverview' => $projectOverview,
                'latestStatus' => $latestStatus,
                'onGoingProject' => $onGoingProject,
                'projectThisMonth' => $projectThisMonth,
                'AllProject' => $AllProject,
                'projectAssign' => $projectAssign,
                'projectQc' => $projectQc,
                'projectCompleted' => $projectCompleted,
                'projectDraft' => $projectDraft,
                'projectRevise' => $projectRevise,
            ]);
        }
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

        // Simpan log proyek ke tabel project_logs
        $log = ProjectLog::create([
            'project_id' => $projectId,
            'user_id' => $user->id,
            'talent_qc' => $project->talent_qc ?? 'N/A', // Nama Talent QC
            'timestamp' => Carbon::now(), // Waktu status pertama kali diubah
            'status' => $project->status, // Status proyek
        ]);

        // Menyimpan deadline untuk countdown 30 jam dari timestamp
        $deadline = Carbon::parse($log->timestamp)->addHours(30); // Deadline 30 jam setelah timestamp

        // Update project log dengan deadline
        $log->update([
            'deadline' => $deadline, // Menyimpan deadline
        ]);

        // Kirim email ke Talent yang apply
        Mail::to($user->email)->send(new ApplyProjectMail($user, $project));

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

        return view('users.Talent.projectList')->with([
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
        return view('users.Talent.projectDetail')->with([
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

        ]);
    }


    public function projectRecord(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'project_stage' => 'required|string',
            'number_of_panel' => 'required|integer',
            'link_google_drive' => 'required|url',
            'agree_terms' => 'accepted',
        ]);

        // Simpan project record menggunakan instance model
        $projectRecord = new ProjectRecord();
        $projectRecord->project_id = $validatedData['project_id'];
        $projectRecord->user_id = $validatedData['user_id'];
        $projectRecord->project_stage = $validatedData['project_stage'];
        $projectRecord->number_of_panel = $validatedData['number_of_panel'];
        $projectRecord->link_google_drive = $validatedData['link_google_drive'];
        $projectRecord->save();

        // Ambil project yang terkait
        $project = Project::find($request->project_id);

        // Update status berdasarkan project_stage dan simpan data baru di tabel Statuses
        $statusUpdates = [
            'First Draft' => ['status' => 'QC First Draft', 'status_type_id' => 2],
            'Revise 1' => ['status' => 'QC Revise 1', 'status_type_id' => 5],
            'Revise 2' => ['status' => 'QC Revise 2', 'status_type_id' => 8],
            'Revise 3' => ['status' => 'QC Revise 3', 'status_type_id' => 11],
        ];

        if (isset($statusUpdates[$request->project_stage])) {
            $statusData = $statusUpdates[$request->project_stage];

            // Update status di tabel Project
            $project->update([
                'status' => $statusData['status'],
            ]);

            // Simpan data baru ke tabel Statuses
            Status::create([
                'project_id' => $project->id,
                'status_type_id' => $statusData['status_type_id'],
            ]);
        }

        // Kirim email
        $talentQCName = $project->talent_qc;
        $talentQC = User::where('name', $talentQCName)->first();
        $user = User::find($request->user_id);

        if ($talentQC) {
            // Kirim email ke Talent QC
            Mail::send('emails.updateProjectforQc', ['projectStage' => $request->project_stage], function ($message) use ($talentQC) {
                $message->to($talentQC->email)
                        ->subject("Project Ready for QC");
            });

            // Kirim email ke Talent yang melakukan perubahan
            Mail::send('emails.updateProjectStage', ['projectStage' => $request->project_stage, 'talentQC' => $talentQCName], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject("Project Stage Submitted");
            });
        }

        // Simpan notifikasi
        Notification::create([
            'email' => $user->email,
            'subject' => "{$user->name} already submit {$request->project_stage} of {$project->name}",
            'message' => "The project stage has been successfully submitted. Please contact {$talentQCName} for QC.",
            'notif_type' => 'general',
        ]);

        // Alert sukses
        return redirect()->back()->with('success', 'You have successfully Add New Records.');
    }












}
