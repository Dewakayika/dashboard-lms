<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\TalentCVController;
use App\Http\Controllers\AdditionalInfoController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TalentQcController;
use App\Http\Controllers\EwaletController;
use App\Http\Controllers\CompanyController;

use App\Model\Project;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('main');

//About Us
Route::get('/about', function () {
    return view('about');
})->name('about'); //about us

//Contact Us
Route::get('/contact', function () {
    return view('contact');
})->name('contact'); //Contact us

//Terms
Route::get('/terms', function () {
    return view('terms');
})->name('terms'); //Terms

Route::get('/talent-cv', function () {
    return view('cv.talent_cv');
});

// General Information
Route::get('/register/company', [CompanyController::class, 'showRegistrationForm'])->name('company#register');
Route::post('/register/company/store', [CompanyController::class, 'register'])->name('company#registerStore');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'talent') {
            return redirect()->route('talent#index');
        } else if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#index');
        } else if (Auth::user()->role == 'talent_qc') {
           return redirect()->route('talentqc#index');
        } else if (Auth::user()->role == 'talentqc') {
            return redirect()->route('talentqc#index');
        } else if (Auth::user()->role == 'company'){
            return redirect()->route('company#index');
        }else {
            return view('dashboard');
        }
    }
})->name('dashboard');

Route::group(['middleware' => 'role:company', 'prefix' => 'company'], function () {
    Route::get('/', [CompanyController::class, 'index'])->name('company#index');
});

//Talent
Route::group(['middleware' => 'role:talent', 'prefix' => 'talent'], function () {
    Route::get('/', [TalentController::class, 'index'])->name('talent#index');
    Route::get('/project/Overview',[TalentController::class, 'projectOverview'])->name('talent#projectOverview');
    Route::get('/project/{id}/detail', [TalentController::class, 'detail'])->name('talent#projectDetail');
    Route::post('/project-record/store', [TalentController::class, 'projectRecord'])->name('talent#projectRecods');
    Route::get('/additional/data-talent',[TalentController::class, 'additionalInfo'])->name('talent#additionalData');
    Route::post('/additional/submit',[TalentController::class, 'submitData'])->name('talent#submitData');
    Route::post('/projects/{projectId}/apply', [TalentController::class, 'apply'])->name('talent#applyProject');
    Route::post('/sop/store', [TalentController::class, 'storeSop'])->name('talent#storeSop');
    Route::post('/review/store', [TalentController::class, 'projectReview'])->name('talent#storeReview');
    Route::get('/profile', [TalentController::class, 'profile'])->name('talent#profile');
    Route::get('/e-walet', [EwaletController::class, 'indexTalent'])->name('talent#ewalet');
    Route::post('/withdraw/request', [EwaletController::class, 'requestWithdraw'])->name('talent#withdrawRequest');
    Route::post('/talents/update/profile', [TalentController::class, 'updateProfile'])->name('talent#update');
    Route::post('/update-profile-image', [TalentController::class, 'updateProfileImage'])->name('updateProfileImage');
    Route::get('/waiting-approval', [TalentContoller::class, 'waitingApproval'])->name('talent#waitingApproval');
    Route::post('talent/active/{id}', [TalentController::class, 'activeAccount'])->name('talent#activeAccount');
});

//TalentQc
Route::group(['middleware' => 'role:talent_qc', 'prefix' => 'talent_qc'], function () {
    Route::get('/', [TalentQcController::class, 'index'])->name('talentqc#index');
    Route::get('/project/Overview',[TalentQcController::class, 'projectOverview'])->name('talentqc#projectOverview');
    Route::get('/talentqc/projectDetail/{id}', [TalentQcController::class, 'detail'])->name('talentqc#projectDetail');
    Route::post('/project-record/store', [TalentQcController::class, 'projectRecord'])->name('talentqc#projectRecods');
    Route::get('/additional/data-talentqc',[TalentQcController::class, 'additionalInfo'])->name('talentqc#additionalData');
    Route::post('/additional/submit',[TalentQcController::class, 'submitData'])->name('talentqc#submitData');
    Route::post('/projects/{projectId}/apply', [TalentQcController::class, 'apply'])->name('talentqc#applyProject');
    Route::post('/sops/checklist', [TalentQcController::class, 'storeChecklist'])->name('talentqc#storeChecklist');
    Route::get('/project-qc-overview', [TalentQcController::class, 'projectQcOverview'])->name('talentqc#projectQcOverview');
    Route::get('/talentqc/ownprojectDetail/{id}', [TalentQcController::class, 'detailOwnProject'])->name('talentqc#ownprojectDetail');
    Route::post('/project-record/store', [TalentQcController::class, 'projectRecord'])->name('talentqc#projectRecods');
    Route::post('/review/store', [TalentQcController::class, 'projectReview'])->name('talentqc#storeReview');
    Route::post('/review', [TalentQcController::class, 'projectReviewTalent'])->name('talentqc#ReviewTalent');
    Route::post('/talents/update/profile', [TalentQcController::class, 'updateProfile'])->name('talentqc#update');
    Route::get('/profile', [TalentQcController::class, 'profile'])->name('talentqc#profile');
    // Route to store sop
    Route::post('/sop/store', [TalentQcController::class, 'storeSop'])->name('talentqc#storeSop');
    Route::post('/qc-records/store', [TalentQcController::class, 'storeQcRecords'])->name('talentqc#storeQcRecords');
    // Update Status Project Log
    Route::post('/project-log/store', [TalentQcController::class, 'qcstoreProjectRecord'])->name('talentqc#storeProjectLog');
    Route::get('/e-walet', [EwaletController::class, 'indexTalentQc'])->name('talentqc#ewalet');
    Route::post('/withdraw/request', [EwaletController::class, 'requestWithdraw'])->name('talentqc#withdrawRequest');
});

