<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public $userData;
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_create_user()
    {

        $user = User::create([
            'name' => 'Member',
            'email'    => 'member@gmail.com',
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
        $this->userData = $user->id;
    }
    public function test_delete_user()
    {
        $userDat = User::find($this->userData);
        User::where('id', $this->userData)->delete();
        $this->assertNull($userDat);
    }
}
