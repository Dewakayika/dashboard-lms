<?php

namespace Tests\Unit;

use App\Models\Meal;
use Tests\TestCase;
use App\Models\User;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class UpdateUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function adminLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'partner@gmail.com',
            'password' => '123123',
        ]);
    }

    public function test_create_user(){

        $meals = Meal::create([
            'partner_id'=> 1,
            'meal_title' => 'Nasi Goreng Spesial kya kmu',
            'meal_type' => 'Hot',
            'meal_description' => 'Spesial bngt lah pkoknya',
            'meal_image' => '',

        ]);

        $mealCheck = Meal::find($meals);
        // $registeredMember = Member::find($member);
        $this->assertNotNull($mealCheck);
    }

    public function test_updating_meals()
    {
        $this->adminLogin();

        $user = new User([
            'id' => 1,
        ]);
    
        $this->be($user);
        
        $response = $this->post('/partner/updateMeal/12', [
            '_token' => csrf_token(),
            'id' => 12,
            'partner_id'=> '2',
            'meal_title' => 'Nasi Goreng Spesial kya kmu',
        ]);
        $response->assertSessionMissing('update');
    }
}