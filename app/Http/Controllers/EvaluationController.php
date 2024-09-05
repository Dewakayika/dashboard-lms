<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Meal;
use App\Models\Member;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function ratingMeals($id)
    {
        $member_data = Member::where('user_id', Auth::id())->first();
        $order_data = Order::where('id', $id)->first();
        $meal_data = Meal::where('id', $order_data->meal_id)->first();
        $partner_data = Partner::where('id', $meal_data->partner_id)->first();
        $user_data = User::where('id', Auth::id())->first();
        return view('ratingMeals')->with(['mealData' => $meal_data, 'memberData' => $member_data, 'partnerData' => $partner_data, 'userData' => $user_data, 'orderData' => $order_data]);
    }
    public function saveRating(Request $request, $id)
    {
        $member_data = Member::where('user_id', Auth::id())->first();
        $meal_data = Meal::where('id', $id)->first();
        $user_data = User::where('id', Auth::id())->first();
        
        $rating = new Rating();
        $rating->member_id = $member_data->id;
        $rating->meal_id = $meal_data->id;
        $rating->user_id = $user_data->id;
        $rating->rating = $request->input('rating');
        $rating->order_id = $request->input('order_id');


        $rating->save();
        return redirect()->route('member#orderList');
    }

    public function memberFeedback(Request $request)
    {
        DB::table('feedbacks')->insert(array(
            'user_id' => User::where('id', Auth::id())->first()->id,
            'feedback_subject' => $request->feedback_subject,
            'feedback_message' => $request->feedback_message
        ));
        SweetAlert()->addSuccess('Success', 'Feedback Successfully');
        return back();
    }
}
