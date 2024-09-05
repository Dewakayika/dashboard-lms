<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public $driverId;
    //index
    public function index()
    {
        $order_data = Order::where('start_delivery_time', NULL)->paginate(10);
        return view('users.Driver.driverIndex')->with(['orderData' => $order_data]);
    }
    public function profile()
    {
        $user_data = Driver::where('user_id', Auth::id())->first();
        return view('users.Driver.driverProfile')->with(['userData' => $user_data]);;
    }

    public function editProfile()
    {
        $driver_data = Driver::where('user_id', Auth::id())->first();
        return view('users.driver.updateDriver')->with(['driverData' =>  $driver_data]);
    }


    public function updateDriver(Request $request)
    {
        $update_driver = $this->requestUpdateDriver($request);
        $update_user = $this->requestUpdateUser($request);
        $driver_data = Driver::where('user_id', Auth::id())->first();

        $updateImgData = Driver::select('driver_license')->where('id', $driver_data->id)->first();
        $updateImage = $updateImgData['driver_license'];


        if ($request->hasfile('driver_license')) {

            if (File::exists(public_path() . '/uploads/driver/' . $updateImage)) {
                File::delete(public_path() . '/uploads/driver/' . $updateImage);
            }

            $newImageFile = $request->file('driver_license');
            $newImageName = uniqid() . '_' . $newImageFile->getClientOriginalName();
            $newImageFile->move(public_path() . './uploads/driver/', $newImageName);

            $update_driver['driver_license'] = $newImageName;
        }

        Driver::where('id', $driver_data->id)->update($update_driver);
        User::where('id', $driver_data->users->id)->update($update_user);

        return redirect()->route('driver#driverProfile');
    }

    private function requestUpdateDriver($request)
    {
        $menuArray = [
            'updated_at' => Carbon::now(),
        ];

        if (isset($request->driver_license)) {
            $menuArray['driver_license'] = $request->driver_license;
        }

        return $menuArray;
    }

    private function requestUpdateUser($request)
    {
        $arr = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        return $arr;
    }

    public function OrderDriver($id)
    {
        $order_full = Order::get();
        $this->driverId = Driver::where('user_id', Auth::id())->first()->id;
        $orderId = $id;
        $updateOrder = $this->requestUpdateOrder();
        if ($order_full->whereNotIn('delivery_status', 'Received')->where('driver_id', $this->driverId)->count('delivery_status') >= 3) {
            SweetAlert()->addWarning('Driver only can delivery 3 orders', 'Warning');
            return back();
        } else {
            Order::where('id', $orderId)->update($updateOrder);
            SweetAlert()->addSuccess('Order Driver Successfully', 'Success');
            return redirect()->route('driver#index');
        }
    }

    private function requestUpdateOrder()
    {
        $arr = [
            'driver_id' => $this->driverId,
            'order_status' => 'Order by Driver',
            'delivery_status' => 'On Delivery',
            'start_delivery_time' => Carbon::now(),
        ];

        return $arr;
    }

    public function driverOrder()
    {
        $driver_data = Driver::where('user_id', Auth::id())->first();
        $order_data = Order::where('driver_id', $driver_data->id)->whereNot('delivery_status', 'Received')->paginate(10);
        return view('users.Driver.driverOrder')->with(['orderData' => $order_data]);
    }

    public function orderHistory()
    {
        $driver_data = Driver::where('user_id', Auth::id())->first();
        $order_data = Order::where('driver_id', $driver_data->id)->where('delivery_status', 'Received')->paginate(10);
        return view('users.Driver.driverOrderHistory')->with(['orderData' => $order_data]);
    }
}
