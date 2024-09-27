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
use Illuminate\Support\Facades\Storage;


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

        // Validasi input dari form
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'school_name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Simpan data intern ke database
        $intern = new Intern();
        $intern->user_id = $user->id;
        $intern->profile_photo = $profilePhotoPath;
        $intern->phone_number = $request->input('phone_number');
        $intern->address = $request->input('address');
        $intern->gender = $request->input('gender');
        $intern->school_name = $request->input('school_name');
        $intern->save();

        return redirect()->route('intern#index')->with('success', 'Register Data successfully submitted');

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        return view('users.Member.internProfile')->with(['internData' => $intern_data, 'userData' => $user]);;
    }

    // Update intern profile information
    public function updateIntern(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gender' => 'required|string|max:10',
            'phone_number' => 'required|string|max:15',
            'school_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $intern = Intern::where('user_id', Auth::id())->first();
        $user = User::find(Auth::id());

        // Update User information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update Intern information
        $intern->gender = $request->gender;
        $intern->phone_number = $request->phone_number;
        $intern->school_name = $request->school_name;
        $intern->address = $request->address;
        $intern->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Update profile picture
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $intern = Intern::where('user_id', $user->id)->first();

        // Delete old profile photo if exists
        if ($intern->profile_photo) {
            Storage::delete('public/' . $intern->profile_photo);
        }

        // Store the new profile photo
        $filePath = $request->file('profile_photo')->store('profile_photos', 'public');

        // Update intern profile photo path
        $intern->profile_photo = $filePath;
        $intern->save();

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }
}
