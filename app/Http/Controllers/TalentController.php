<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Driver;
use App\Models\Meal;
use App\Models\Order;
use App\Models\User;
use App\Models\Talent;
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
        $user = auth()->user();

        if(!Talent::where('user_id', $user->id)->exists()){
            return view('users.Partner.register-talent');
        }else{
            $talent_data = Talent::where('user_id', Auth::id())->first();
            $user = User::where('id', $talent_data->user_id)->first();
            return view('users.Partner.talentIndex')->with([ 'talentData' => $talent_data, 'userData' => $user]);
        }
    }

    public function additionalInfo(){
        return view ('users.Partner.register-talent');
    }

    public function submitForm(Request $request){
        $user = Auth::user();

        $request->validate([
            'school' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'bank_name' => ['required', 'string'],
            'bank_account' => ['required', 'string'],
        ]);

        $talent = new Talent();
        $talent->school = $request->input('school');
        $talent->date_of_birth = $request->input('date_of_birth');
        $talent->bank_name = $request->input('bank_name');
        $talent->bank_account = $request->input('bank_account');
        $talent->user_id = $user->id;
        $talent->save();

        return redirect()->route('talent#index');
    }
































    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //partner add meal
    public function addMeal()
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        return view('users.Partner.partnerAddMeal')->with(['partnerData' => $partner_data]);
    }

    public function saveMeal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meal_title' => 'required',
            'meal_type' => 'required',
            'meal_description' => 'required',
            'meal_image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $meal = new Meal();

        if ($request->hasfile('meal_image')) {

            $imageFile = $request->file('meal_image');
            $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path() . './uploads/meal', $imageName);

            $meal->meal_image = $imageName;
        }
        $meal->meal_title = $request->input('meal_title');
        $meal->meal_description = $request->input('meal_description');
        $meal->meal_type = $request->input('meal_type');
        $meal->partner_id = $request->input('partner');
        $meal->save();
        return redirect()->route('partner#index')->with(['mealCreated' => 'Meal Has Been Created Sucessfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMeal($id)
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $editMeal = Meal::where('id', $id)->first();
        return view('users.Partner.updateMeal')->with(['editMeal' => $editMeal, 'partnerData' => $partner_data]);
    }
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
        return redirect()->route('partner#index')->with(['updateData' => 'Menu Has Been Updated Sucessfully!']);
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

    // partner delete meal
    public function deleteMeal($id)
    {
        $deleteData = Meal::select('meal_image')->where('id', $id)->first();
        $deleteImage = $deleteData['meal_image'];

        Meal::where('id', $id)->delete(); //db data delete

        //project image folder delete
        if (File::exists(public_path() . '/uploads/meal/' . $deleteImage)) {
            File::delete(public_path() . '/uploads/meal/' . $deleteImage);
        }

        return back()->with(['mealDeleted' => "Meal Delete Successfully"]);
    }

    //update partner
    public function partnerProfile()
    {
        $user_data = Partner::where('user_id', Auth::id())->first();
        return view('users.Partner.partnerProfile')->with(['userData' => $user_data]);;
    }

    public function editProfile()
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        return view('users.Partner.updatePartner')->with(['partnerData' =>  $partner_data]);
    }

    public function updatePartner(Request $request)
    {
        $update_partner = $this->requestUpdatePartner($request);
        $update_user = $this->requestUpdateUser($request);
        $partner_data = Partner::where('user_id', Auth::id())->first();

        Partner::where('user_id', Auth::id())->update($update_partner);
        User::where('id', $partner_data->users->id)->update($update_user);

        return redirect()->route('partner#partnerProfile');
    }
    private function requestUpdatePartner($request)
    {
        $array = [
            'partner_organization' => $request->partner_organization,
            'partnership_timeline' => $request->partnership_timeline
        ];
        return $array;
    }
    private function requestUpdateUser($request)
    {
        $array = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
        return $array;
    }

    // public function partnerDriver()
    // {
    //     $partner_data = Partner::where('user_id', Auth::id())->first();
    //     $driver_data = Driver::where('partner_id', $partner_data->id)->Paginate(5);
    //     return view('users.Partner.partnerDriver')->with(['driverData' => $driver_data, 'partnerData' => $partner_data]);
    // }

    // public function addDriver()
    // {
    //     return view('users.Partner.partnerAddDriver');
    // }

    // public function saveDriver(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'driver_name' => 'min:5',
    //         'driver_email' => 'unique:drivers',
    //     ])->validate();

    //     $partner_data = Partner::where('user_id', Auth::id())->first();
    //     $driver = new Driver();

    //     if ($request->hasfile('driver_license')) {

    //         $imageFile = $request->file('driver_license');
    //         $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
    //         $imageFile->move(public_path() . './uploads/driver', $imageName);

    //         $driver->driver_license = $imageName;
    //     }
    //     $driver->driver_name = $request->input('driver_name');
    //     $driver->driver_gender = $request->input('driver_gender');
    //     $driver->driver_email = $request->input('driver_email');
    //     $driver->driver_status = 'Contracted';
    //     $driver->driver_phone = $request->input('driver_phone');
    //     $driver->partner_id = $partner_data->id;
    //     $driver->save();
    //     sweetAlert()->addSuccess('Add Driver Successfuly');
    //     return redirect()->route('partner#driverList')->with(['driverCreated' => 'Driver Has Been Created Sucessfully!']);
    // }

    // // Partner Edit Driver
    // public function editDriver($id)
    // {
    //     $driver_data = Driver::where('id', $id)->first();
    //     $partner_data = Partner::where('user_id', Auth::id())->first();
    //     return view('users.Partner.updateDriver')->with(['editDriver' => $driver_data, 'partnerData' => $partner_data]);
    // }

    // // Partner Update Driver
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function updateDriver(Request $request, $id)
    // {
    //     $updateData = $this->requestUpdateDriverData($request);

    //     $updateImgData = Driver::select('driver_license')->where('id', $id)->first();
    //     $updateImage = $updateImgData['driver_license'];

    //     if ($request->hasfile('driver_license')) {

    //         if (File::exists(public_path() . '/uploads/driver/' . $updateImage)) {
    //             File::delete(public_path() . '/uploads/driver/' . $updateImage);
    //         }

    //         $newImageFile = $request->file('driver_license');
    //         $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
    //         $newImageFile->move(public_path() . './uploads/driver/', $newImageName);

    //         $updateData['driver_license'] = $newImageName;
    //     }


    //     Driver::where('id', $id)->update($updateData);
    //     return redirect()->route('partner#driverList')->with(['driverUpdated' => 'Driver Has Been Updated Sucessfully!']);
    // }
    // private function requestUpdateDriverData($request)
    // {
    //     $menuArray = [
    //         'driver_name' => $request->driver_name,
    //         'driver_gender' => $request->driver_gender,
    //         'driver_email' => $request->driver_email,
    //         'driver_phone' => $request->driver_phone,
    //         'updated_at' => Carbon::now(),
    //     ];
    //     if (isset($request->driver_license)) {
    //         $menuArray['driver_license'] = $request->driver_license;
    //     }
    //     return $menuArray;
    // }

    // public function deleteDriver($id)
    // {
    //     Driver::where('id', $id)->delete();
    //     sweetAlert()->addSuccess('Delete Driver Successfuly');
    //     return back();
    // }

    public function partnerCampaign()
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $campaign_data = Campaign::where('partner_id', $partner_data->id)->Paginate(5);
        return view('users.Partner.partnerCampaign')->with(['campaignData' => $campaign_data, 'partnerData' => $partner_data]);
    }

    public function addCampaign()
    {
        return view('users.Partner.partnerAddCampaign');
    }

    public function saveCampaign(Request $request)
    {
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $campaign = new Campaign();
        if ($request->hasfile('campaign_image')) {

            $imageFile = $request->file('campaign_image');
            $imageName = uniqid() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path() . './uploads/campaign', $imageName);

            $campaign->campaign_image = $imageName;
        }
        $campaign->campaign_title = $request->input('campaign_title');
        $campaign->campaign_description = $request->input('campaign_description');
        $campaign->campaign_role = $request->input('campaign_role');
        $campaign->campaign_location = $request->input('campaign_location');
        $campaign->partner_id = $partner_data->id;
        $campaign->save();
        return redirect()->route('partner#campaignList')->with(['campaignCreated' => 'Driver Has Been Created Sucessfully!']);
    }

    public function editCampaign($id)
    {
        $campaign_data = Campaign::where('id', $id)->first();
        $partner_data = Partner::where('user_id', Auth::id())->first();
        return view('users.Partner.updateCampaign')->with(['editCampaign' => $campaign_data, 'partnerData' => $partner_data]);
    }

    // Partner Update Driver
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCampaign(Request $request, $id)
    {
        $updateData = $this->requestUpdateCampaignData($request);

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
        return redirect()->route('partner#campaignList')->with(['campaignUpdated' => 'Campaign Has Been Updated Sucessfully!']);
    }
    private function requestUpdateCampaignData($request)
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

    public function deleteCampaign($id)
    {
        Campaign::where('id', $id)->delete();
        sweetAlert()->addSuccess('Delete Campaign Successfuly');
        return back();
    }

    public function partnerOrder()
    {
        $user_data = User::where('id', Auth::id())->first();
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $order_data = Order::where('partner_id', $partner_data->id)->paginate(10);
        return view('users.Partner.partnerOrder')->with(['partnerData' => $partner_data, 'userData' => $user_data, 'orderData' => $order_data]);
    }
}
