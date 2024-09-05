<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DonorController;

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
    return view('welcome');
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

Route::get('/donorInfo', [DonorController::class, 'donorInfo'])->name('donor#Info'); //Donor Info
Route::post('/donorCheckout', [DonorController::class, 'donorCheckout'])->name('donor#Checkout'); //Donor Payment
Route::get('/donorPayment', [DonorController::class, 'donorPayment'])->name('donor#Payment');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::check()) {

        if (Auth::user()->role == 'tallent') {
            return redirect()->route('partner#index');
        } else if (Auth::user()->role == 'volunteer') {
            return redirect()->route('volunteer#index');
        } else if (Auth::user()->role == 'intern') {
            return redirect()->route('intern#index');
        } else if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#index');
        } else if (Auth::user()->role == 'driver') {
            return redirect()->route('driver#index');
        } else {
            return view('welcome');
        }
    }
})->name('dashboard');

//Partner
Route::group(['middleware' => 'role:partner', 'prefix' => 'partner'], function () {
    Route::get('/', [PartnerController::class, 'index'])->name('partner#index'); //partner dashboard // view meal
    Route::get('/details/{id}', [PartnerController::class, 'detailsMeal'])->name('partner#detailsMeal'); //partner dashboard // view meal
    Route::get('addMeal', [PartnerController::class, 'addMeal'])->name('partner#addMeal'); //partner create meal
    Route::post('/saveMeal', [PartnerController::class, 'saveMeal'])->name('partner#saveMeal'); //partner save meal
    Route::get('editMeal/{id}', [PartnerController::class, 'editMeal'])->name('partner#editMeal'); //edit Meal
    Route::post('updateMeal/{id}', [PartnerController::class, 'updateMeal'])->name('partner#updateMeal'); //update Meal
    Route::get('deleteMeal/{id}', [PartnerController::class, 'deleteMeal'])->name('partner#deleteMeal'); // delete Meal
    Route::get('/partnerProfile', [PartnerController::class, 'partnerProfile'])->name('partner#partnerProfile'); //Partner Profile
    Route::get('/editProfile', [PartnerController::class, 'editProfile'])->name('partner#editProfile'); //edit profile
    Route::post('/updatePartner', [PartnerController::class, 'updatePartner'])->name('partner#updatePartner'); //Update profile function
    Route::get('partnerOrder', [PartnerController::class, 'partnerOrder'])->name('partner#orderList'); //Partner Order List
    // Route::get('partnerCook/{id}', [OrderController::class, 'partnerCook'])->name('partner#orderCook'); //Partner Cooking Status
    // Route::get('partnerFinish/{id}', [OrderController::class, 'partnerFinish'])->name('partner#orderFinish'); //Partner Finish Status
    Route::get('addCampaign', [PartnerController::class, 'addCampaign'])->name('partner#addCampaign'); //partner Create Campaign
    Route::post('saveCampaign', [PartnerController::class, 'saveCampaign'])->name('partner#saveCampaign'); //partner save Campaign
    Route::get('partnerCampaign/', [PartnerController::class, 'partnerCampaign'])->name('partner#campaignList'); //View Campaign
    Route::get('editCampaign/{id}', [PartnerController::class, 'editCampaign'])->name('partner#editCampaign'); //edit Campaign
    Route::post('updateCampaign/{id}', [PartnerController::class, 'updateCampaign'])->name('partner#updateCampaign'); //update Campaign
    Route::get('deleteCampaign/{id}', [PartnerController::class, 'deleteCampaign'])->name('partner#deleteCampaign'); // delete Campaign
    // Route::get('addDriver', [PartnerController::class, 'addDriver'])->name('partner#addDriver'); //partner Create Driver
    // Route::post('/saveDriver', [PartnerController::class, 'saveDriver'])->name('partner#saveDriver'); //partner save driver
    // Route::get('partnerDriver/', [PartnerController::class, 'partnerDriver'])->name('partner#driverList'); //View Driver
    // Route::get('editDriver/{id}', [PartnerController::class, 'editDriver'])->name('partner#editDriver'); //edit Driver
    // Route::post('updateDriver/{id}', [PartnerController::class, 'updateDriver'])->name('partner#updateDriver'); //update Driver
    // Route::get('deleteDriver/{id}', [PartnerController::class, 'deleteDriver'])->name('partner#deleteDriver'); // delete Driver
    // Route::get('orderDriver/{id}', [OrderController::class, 'orderDriver'])->name('partner#orderDriver'); //Order Driver

    Route::get('orderVolunteer/{id}', [OrderController::class, 'orderVolunteer'])->name('partner#orderVolunteer'); //List Volunteer
    Route::get('saveOrderVolunteer/{id}', [OrderController::class, 'saveOrderVolunteer'])->name('partner#saveOrderVolunteer'); //Order Driver
    // Route::get('orderDriverFunction{id}', [OrderController::class, 'orderDriverFunction'])->name('partner#orderDriverFunction'); //Order Driver
    Route::get('saveOrderDriver/{id}', [OrderController::class, 'saveOrderDriver'])->name('partner#saveOrderDriver'); //Order Driver
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

    Route::get('/partnerlist', [AdminController::class, 'listPartner'])->name('admin#listPartner'); //Partner List
    Route::get('deletePartner/{id}', [AdminController::class, 'deletePartner'])->name('admin#deletePartner'); //Partner Delete
    Route::get('editPartner/{id}', [AdminController::class, 'editPartner'])->name('admin#editPartner'); //Edit partner
    Route::post('updatePartner/{id}', [AdminController::class, 'updatePartner'])->name('admin#updatePartner'); //Update Partner

    Route::get('/memberlist', [AdminController::class, 'listMember'])->name('admin#listMember'); //Member List
    Route::get('deleteMember/{id}', [AdminController::class, 'deleteMember'])->name('admin#deleteMember'); //Member Delete
    Route::get('editMember/{id}', [AdminController::class, 'editMember'])->name('admin#editMember'); //Edit Member
    Route::post('updateMember/{id}', [AdminController::class, 'updateMember'])->name('admin#updateMember'); //Update Member

    Route::get('/volunteerlist', [AdminController::class, 'listVolunteer'])->name('admin#listVolunteer'); //Volunteer List
    Route::get('deleteVolunteer/{id}', [AdminController::class, 'deleteVolunteer'])->name('admin#deleteVolunteer'); //Volunteer Delete
    Route::get('editVolunteer/{id}', [AdminController::class, 'editVolunteer'])->name('admin#editVolunteer'); //Edit Volunteer
    Route::post('updateVolunteer/{id}', [AdminController::class, 'updateVolunteer'])->name('admin#updateVolunteer'); //Update Volunteer

    Route::get('/donationlist', [AdminController::class, 'listDonation'])->name('admin#listDonation'); //Donation List
    Route::get('deleteDonation/{id}', [AdminController::class, 'deleteDonation'])->name('admin#deleteDonation'); //Donation Delete
    Route::get('editDonation/{id}', [AdminController::class, 'editDonation'])->name('admin#editDonation'); //Edit Donation
    Route::post('updateDonation/{id}', [AdminController::class, 'updateDonation'])->name('admin#updateDonation'); //Update Donation

    Route::get('/driverlist', [AdminController::class, 'listDriver'])->name('admin#listDriver'); //Driver List
    Route::get('deleteDriver/{id}', [AdminController::class, 'deleteDriver'])->name('admin#deleteDriver'); //Driver Delete
    Route::get('editDriver/{id}', [AdminController::class, 'editDriver'])->name('admin#editDriver'); //Edit Driver
    Route::post('updateDriver/{id}', [AdminController::class, 'updateDriver'])->name('admin#updateDriver'); //Update Driver

    Route::get('/orderlist', [AdminController::class, 'listOrder'])->name('admin#listOrder'); //Order List
    Route::get('deleteOrder/{id}', [AdminController::class, 'deleteOrder'])->name('admin#deleteOrder'); //Order Delete
    Route::get('editOrder/{id}', [AdminController::class, 'editOrder'])->name('admin#editOrder'); //Edit Order
    Route::post('updateOrder/{id}', [AdminController::class, 'updateOrder'])->name('admin#updateOrder'); //Update Order
    
    Route::get('/campaignlist', [AdminController::class, 'listCampaign'])->name('admin#listCampaign'); //Campaign List
    Route::get('deleteCampaign/{id}', [AdminController::class, 'deleteCampaign'])->name('admin#deleteCampaign'); //Campaign Delete
    Route::get('editCampaign/{id}', [AdminController::class, 'editCampaign'])->name('admin#editCampaign'); //Edit Campaign
    Route::post('updateCampaign/{id}', [AdminController::class, 'updateCampaign'])->name('admin#updateCampaign'); //Update Cmapaign
});

