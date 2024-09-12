<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Talent;
use App\Models\Intern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;

class InternController extends Controller
{

    public function index()
    {

        $user = auth()->user();

        
         // Cek apakah user dengan role intern memiliki data di tabel interns
        if (!Intern::where('user_id', $user->id)->exists()) {
        return view('users.Member.register-intern');
        }
        else {
            $intern_data = Intern::where('user_id', Auth::id())->first();
            $user = User::where('id', $intern_data->user_id)->first();

            return view('users.Member.internIndex')->with(['internData' => $intern_data, 'userData' => $user]);;
        }

    }

    public function additionalInfo(){
        return view('users.Member.register-intern');
    }

    public function submitForm(Request $request){

        $user = Auth::user();

        $intern = new Intern();
        $intern->job = $request->input('job');
        $intern->user_id = $user->id;
        $intern->save();

        return redirect()->route('intern#index');
    }

    public function basicWebtoon()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        return view('users.Member.courseBasicWebtoon')->with(['internData' => $intern_data, 'userData' => $user]);;
    }
    public function intro()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        return view('users.Member.courseIntroduction')->with(['internData' => $intern_data, 'userData' => $user]);;
    }

    public function basicSketchup()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        return view('users.Member.courseIntroSketchup')->with(['internData' => $intern_data, 'userData' => $user]);;
    }
    public function sketchupPhotoshop()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        return view('users.Member.courseSketchupPhotoshop')->with(['internData' => $intern_data, 'userData' => $user]);;

    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function mealDetails($id)
    // {
    //     $user_data = User::where('id', Auth::id())->first();
    //     $member_data = Member::where('user_id', Auth::id())->first();
    //     $mealData = Meal::with('ratings')->where('id', $id)->first();
    //     $partner_data = Partner::where('id', $mealData->partner_id)->first();
    //     return view('users.Member.mealDetails')->with(['mealData' => $mealData,  'partnerData' => $partner_data, 'userData' => $user_data, 'memberData' => $member_data]);
    // }

    // public function profile()
    // {
    //     $member_data = Member::where('user_id', Auth::id())->first();
    //     $user = User::where('id', $member_data->user_id)->first();
    //     $end_date = $member_data->member_end_service;
    //     $dateCount = Carbon::parse(now())->diffInDays($end_date, false);
    //     return view('users.Member.memberProfile')->with(['memberData' => $member_data, 'dateCount' => $dateCount, 'userData' => $user]);;
    // }

    // public function editProfile()
    // {
    //     $member_data = Member::where('user_id', Auth::id())->first();
    //     return view('users.Member.updateMember')->with(['memberData' =>  $member_data]);
    // }

    // public function updateMember(Request $request)
    // {
    //     $update_member = $this->requestUpdateMember($request);
    //     $update_user = $this->requestUpdateUser($request);
    //     $member_data = Member::where('user_id', Auth::id())->first();

    //     Member::where('user_id', Auth::id())->first()->update($update_member);
    //     User::where('id', $member_data->users->id)->update($update_user);

    //     return redirect()->route('member#memberProfile');
    // }

    // private function requestUpdateMember($request)
    // {
    //     $arr = [
    //         'member_caregiver_name' => $request->member_caregiver_name,
    //         'member_caregiver_number' => $request->member_caregiver_number,
    //         'member_medical_condition' => $request->member_medical_condition,
    //         'member_caregiver_relation' => $request->member_caregiver_relation,
    //     ];
    //     return $arr;
    // }

    // private function requestUpdateUser($request)
    // {
    //     $arr = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //     ];
    //     return $arr;
    // }

    // public static function vincentyGreatCircleDistance(
    //     $latitudeFrom,
    //     $longitudeFrom,
    //     $latitudeTo,
    //     $longitudeTo,
    //     $earthRadius = 6371000
    // ) {
        
    //     $latFrom = deg2rad($latitudeFrom);
    //     $lonFrom = deg2rad($longitudeFrom);
    //     $latTo = deg2rad($latitudeTo);
    //     $lonTo = deg2rad($longitudeTo);

    //     $lonDelta = $lonTo - $lonFrom;
    //     $a = pow(cos($latTo) * sin($lonDelta), 2) +
    //         pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    //     $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    //     $angle = atan2(sqrt($a), $b);
    //     return $angle * $earthRadius / 1000;
    // }

    // public function orderDetails($id)
    // {
    //     $member_data = Member::where('user_id', Auth::id())->first();
    //     $mealData = Meal::where('id', $id)->first();
    //     $partner_data = Partner::where('id', $mealData->partner_id)->first();
    //     $user_data = User::where('id', Auth::id())->first();

    //     $this->latUser = $user_data->lat;
    //     $this->longUser = $user_data->long;

    //     $distance_data = self::vincentyGreatCircleDistance(
    //         Meal::find($id)->partners->users->lat,
    //         Meal::find($id)->partners->users->long,
    //         $this->latUser,
    //         $this->longUser
    //     );
    //     $distance = floor($distance_data);
    //     return view('users.Member.orderDetails')->with(['distanceData' => $distance, 'mealData' => $mealData, 'memberData' => $member_data, 'partnerData' => $partner_data, 'userData' => $user_data]);
    // }

    // public function orderList()
    // {
    //     $user_data = User::where('id', Auth::id())->first();
    //     $member_data = Member::where('user_id', Auth::id())->first();
    //     $order_data = Order::where('member_id', $member_data->id)->paginate(5);
    //     $rating_data = Rating::where('member_id', $member_data->id)->get();
    //     return view('users.Member.mealOrder')->with(['orderData' => $order_data, 'memberData' => $member_data,  'userData' => $user_data, 'ratingData' => $rating_data]);
    // }

    // public function memberFoodList(){
    //     $project = Meal::query();
    //     if (request('search')) {
    //         $project->where('meal_title', 'Like', '%' . request('search') . '%');
    //     }
    //     $project_data = $project->orderBy('meal_title', 'ASC')->paginate(10);
    //     return view('users.Member.memberFoodList')->with(['mealData' => $project_data]);

    //     // $meal_data = Meal::paginate(10);
    //     // $meal_search =
    //     // $member_data = Member::where('user_id', Auth::id())->first();
    //     //return view('users.Member.memberFoodList')->with(['memberData' => $member_data, 'mealData' => $meal_data]);
    // }
}