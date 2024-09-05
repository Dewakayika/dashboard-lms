<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ConfirmCamp;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Meal;
use App\Models\Member;
use App\Models\Partner;
use App\Models\User;
use App\Models\Order;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $driverId;
    public $volunteerId;
    public $orderData;

    public function orderSave($id)
    {
        $member_data = Member::where('user_id', Auth::id())->first();
        $meal_data = Meal::where('id', $id)->first();
        $end_date = $member_data->member_end_service;
        $partner_data = Partner::where('id', $meal_data->partner_id)->first();
        $date_count = Carbon::parse(now())->diffInDays($end_date, false);
        $date_now = Carbon::now()->dayName;
        $distance_data = request()->distance;
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday',];

        if ($date_count > 0) {
            if (in_array($date_now, $weekdays) &&  $meal_data->meal_type == 'Cold' && $distance_data <= 10) {
                sweetAlert()->addWarning('Cold just can order over than 10 KM');
                return back();
            } elseif (!in_array($date_now, $weekdays) &&  $meal_data->meal_type == 'Hot') {
                sweetAlert()->addWarning('Hot Just Ready at the Weekdays');
                return back();
            } elseif (in_array($date_now, $weekdays) &&  $meal_data->meal_type == 'Hot'&& $distance_data >= 10) {
                sweetAlert()->addWarning('Hot just can order lower than 10 KM');
                return back();
            } else {
                $order = new Order();
                $order->member_id = $member_data->id;
                $order->meal_id = $meal_data->id;
                $order->partner_id = $partner_data->id;
                $order->order_status = 'New Order';
                $order->delivery_status = 'Waiting for Pickup';

                $order->save();
                sweetAlert()->addSuccess('Order Successfuly');
                return redirect()->route('member#orderList');
            }
        } else {
            sweetAlert()->addWarning('Out of Service');
            return back();
        }
    }

    // if (!in_array($date_now, $weekend) &&  $meal_data->meal_type == 'cold') {
    //     sweetAlert()->addWarning('Cold Just Ready at the Weekend');
    //     return back();
    // } elseif (!in_array($date_now, $weekdays) &&  $meal_data->meal_type == 'hot') {
    //     sweetAlert()->addWarning('Hot Just Ready at the Weekdays');
    //     return back();
    // } else {
    //     $order = new Order();
    //     $order->member_id = $member_data->id;
    //     $order->meal_id = $meal_data->id;
    //     $order->partner_id = $partner_data->id;
    //     $order->order_status = 'New Order';
    //     $order->delivery_status = 'Waiting for Pickup';

    //     $order->save();
    //     sweetAlert()->addSuccess('Order Successfuly');
    //     return $distance_data;
    // }

    // $order = new Order();
    // $order->member_id = $member_data->id;
    // $order->meal_id = $meal_data->id;
    // $order->partner_id = $partner_data->id;
    // $order->order_status = 'New Order';
    // $order->delivery_status = 'Waiting for Pickup';

    // $order->save();
    // sweetAlert()->addSuccess('Order Successfuly');
    // return redirect()->route('member#orderList');

    public function updateOrderDriver(Request $request)
    {
        Order::where('id', $request->order_id)->update(array('delivery_status' => $request->delivery_status));
        SweetAlert()->addSuccess('Delivery Update Successfully', 'Success');
        return back();
    }

    // public function orderDriver($id)
    // {
    //     $order_data = Order::where('id', $id)->first();
    //     $this->orderData = $order_data;
    //     $order_count = Order::get()->whereNotIn('delivery_status', 'Received');
    //     $partner_data = Partner::where('user_id', Auth::id())->first();
    //     $driver_data = Driver::where('partner_id', $partner_data->id)->Paginate(5);
    //     return view('users.Partner.orderDriver')->with(['driverData' => $driver_data, 'partnerData' => $partner_data, 'orderData' => $this->orderData, 'orderCount' => $order_count]);
    // }

    // public function saveOrderDriver(Request $request, $id)
    // {
    //     $order_full = Order::get();
    //     $this->driverId = $id;
    //     $orderId = $request->order_id;
    //     $updateOrder = $this->requestUpdateOrder();
    //     if ($order_full->whereNotIn('delivery_status', 'Received')->where('driver_id', $this->driverId)->count('delivery_status') >= 3) {
    //         SweetAlert()->addWarning('Driver only can delivery 3 orders', 'Warning');
    //         return back();
    //     } else {
    //         Order::where('id', $orderId)->update($updateOrder);
    //         return redirect()->route('partner#orderList');
    //     }
    // }

    // private function requestUpdateOrder()
    // {
    //     $arr = [
    //         'driver_id' => $this->driverId,
    //         'order_status' => 'Order by Driver',
    //         'delivery_status' => 'On Delivery',
    //         'start_delivery_time' => Carbon::now(),
    //     ];

    //     return $arr;
    // }

    public function orderVolunteer($id)
    {
        $order_data = Order::where('id', $id)->first();
        $this->orderData = $order_data;
        $partner_data = Partner::where('user_id', Auth::id())->first();
        $campaign_data = Campaign::where('partner_id', $partner_data->id)->where('campaign_role', 'Driver')->pluck('id');
        $volunteer_data = ConfirmCamp::where('campaign_id', [$campaign_data])->Paginate(5);
        $order_count = Order::get()->whereNotIn('delivery_status', 'Received');
        return view('users.Partner.orderVolunteer')->with(['volunteerData' => $volunteer_data, 'partnerData' => $partner_data, 'orderData' => $this->orderData, 'orderCount' => $order_count]);
    }

    public function saveOrderVolunteer(Request $request, $id)
    {
        $order_full = Order::get();
        $this->volunteerId = $id;
        $day_name = Carbon::now()->dayName;
        $orderId = $request->order_id;
        $volunteer_data = Volunteer::where('id', $this->volunteerId)->pluck('volunteer_available');
        $updateOrder = $this->requestUpdateOrderVolunteer();
        if ($order_full->whereNotIn('delivery_status', 'Received')->where('volunteer_id', $this->volunteerId)->count('delivery_status') >= 1) {
            SweetAlert()->addWarning('Volunteer only can delivery 1 order', 'Warning');
            return back();
        } else {
            if (str_contains($volunteer_data, $day_name)) {
                Order::where('id', $orderId)->update($updateOrder);
                SweetAlert()->addSuccess('Volunteer Delivery Success', 'Success');
                return redirect()->route('partner#orderList');
            } else {
                SweetAlert()->addWarning('Volunteer not available', 'Warning');
                return back();
            }
        }
    }

    private function requestUpdateOrderVolunteer()
    {
        $arr = [
            'volunteer_id' => $this->volunteerId,
            'order_status' => 'Order by Volunteer',
            'delivery_status' => 'On Delivery',
            'start_delivery_time' => Carbon::now(),
        ];

        return $arr;
    }

    // public function volunteerOrders($id)
    // {
    //     $updateOrder = $this->requestUpdateOrder();
    //     Order::where('id', $id)->update($updateOrder);
    //     return back();
    // }

    // private function requestUpdateOrder()
    // {
    //     $volunteer_data = Volunteer::where('user_id', Auth::id())->first();
    //     $arr = [
    //         'volunteer_id' => $volunteer_data->id,
    //         'delivery_status' => 'Ready to delivery',
    //         'start_delivery_time' => Carbon::now(),
    //     ];

    //     return $arr;
    // }

    // public function partnerCook($id)
    // {
    //     Order::where('id', $id)->update(array('order_status' => 'Processed'));
    //     return back();
    // }

    // public function partnerFinish($id)
    // {
    //     Order::where('id', $id)->update(array('order_status' => 'Ready'));
    //     return back();
    // }

    // public function volunteerDelivered($id)
    // {
    //     Order::where('id', $id)->update(array('delivery_status' => 'Delivered'));
    //     return back();
    // }

    // public function volunteerReceived($id)
    // {
    //     Order::where('id', $id)->update(array('delivery_status' => 'Received'));
    //     return back();
    // }
}