//Volunteer
Route::group(['middleware' => 'role:volunteer', 'prefix' => 'volunteer'], function () {
    Route::get('/', [VolunteerController::class, 'index'])->name('volunteer#index'); //volunteer Dashboard
    // Route::get('partnerOrders', [VolunteerController::class, 'partnerOrders'])->name('volunteer#orderList'); //Partner Orde List
    Route::get('volunteerConfirmCamp', [VolunteerController::class, 'volunteerConfirmCamp'])->name('volunteer#volunteerConfirmCamp'); // volunteer Orders
    // Route::get('volunteerDelivered/{id}', [OrderController::class, 'volunteerDelivered'])->name('volunteer#volunteerDelivered'); //Volunteer Delivered Status
    // Route::get('volunteerReceived/{id}', [OrderController::class, 'volunteerReceived'])->name('volunteer#volunteerReceived'); //Volunteer Received Status
    Route::get('/volunteerProfile', [VolunteerController::class, 'volunteerProfile'])->name('volunteer#volunteerProfile'); //Volunteer Profile
    Route::get('/editProfile', [VolunteerController::class, 'editProfile'])->name('volunteer#editProfile'); //edit profile
    Route::post('/updateVolunteer', [VolunteerController::class, 'updateVolunteer'])->name('volunteer#updateVolunteer'); //Update profile function
    Route::get('volunteerOrder', [VolunteerController::class, 'volunteerOrder'])->name('volunteer#orderList'); //Volunteer Order List
    Route::get('volunteerOrderHistory', [volunteerController::class, 'volunteerOrderHistory'])->name('volunteer#orderHistory'); //Order History
    Route::get('updateOrder', [OrderController::class, 'updateOrderDriver'])->name('volunteer#updateOrder'); //Update Order driver


    // Route::post('volunteerMember', [VolunteerController::class, 'volunteerMember'])->name('volunteer#volunteerMember'); //volunteer chosen member
});

