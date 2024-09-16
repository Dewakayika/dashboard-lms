<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdditionalInfoController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();

        if ($user->role === 'intern') {
            return view('auth.register-intern');
        } elseif ($user->role === 'talent') {
            return view('auth.register-talent');
        }

        return redirect()->route('home');
    }

    public function submitForm(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'intern') {
            $request->validate([
                'job' => ['required', 'string'],
            ]);

            $intern = new Intern();
            $intern->job = $request->input('job');
            $intern->user_id = $user->id;
            $intern->save();
        } elseif ($user->role === 'talent') {
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
        }

        return redirect()->route('home');
    }
}
