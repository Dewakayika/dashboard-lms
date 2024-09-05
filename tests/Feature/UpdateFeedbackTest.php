<?php

namespace Tests\Unit;

use App\Models\Feedback;
use Tests\TestCase;
use App\Models\User;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateFeedbackTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public $userData;
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function adminLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'admin3@gmail.com',
            'password' => '123123',
        ]);
    }

    public function test_create_user()
    {

        $user = User::create([
            'name' => 'Member5',
            'email'    => 'member5@gmail.com',
            'gender' => '1',
            'address' => 'Secret Broo',
            'lat' => '-8.69011654794025',
            'long' => '15.22790351696908',
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

        $registeredUser = User::find($user);
        $registeredMember = Member::find($member);
        $this->assertNotNull($registeredUser, $registeredMember);
        $this->userData = $user->id;
    }

    public function test_create_feedback()
    {
        $feedback = Feedback::create([
            'user_id' => 2,
            'feedback_subject'    => 'lagging',
            'feedback_message' => 'Your so lag, no issue if use for another app but, if access this website is so laggy',
        ]);
        $userFeedback = Feedback::find($feedback);
        $this->assertNotNull($userFeedback);
    }

    public function test_updating_feedback()
    {
        $this->adminLogin();

        $response = $this->post('/admin/updateFeedback/1', [
            '_token' => csrf_token(),
            'id' => '1',
            'feedback_subject' => 'Feedback Has been updated',
            'feedback_message' => 'Feedback Has been updated',
        ]);

        $response->assertSessionHas('feedbackUpdated', 'Feedback Has Been Updated Successfully!');
    }
}