// Member
Route::group(['middleware' => 'role:intern', 'prefix' => 'intern'], function () {
    Route::get('/', [InternController::class, 'index'])->name('intern#index'); //Member dashboard
    // Route::get('/mealList', [MemberController::class, 'memberFoodList'])->name('member#memberFoodList'); //Member dashboard
    // Route::get('/details/{id}', [MemberController::class, 'mealDetails'])->name('member#mealDetails'); //Member meal details
    // Route::get('/profile', [MemberController::class, 'profile'])->name('member#memberProfile'); //Profile Member
    // Route::get('/orderDetails/{id}', [MemberController::class, 'orderDetails'])->name('member#orderDetails'); //Member order details
    // Route::post('/orderSave/{id}', [OrderController::class, 'orderSave'])->name('member#orderSave'); //Member Order
    // Route::get('/orderList', [MemberController::class, 'orderList'])->name('member#orderList'); //Order List Member
    // Route::get('/ratingMeals/{id}', [EvaluationController::class, 'ratingMeals'])->name('member#ratingMeals'); // Show rating form
    // Route::post('/saveRating/{id}', [EvaluationController::class, 'saveRating'])->name('member#saveRating'); //Member save rating
    // Route::get('/editProfile', [MemberController::class, 'editProfile'])->name('member#editProfile'); //edit profile
    // Route::post('/updateMember', [MemberController::class, 'updateMember'])->name('member#updateMember'); //Update profile function
    // Route::get('/memberFeedback', [EvaluationController::class, 'memberFeedback'])->name('member#memberFeedback'); //Member Feedback
    // Route::get('/memberFoodList', [MemberController::class, 'memberFoodList'])->name('member#memberFoodList'); //Member Food List
});

// Driver
Route::group(['middleware' => 'role:driver', 'prefix' => 'driver'], function () {
    Route::get('/', [DriverController::class, 'index'])->name('driver#index'); //Driver dashboard
    Route::get('/profile', [DriverController::class, 'profile'])->name('driver#driverProfile'); //Profile Member
    Route::get('/editProfile', [DriverController::class, 'editProfile'])->name('driver#editProfile'); //edit profile
    Route::post('/updateDriver', [DriverController::class, 'updateDriver'])->name('driver#updateDriver'); //Update profile function
    Route::get('orderDriver/{id}', [DriverController::class, 'orderDriver'])->name('driver#orderDriver'); //Order Driver
    Route::get('orderHistory', [DriverController::class, 'orderHistory'])->name('driver#orderHistory'); //Order History
    Route::get('updateOrder', [OrderController::class, 'updateOrderDriver'])->name('driver#updateOrder'); //Update Order driver
    Route::get('driverOrder', [DriverController::class, 'driverOrder'])->name('driver#orderList'); //Driver Order List

    // Route::get('/details/{id}', [MemberController::class, 'mealDetails'])->name('member#mealDetails'); //Member meal details
    // Route::get('/profile', [MemberController::class, 'profile'])->name('member#memberProfile'); //Profile Member
    // Route::get('/orderDetails/{id}', [MemberController::class, 'orderDetails'])->name('member#orderDetails'); //Member order details
    // Route::post('/orderSave/{id}', [OrderController::class, 'orderSave'])->name('member#orderSave'); //Member Order
    // Route::get('/orderList', [MemberController::class, 'orderList'])->name('member#orderList'); //Order List Member
    // Route::get('/ratingMeals/{id}', [EvaluationController::class, 'ratingMeals'])->name('member#ratingMeals'); // Show rating form
    // Route::post('/saveRating/{id}', [EvaluationController::class, 'saveRating'])->name('member#saveRating'); //Member save rating
    // Route::get('/editProfile', [MemberController::class, 'editProfile'])->name('member#editProfile'); //edit profile
    // Route::post('/updateMember', [MemberController::class, 'updateMember'])->name('member#updateMember'); //Update profile function
});
