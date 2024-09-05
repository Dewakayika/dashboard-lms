<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ConfirmCamp;
use App\Models\MemberOrder;
use App\Models\Order;
use App\Models\User;
use App\Models\Volunteer;
use Flasher\SweetAlert\Laravel\Facade\SweetAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    //index
    public function index()
    {
        $campaign_data = Campaign::paginate(10);
        $volunteer_data = Volunteer::where('user_id', Auth::id())->first();
        $validate_campaign = ConfirmCamp::where('volunteer_id', $volunteer_data->id)->get();
        return view('users.Volunteer.volunteerIndex')->with(['campaignData' => $campaign_data, 'validateCampaign' => $validate_campaign]);
    }

    public function volunteerConfirmCamp(Request $request)
    {
        DB::table('confirmcamps')->insert(array(
            'campaign_id' => $request->campaign_id,
            'volunteer_id' => Volunteer::where('user_id', Auth::id())->first()->id,
            'advantages' => $request->advantages,
            'documents' => $request->documents
        ));
        SweetAlert()->addSuccess('Success', 'Campaign Accept Successfully');
        return back();
    }

    public function volunteerProfile()
    {
        $user_data = Volunteer::where('user_id', Auth::id())->first();
        return view('users.Volunteer.volunteerProfile')->with(['userData' => $user_data]);;
    }

    public function editProfile()
    {
        $volunteer_data = Volunteer::where('user_id', Auth::id())->first();
        return view('users.Volunteer.updateVolunteer')->with(['volunteerData' =>  $volunteer_data]);
    }

    public function updateVolunteer(Request $request)
    {
        $update_volunteer = $this->requestUpdateVolunteer($request);
        $update_user = $this->requestUpdateUser($request);
        $volunteer_data = Volunteer::where('user_id', Auth::id())->first();

        Volunteer::where('user_id', Auth::id())->update($update_volunteer);
        User::where('id', $volunteer_data->users->id)->update($update_user);

        return redirect()->route('volunteer#volunteerProfile');
    }
    private function requestUpdateVolunteer($request)
    {
        $array = [
            'volunteer_time' => $request->volunteer_time,
            'volunteer_available' => implode(', ', $request->volunteer_available)
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

    public function updateOrderVolunteer(Request $request)
    {
        Order::where('id', $request->order_id)->update(array('delivery_status' => $request->delivery_status));
        SweetAlert()->addSuccess('Delivery Update Successfully', 'Success');
        return back();
    }

    public function volunteerOrder()
    {
        $driver_data = Volunteer::where('user_id', Auth::id())->first();
        $order_data = Order::where('volunteer_id', $driver_data->id)->whereNot('delivery_status', 'Received')->paginate(10);
        return view('users.Volunteer.volunteerOrder')->with(['orderData' => $order_data]);
    }


    public function volunteerOrderHistory()
    {
        $volunteer_data = Volunteer::where('user_id', Auth::id())->first();
        $order_data = Order::where('volunteer_id', $volunteer_data->id)->where('delivery_status', 'Received')->paginate(10);
        return view('users.Volunteer.volunteerOrderHistory')->with(['orderData' => $order_data]);
    }
}
