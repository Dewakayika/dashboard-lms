<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Talent;
use App\Models\Intern;
use App\Models\User;
use App\Models\AssignmentVote;
use App\Models\SubmissionCourse;
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
        } else {
            // Ambil data dari tabel interns
            $intern_data = Intern::where('user_id', $user->id)->first();
            $userData = User::where('id', $intern_data->user_id)->first();
    
            // Ambil daftar course yang sudah diselesaikan user
            $completedCourses = SubmissionCourse::where('user_id', $user->id)
                                    ->pluck('course_name')
                                    ->toArray();
    
            return view('users.Member.internIndex')->with([
                'internData' => $intern_data, // Data intern
                'userData' => $userData, // Data user
                'completedCourses' => $completedCourses
            ]);
        }
    }
    
    

    public function additionalInfo(){
        return view('users.Member.register-intern');
    }

    public function submitForm(Request $request)
    {
    // Validasi input dari form
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB size limit
        'phone_number' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'gender' => 'required|string|max:10',
        'school_name' => 'required|string|max:255',
    ]);

    $user = Auth::user();

    // Handle upload foto profil
    if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Create a unique file name

        // Move the image to the 'public/images/profile' folder
        $image->move(public_path('images/profile'), $imageName);

        // Save the file path to store in the database
        $profilePhotoPath = 'images/profile/' . $imageName;
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



    // Chapter Intro
    // Introduction Course
    public function intro(Request $request)
    {
        $internData = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $internData->user_id)->first();
    
        $courseName = 'Introduction';
        $chapterName = 'Chapter_Introduction';
    
        // Check if a submission for this courseName by this user already exists
        $submissionExists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName)
            ->exists();
    
        // Prepare submission data if needed for the view
        $submissionData = [];
        if ($submissionExists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName)
                ->get();
    
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }
    
        return view('users.Member.courseIntroduction', compact('courseName', 'chapterName'))
            ->with([
                'internData' => $internData,
                'userData' => $user,
                'submissionExists' => $submissionExists,
                'submissionData' => $submissionData,
            ]);
    }    

    public function store(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'submission_file' => 'required|string',
            'course_name' => 'required|string',
            'chapter_name' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Ensure valid image and size
        ]);
    
        $existingSubmission = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $request->course_name)
            ->where('chapter_name', $request->chapter_name)
            ->first();
    
        if ($existingSubmission) {
            return redirect()->back()->with('error', "You've already submitted this assignment.");
        }
    
        // Handle thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Move the image to 'public/images/assignment_thumbnail'
            $image->move(public_path('images/assignment_thumbnail'), $imageName);
            
            // Define the path for storage in the database
            $thumbnailPath = 'images/assignment_thumbnail/' . $imageName;
        }
    
        $submission = new SubmissionCourse();
        $submission->user_id = $user->id; 
        $submission->course_name = $request->input('course_name');
        $submission->chapter_name = $request->input('chapter_name');
        $submission->submission_file = $request->input('submission_file'); 
        $submission->thumbnail = $thumbnailPath;
        $submission->submission_date = now();
        $submission->save();
    
        return redirect()->back()->with('success', 'Assignment successfully submitted!');
    }

    public function destroy($id)
    {
        // Find the submission by ID
        $submission = SubmissionCourse::findOrFail($id);

        if (!$submission) {
            return redirect()->back()->with('error', 'Submission not found');
        }

        // Delete the submission
        $submission->delete();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Submission deleted successfully.');
    }



    
  

    // Chapter #1
    // Basic Webtoon
    public function basicWebtoon()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        $courseName = 'Comic and Webtoon Introduction';
        $chapterName = 'Chapter_1';
        
        // Check if a submission for this courseName by this user already exists
        $submissionExists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName)
            ->exists();
    
        // Prepare submission data if needed for the view
        $submissionData = [];
        if ($submissionExists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName)
                ->get();
    
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }
    
        return view('users.Member.courseBasicWebtoon', compact('courseName', 'chapterName'))->with([ 
            'internData' => $intern_data, 
            'userData' => $user,                 
            'submissionExists' => $submissionExists,
            'submissionData' => $submissionData,
        ]);
    } 


    public function basicSketchup()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();
    
        $courseName = 'Assignment 1 | Introduction in to Sketchup';
        $courseName2 = 'Assignment 2 | Introduction in to Sketchup';
        $courseName3 = 'Assignment 3 | Introduction in to Sketchup';

        $chapterName = 'Chapter_2';
    
        // Check if a submission for each courseName by this user already exists
        $submission1Exists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName)->exists();
    
        $submission2Exists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName2)->exists();
    
        $submission3Exists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName3)->exists();
    
        // Prepare submission data if needed for the view
        $submissionData = [];
        
        if ($submission1Exists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName)->get();
        
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }
    
        if ($submission2Exists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName2)->get();
        
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }
    
        if ($submission3Exists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName3)->get();
        
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }
        
        return view('users.Member.courseIntroSketchup', compact('courseName', 'chapterName', 'courseName2', 'courseName3'))->with([
            'internData' => $intern_data, 
            'userData' => $user,
            'submission1Exists' => $submission1Exists,
            'submission2Exists' => $submission2Exists,
            'submission3Exists' => $submission3Exists,
            'submissionData' => $submissionData,
        ]);
    }
    


    public function sketchupPhotoshop()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        $courseName = 'Sketchup to Photoshop Post Processing';
        $chapterName = 'Chapter_3';

        // Check if a submission for this courseName by this user already exists
        $submissionExists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName)
            ->exists();
    
        // Prepare submission data if needed for the view
        $submissionData = [];
        if ($submissionExists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName)
                ->get();
    
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }

        return view('users.Member.courseSketchupPhotoshop', compact('courseName', 'chapterName'))->with([
            'internData' => $intern_data, 
            'userData' => $user,
            'submissionExists' => $submissionExists,
            'submissionData' => $submissionData,
        ]);;
    }

    public function advanceTool()
    {
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

        $courseName = 'Advance Tools Webtoon Design';
        $chapterName = 'Chapter_4';

        // Check if a submission for this courseName by this user already exists
        $submissionExists = SubmissionCourse::where('user_id', $user->id)
            ->where('course_name', $courseName)
            ->exists();
    
        // Prepare submission data if needed for the view
        $submissionData = [];
        if ($submissionExists) {
            $submissions = SubmissionCourse::where('user_id', $user->id)
                ->where('course_name', $courseName)
                ->get();
    
            foreach ($submissions as $submission) {
                $submission->alreadySubmitted = true; // Flag as submitted
                $submissionData[$submission->course_name][] = $submission; // Group by course_name
            }
        }

        return view('users.Member.courseAdvanceTool', compact('courseName', 'chapterName'))->with([
            'internData' => $intern_data, 
            'userData' => $user,
            'submissionExists' => $submissionExists,
            'submissionData' => $submissionData,
        
        ]);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function profile()
     {
         // Ambil data intern berdasarkan user_id dari Auth
         $intern_data = Intern::where('user_id', Auth::id())->first();
     
         // Ambil data user langsung dari Auth, tidak perlu query lagi
         $user = Auth::user();
     
         // Ambil semua submission dari user yang sedang login
         $submissionCourse = SubmissionCourse::where('user_id', Auth::id())->get();
     
         // Mengirim data ke view
         return view('users.Member.internProfile')->with([
             'internData' => $intern_data,
             'userData' => $user,
             'submission' => $submissionCourse
         ]);
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
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10 MB limit
    ], [
        'profile_photo.required' => 'Profile photo is required.',
        'profile_photo.image' => 'The file must be an image.',
        'profile_photo.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        'profile_photo.max' => 'The image size must not exceed 10MB.', // Custom error message for size
    ]);

    $user = Auth::user();
    $intern = Intern::where('user_id', $user->id)->first();

    // Delete old profile photo if exists
    if ($intern->profile_photo) {
        // Delete the old photo from the public/images/profile directory
        Storage::delete('public/' . $intern->profile_photo);
    }

    // Handle new profile photo upload
    if ($request->hasFile('profile_photo')) {
        $image = $request->file('profile_photo');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Create a unique file name

        // Move the image to the 'public/images/profile' folder
        $image->move(public_path('images/profile'), $imageName);

        // Update intern profile photo path
        $intern->profile_photo = 'images/profile/' . $imageName; // Store the relative path
    }

    $intern->save();

    return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }

    /*

    Gallery Selection
    Gallery is page to store all submission from user in same batch (Validate based on Registration Code)

    */
    public function gallery()
    {
        // Mendapatkan data user
        $intern_data = Intern::where('user_id', Auth::id())->first();
        $user = User::where('id', $intern_data->user_id)->first();

    
        $registrationCode = Auth::user()->registration_code;
        $userId = Auth::id();
    
        // Query untuk mendapatkan semua hasil karya dengan registration code yang sama
        $submissions = SubmissionCourse::whereHas('user', function ($query) use ($registrationCode) {
                $query->where('registration_code', $registrationCode);
            })
            ->where('user_id', '!=', $userId) // Hindari karya sendiri
            ->with(['votes' => function($query) {
                $query->selectRaw('submission_id, SUM(vote_value) as total_vote_value')
                      ->groupBy('submission_id'); // Tambahkan GROUP BY
            }])
            ->get();
    
        // Cek apakah user sudah vote pada setiap submission
        $submissionData = [];
        foreach ($submissions as $submission) {
            $submission->alreadyVoted = $submission->votes()->where('voter_id', $userId)->exists();
            $submissionData[$submission->course_name][] = $submission; // Group by course_name
        }

        $isEmpty = empty($submissionData);
    
        return view('users.Member.gallery', compact('submissionData', 'isEmpty'))->with([
            'internData' => $intern_data,
            'userData' => $user
        ]);
    }
    

    public function storeVote(Request $request, SubmissionCourse $submission)
    {
        // Validasi input
        $request->validate([
            'vote_value' => 'required|integer|min:1|max:10',
        ]);

        $userId = Auth::id();

        // Cek jika user sudah pernah vote sebelumnya
        if ($submission->votes()->where('voter_id', $userId)->exists()) {
            return back()->with(['error' => 'You already vote this assignment.']);
        }

        // Simpan vote
        $submission->votes()->create([
            'voter_id' => $userId,
            'vote_value' => $request->input('vote_value'),
        ]);

        return back()->with('success', 'Vote succesfully given.');
    }
}
