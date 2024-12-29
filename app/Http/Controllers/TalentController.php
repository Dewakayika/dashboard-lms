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
            return view('users.Talent.talentIndex')->with([ 'talentData' => $talent_data, 'userData' => $user]);
        }
    }


}
