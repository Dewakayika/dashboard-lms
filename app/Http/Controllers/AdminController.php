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

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //Admin Dashboard
    public function index()
    {
        
        $user_data = User::count();
        $intern_data = Intern::count();
        $talent_data = Talent::count();


        return view('users.Admin.adminIndex')->with([
            'userData' => $user_data,
            'internData' => $intern_data,
            'talentData' => $talent_data
        ]);;
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
    public function listUser()
    {
        $user_data = User::paginate(10);
        return view('users.Admin.listUser')->with(['userData' => $user_data]);
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

    //Admin List Meal
    public function listMeal()
    {
        $meal_data = Meal::paginate(5);
        return view('users.Admin.listMeal')->with(['mealData' => $meal_data]);
    }

    // Admin Delete Meal
    public function deleteMeal($id)
    {
        Meal::where('id', $id)->delete();
        return back()->with(['mealDeleted' => 'Meal Has Been Deleted Successfully!']);
    }

    // Admin Edit Meal
    public function editMeal($id)
    {
        $meal_data = Meal::where('id', $id)->first();
        $partner_data = Partner::get();
        $user_data = User::get();
        return view('users.Admin.updateMeal')->with(['editMeal' => $meal_data, 'partnerData' => $partner_data, 'userData' => $user_data]);
    }

    // Admin Update Meal
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMeal(Request $request, $id)
    {
        $updateData = $this->requestUpdateMenuData($request);

        $updateImgData = Meal::select('meal_image')->where('id', $id)->first();
        $updateImage = $updateImgData['meal_image'];

        if ($request->hasfile('meal_image')) {

            if (File::exists(public_path() . '/uploads/meal/' . $updateImage)) {
                File::delete(public_path() . '/uploads/meal/' . $updateImage);
            }

            $newImageFile = $request->file('meal_image');
            $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
            $newImageFile->move(public_path() . './uploads/meal/', $newImageName);

            $updateData['meal_image'] = $newImageName;
        }

        Meal::where('id', $id)->update($updateData);
        return redirect()->route('admin#listMeal')->with(['mealUpdated' => 'Menu Has Been Updated Sucessfully!']);
    }
    private function requestUpdateMenuData($request)
    {
        $menuArray = [
            'meal_title' => $request->meal_title,
            'meal_description' => $request->meal_description,
            'meal_type' => $request->meal_type,
            'partner_id' => $request->partner,
            'updated_at' => Carbon::now(),
        ];
        if (isset($request->meal_image)) {
            $menuArray['meal_image'] = $request->meal_image;
        }
        return $menuArray;
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

    // Volunteer Role
    public function listVolunteer()
    {
        $volunteer_data = Volunteer::paginate(10);
        return view('users.Admin.listVolunteer')->with(['volunteerData' => $volunteer_data]);
    }

    // Admin Delete Volunteer
    public function deleteVolunteer($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['volunteerDeleted' => 'Volunteer Has Been Deleted Successfully!']);
    }

    // Admin Edit Volunteer
    public function editVolunteer($id)
    {
        $volunteer_data = Volunteer::where('id', $id)->first();
        return view('users.Admin.updateVolunteer')->with(['editVolunteer' => $volunteer_data]);
    }

    // Admin Update Volunteer
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateVolunteer(Request $request, $id)
    {
        $update_volunteer = $this->requestUpdateVolunteer($request);
        Volunteer::where('id', $id)->update($update_volunteer);
        return redirect()->route('admin#listVolunteer')->with(['volunteerUpdated' => 'Volunteer Has Been Updated Successfully!']);
    }

    private function requestUpdateVolunteer($request)
    {
        $array = [
            'volunteer_time' => $request->volunteer_time,
            'volunteer_available' => implode(', ', $request->volunteer_available),
            'updated_at' => Carbon::now()
        ];
        return $array;
    }

    public function listDonation()
    {
        $donation_data = DonationFee::paginate(10);
        return view('users.Admin.listDonation')->with(['donationData' => $donation_data]);
    }

    public function deleteDonation($id)
    {
        DonationFee::where('id', $id)->delete();
        return back()->with(['donationDeleted' => 'Donation Has Been Deleted Successfully!']);
    }

    // Admin Edit Donation
    public function editDonation($id)
    {
        $donation_data = DonationFee::where('id', $id)->first();
        return view('users.Admin.updateDonation')->with(['editDonation' => $donation_data]);
    }

    // Admin Update Donation
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateDonation(Request $request, $id)
    {
        $update_donation = $this->requestUpdateDonation($request);
        DonationFee::where('id', $id)->update($update_donation);
        return redirect()->route('admin#listDonation')->with(['donationUpdated' => 'Donation Has Been Updated Successfully!']);
    }

    private function requestUpdateDonation($request)
    {
        $array = [
            'amount' => $request->amount,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ];
        return $array;
    }

    // List Driver
    public function listDriver()
    {
        $driver_data = Driver::paginate(10);
        return view('users.Admin.listDriver')->with(['driverData' => $driver_data]);
    }

    public function deleteDriver($id)
    {
        Driver::where('id', $id)->delete();
        return back()->with(['driverDeleted' => 'Driver Has Been Deleted Successfully!']);
    }

    // Admin Edit Driver
    public function editDriver($id)
    {
        $driver_data = Driver::where('id', $id)->first();
        return view('users.Admin.updateDriver')->with(['editDriver' => $driver_data]);
    }

    // Admin Update Driver
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateDriver(Request $request, $id)
    {
        $updateData = $this->requestUpdateDriver($request);

        $updateImgData = Cm::select('driver_license')->where('id', $id)->first();
        $updateImage = $updateImgData['driver_license'];

        if ($request->hasfile('driver_license')) {

            if (File::exists(public_path() . '/uploads/driver/' . $updateImage)) {
                File::delete(public_path() . '/uploads/driver/' . $updateImage);
            }

            $newImageFile = $request->file('driver_license');
            $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
            $newImageFile->move(public_path() . './uploads/driver/', $newImageName);

            $updateData['driver_license'] = $newImageName;
        }

        Driver::where('id', $id)->update($updateData);
        return redirect()->route('admin#listDriver')->with(['driverUpdated' => 'Driver Has Been Updated Sucessfully!']);
    }

    private function requestUpdateDriver($request)
    {
        $array = [
            'updated_at' => Carbon::now()
        ];
        if (isset($request->driver_license)) {
            $array['driver_license'] = $request->driver_license;
        }
        return $array;
    }

    // List Order
    public function listOrder()
    {
        $order_data = Order::paginate(10);
        return view('users.Admin.listOrder')->with(['orderData' => $order_data]);
    }

    public function deleteOrder($id)
    {
        Order::where('id', $id)->delete();
        return back()->with(['orderDeleted' => 'Order Has Been Deleted Successfully!']);
    }

    // Admin Edit Order
    public function editOrder($id)
    {
        $order_data = Order::where('id', $id)->first();
        return view('users.Admin.updateOrder')->with(['editOrder' => $order_data]);
    }

    // Admin Update Driver
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request, $id)
    {
        $update_order = $this->requestUpdateOrder($request);
        Order::where('id', $id)->update($update_order);
        return redirect()->route('admin#listOrder')->with(['orderUpdated' => 'Order Has Been Updated Successfully!']);
    }

    private function requestUpdateOrder($request)
    {
        $array = [
            'updated_at' => Carbon::now(),
            'member_id' => $request->member_id,
            'meal_id' => $request->meal_id,
            'partner_id' => $request->partner_id,
            'volunteer_id' => $request->volunteer_id,
            'driver_id' => $request->driver_id,
            'start_delivery_time' => $request->start_delivery_time,
            'delivery_status' => $request->delivery_status,
            'order_status' => $request->order_status
        ];

        return $array;
    }

    // Admin Delete Feedback
    public function deleteFeedback($id)
    {
        Feedback::where('id', $id)->delete();
        SweetAlert()->addSuccess('Success', 'Feedback Delete Successfully');
        return back();
    }

    // Admin Edit Feedback
    public function editFeedback($id)
    {
        $feedback_data = Feedback::where('id', $id)->first();
        return view('users.Admin.updateFeedback')->with(['editFeedback' => $feedback_data]);
    }

    // Admin Update Feedback
    public function updateFeedback(Request $request, $id)
    {
        $update_feedback = $this->requestUpdateFeedback($request);
        Feedback::where('id', $id)->update($update_feedback);
        SweetAlert()->addSuccess('Success', 'Feedback Update Successfully');
        return redirect()->route('admin#index')->with(['feedbackUpdated' => 'Feedback Has Been Updated Successfully!']);
    }
    private function requestUpdateFeedback($request)
    {
        $array = [
            'feedback_subject' => $request->feedback_subject,
            'feedback_message' => $request->feedback_message,
            'updated_at' => Carbon::now()
        ];
        return $array;
    }



    //Admin Campaign
    public function listCampaign()
    {
        $campaign_data = Campaign::paginate(10);
        return view('users.Admin.listCampaign')->with(['campaignData' => $campaign_data]);
    }

    // Admin Delete Campaign
    public function deleteCampaign($id)
    {
        Campaign::where('id', $id)->delete();
        SweetAlert()->addSuccess('Success', 'Campaign Delete Successfully');
        return back();
    }

    // Admin Edit Campaign
    public function editCampaign($id)
    {
        $campaign_data = Campaign::where('id', $id)->first();
        return view('users.Admin.updateCampaign')->with(['editCampaign' => $campaign_data]);
    }

    // Admin Update Campaign
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCampaign(Request $request, $id)
    {
        $updateData = $this->requestUpdateCampaign($request);

        $updateImgData = Campaign::select('campaign_image')->where('id', $id)->first();
        $updateImage = $updateImgData['campaign_image'];

        if ($request->hasfile('campaign_image')) {

            if (File::exists(public_path() . '/uploads/campaign/' . $updateImage)) {
                File::delete(public_path() . '/uploads/campaign/' . $updateImage);
            }

            $newImageFile = $request->file('campaign_image');
            $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
            $newImageFile->move(public_path() . './uploads/campaign/', $newImageName);

            $updateData['campaign_image'] = $newImageName;
        }

        Campaign::where('id', $id)->update($updateData);
        SweetAlert()->addSuccess('Success', 'Campaign Update Successfully');
        return redirect()->route('admin#listCampaign')->with(['campaignUpdated' => 'Campaign Has Been Updated Successfully!']);
    }
    private function requestUpdateCampaign($request)
    {
        $array = [
            'campaign_title' => $request->campaign_title,
            'campaign_description' => $request->campaign_description,
            'campaign_role' => $request->campaign_role,
            'campaign_location' => $request->campaign_location,
            'updated_at' => Carbon::now(),
        ];
        if (isset($request->campaign_image)) {
            $array['campaign_image'] = $request->campaign_image;
        }
        return $array;
    }
}
