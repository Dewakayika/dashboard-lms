<?php

namespace Tests\Feature;

use App\Models\Feedback;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteFeedbackTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $feedbackData;
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_create_user()
    {

        $user = User::create([
            'name' => 'Member2',
            'email'    => 'member2@gmail.com',
            'gender' => '1',
            'address' => 'Secret Broo',
            'lat' => '-8.69011654794025',
            'long' => '115.22790351696908s',
            'phone' => '+61089634793',
            'password' => bcrypt('123123'),
            'role' => 'member',
        ]);

        $member = Member::create([
            'user_id' => $user->id,
            'member_caregiver_name' => 'Member',
            'member_caregiver_relation' => 'Father',
            'member_caregiver_number' => '+62813315868',
            'member_medical_condition' => 'Sakit Jantung',
            'member_start_service' => Carbon::now(),
            'member_end_service' => Carbon::now()->addDays(30)
        ]);
        $registeredMember = Member::find($member);
        $registeredUser = User::find($user);
        $this->assertNotNull($registeredMember, $registeredUser);
    }

    public function test_create_feedback()
    {
        $feedback = Feedback::create([
            'user_id' => 2,
            'feedback_subject' => 'lagging',
            'feedback_message' => 'Your so lag, no issue if use for another app but, if access this website is so laggy',
        ]);
        $this->feedbackData = $feedback->id;
        $userFeedback = Feedback::find($feedback);
        $this->assertNotNull($userFeedback);
    }

    public function test_delete_feedback()
    {
        Feedback::where('id', 1)->delete();
        $feedbackDat = Feedback::find(1);
        $this->assertNull($feedbackDat);
    }
}
