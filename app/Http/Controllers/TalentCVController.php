<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCV;

class TalentCVController extends Controller
{
    public function index(){
        return view('cv.talent_cv');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:talent_c_v_s,email',
            'phone_number' => 'required|string|max:15',
            'cv_file' => 'required|mimes:pdf,doc,docx|max:2048',
        ], [
            'email.unique' => 'The email address has already been registered. Please use a different email.',
        ]);

        // Store the uploaded CV file
        $cvFileName = $request->file('cv_file')->store('cv_files', 'public');

        // Save the data to the database
        TalentCV::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'cv_file' => $cvFileName,
        ]);

        // return view ('cv.sucess-cv');
        return redirect()->back()->with('success', 'CV uploaded successfully.');
    }
}
