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
use App\Http\Controllers\AdditionalInfoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::check()) {

        if (Auth::user()->role == 'talent') {
            return redirect()->route('talent#index');
        } else if (Auth::user()->role == 'intern') {
            return redirect()->route('intern#index');
        } else if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#index');
        } else {
            return view('auth.login');
        }
    }
})->name('dashboard');

//Talent
Route::group(['middleware' => 'role:talent', 'prefix' => 'talent'], function () {
    Route::get('/', [TalentController::class, 'index'])->name('talent#index');
    Route::get('/additional/data-talent',[TalentController::class, 'additionalInfo'])->name('talent#additionalData');
    Route::post('/additional/submit',[TalentController::class, 'submitForm'])->name('talent#submitData');  

});

// Admin
Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin#index'); //Admin Dashboard
    Route::get('/adminProfile', [AdminController::class, 'adminProfile'])->name('admin#adminProfile'); //Admin Profile
    Route::get('/editProfile', [AdminController::class, 'editProfile'])->name('admin#editProfile'); //edit profile
    Route::post('/updateAdmin', [AdminController::class, 'updateAdmin'])->name('admin#updateAdmin'); //Update profile function
    Route::get('deleteFeedback/{id}', [AdminController::class, 'deleteFeedback'])->name('admin#deleteFeedback'); //Delete Feedback
    Route::get('editFeedback/{id}', [AdminController::class, 'editFeedback'])->name('admin#editFeedback'); // Edit Feedback
    Route::post('updateFeedback/{id}', [AdminController::class, 'updateFeedback'])->name('admin#updateFeedback'); //Update Feedback

    Route::get('/userlist', [AdminController::class, 'listUser'])->name('admin#listUser'); //User List
    Route::get('deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin#deleteUser'); //Delete User
    Route::get('editUser/{id}', [AdminController::class, 'editUser'])->name('admin#editUser'); // Edit User
    Route::post('updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin#updateUser'); //Update User

    Route::get('/meallist', [AdminController::class, 'listMeal'])->name('admin#listMeal'); //Meal List
    Route::get('deleteMeal/{id}', [AdminController::class, 'deleteMeal'])->name('admin#deleteMeal'); //Delete Meal
    Route::get('editMeal/{id}', [AdminController::class, 'editMeal'])->name('admin#editMeal'); //Edit Meal
    Route::post('updateMeal/{id}', [AdminController::class, 'updateMeal'])->name('admin#updateMeal'); //Update Meal

    Route::get('/talentlist', [AdminController::class, 'listTalent'])->name('admin#listTalent'); //Partner List
    Route::get('deletePartner/{id}', [AdminController::class, 'deletePartner'])->name('admin#deletePartner'); //Partner Delete
    Route::get('editPartner/{id}', [AdminController::class, 'editPartner'])->name('admin#editPartner'); //Edit partner
    Route::post('updatePartner/{id}', [AdminController::class, 'updatePartner'])->name('admin#updatePartner'); //Update Partner

    Route::get('/internlist', [AdminController::class, 'listIntern'])->name('admin#listIntern'); //Member List
    Route::get('deleteMember/{id}', [AdminController::class, 'deleteMember'])->name('admin#deleteMember'); //Member Delete
    Route::get('editMember/{id}', [AdminController::class, 'editMember'])->name('admin#editMember'); //Edit Member
    Route::post('updateMember/{id}', [AdminController::class, 'updateMember'])->name('admin#updateMember'); //Update Member

    Route::get('/admin/roles/create', [AdminController::class, 'createRole'])->name('admin#createRole');
    Route::post('/admin/roles', [AdminController::class, 'store'])->name('admin#storeRole');
    Route::get('deleteRole/{id}', [AdminController::class, 'deleteRole'])->name('admin#deleteRole');
    Route::get('editRole/{id}', [AdminController::class, 'editRole'])->name('admin#editRole'); //Edit Code
    Route::put('updateRole/{id}', [AdminController::class, 'updateRole'])->name('admin#updateRole'); //Update Code

});

// Member
Route::group(['middleware' => 'role:intern', 'prefix' => 'intern'], function () {
    Route::get('/', [InternController::class, 'index'])->name('intern#index'); //Member dashboard
    Route::get('/additional/data-intern',[InternController::class, 'additionalInfo'])->name('intern#additionalData');
    Route::post('/additional/submit', [InternController::class, 'submitForm'])->name('intern#submitData');

    Route::get('/course/basic-webtoon', [InternController::class, 'basicWebtoon'])->name('course#basic');
    Route::get('/course/introduction', [InternController::class, 'intro'])->name('course#introduction');
    Route::get('/course/basic-sketchup', [InternController::class, 'basicSketchup'])->name('course#basicSketchup'); 
    Route::get('/course/sketchup-photoshop', [InternController::class, 'sketchupPhotoshop'])->name('course#sketchupPhotoshop');


});