// Admin
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('/community', [AdminController::class, 'community'])->name('admin#community'); //Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin#index'); //Admin Dashboard
    Route::get('/adminProfile', [AdminController::class, 'adminProfile'])->name('admin#adminProfile'); //Admin Profile
    Route::get('/editProfile', [AdminController::class, 'editProfile'])->name('admin#editProfile'); //edit profile
    Route::post('/updateAdmin', [AdminController::class, 'updateAdmin'])->name('admin#updateAdmin'); //Update profile function
    Route::get('deleteFeedback/{id}', [AdminController::class, 'deleteFeedback'])->name('admin#deleteFeedback'); //Delete Feedback
    Route::get('editFeedback/{id}', [AdminController::class, 'editFeedback'])->name('admin#editFeedback'); // Edit Feedback
    Route::post('updateFeedback/{id}', [AdminController::class, 'updateFeedback'])->name('admin#updateFeedback'); //Update Feedback
    Route::get('/talent-cv', [AdminController::class, 'talentCV'])->name('admin#talentCVList');
    Route::get('deleteCV/{id}', [AdminController::class, 'deleteCV'])->name('admin#deleteCV');
    Route::post('/cv/decline/{id}', [AdminController::class, 'declineCV'])->name('cv#decline');
    Route::post('/approve-cv/{id}', [AdminController::class, 'approveCV'])->name('approveCV');
    Route::post('/admin/send-invitation/{id}', [AdminController::class, 'sendInvitationToUser'])->name('sendInvitationToUser');
    Route::post('/booking/{id}', [AdminController::class, 'booking'])->name('booking.submit');
    Route::get('/admin/user/{id}/submissions', [AdminController::class, 'getUserSubmissions'])->name('admin.user.submissions');
    Route::get('/create-project', [AdminController::class, 'createProject'])->name('admin#createNewProject');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects#store');
    // Manage Project
    Route::get('/manage-project', [AdminController::class, 'projectOverview'])->name('admin#projectOverview');
    Route::get('/project/{id}/detail', [AdminController::class, 'detail'])->name('admin#projectDetail');
    Route::post('/project-revise', [AdminController::class, 'storeProjectRevise'])->name('admin#storeProjectRevise');
    // Project Done
    Route::post('/project-done/{id}', [AdminController::class, 'storeProjectDone'])->name('admin#storeProjectDone');
    Route::get('/time-statistic', [AdminController::class, 'projectTimeStatistic'])->name('admin#timeStatistic');
    // Delete project route
    Route::delete('/projects/{id}/delete', [AdminController::class, 'deleteProject'])->name('admin.deleteProject');
    // Update project route
    Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('admin.updateProject');
    // Profile Detail User ID
    Route::get('/profile/{id}', [AdminController::class, 'profileUser'])->name('admin#profileDetailUser');
    Route::post('/admin/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approveUser');
    Route::post('/admin/decline-user/{id}', [AdminController::class, 'declineUser'])->name('admin.declineUser');
    Route::post('/csv/store', [AdminController::class, 'submitCSV'])->name('submit.csv');
    Route::post('/admin/store-project-type', [AdminController::class, 'storeProjectType'])->name('admin.storeProjectType');
    Route::delete('/admin/delete-project-type/{id}', [AdminController::class, 'deleteProjectType'])->name('admin.deleteProjectType');
    Route::put('/admin/update-project-type/{id}', [AdminController::class, 'updateProjectType'])->name('admin.updateProjectType');
    Route::put('/revise/{id}', [AdminController::class, 'updateRevise'])->name('admin.updateRevise');
    Route::delete('/revise/{id}', [AdminController::class, 'deleteRevise'])->name('admin.deleteRevise');
    Route::get('/userlist', [AdminController::class, 'listUser'])->name('admin#listUser'); //User List
    Route::get('deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin#deleteUser'); //Delete User
    Route::get('editUser/{id}', [AdminController::class, 'editUser'])->name('admin#editUser'); // Edit User
    Route::post('updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin#updateUser'); //Update User
    Route::get('/admin/roles/create', [AdminController::class, 'createRole'])->name('admin#createRole');
    Route::post('/admin/roles', [AdminController::class, 'store'])->name('admin#storeRole');
    Route::get('deleteRole/{id}', [AdminController::class, 'deleteRole'])->name('admin#deleteRole');
    Route::get('editRole/{id}', [AdminController::class, 'editRole'])->name('admin#editRole'); //Edit Code
    Route::put('updateRole/{id}', [AdminController::class, 'updateRole'])->name('admin#updateRole'); //Update Code
    Route::get('/ewalletRequest', [EwaletController::class, 'ewalletRequest'])->name('admin#ewalletRequest');
    Route::post('/admin/approve-withdraw', [EwaletController::class, 'approveWithdraw'])->name('admin#approveWithdraw');
    Route::post('/admin/validate-password', [AdminController::class, 'validatePassword'])->name('admin#validatePassword');
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('admin#profile');
});

