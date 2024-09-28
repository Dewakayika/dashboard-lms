<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CourseController extends Controller
{
    public function updateProgress(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'progress' => 'required|string',
            'watched_time' => 'required|integer',
        ]);

        $user = User::find($validatedData['user_id']);
        $courseKey = 'course_1'; // Ganti ini sesuai dengan logika kursus Anda

        // Update progres di JSON
        $courseProgress = $user->course_progress;
        $courseProgress[$courseKey] = [
            'progress' => $validatedData['progress'],
            'watched_time' => $validatedData['watched_time']
        ];
        $user->course_progress = json_encode($courseProgress);
        $user->save();

        return response()->json(['success' => true, 'data' => $courseProgress]);
    }
}
