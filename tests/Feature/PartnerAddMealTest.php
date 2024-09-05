<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Meal;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertNotTrue;
use function PHPUnit\Framework\assertTrue;

class partnerAddMealTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function partnerLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'partner@gmail.com',
            'password' => '123123',
        ]);
    }

    //  public function test_MealList ()
    // {
    //     $response= $this->get("/mealList");
    //     assertNotFalse($response);
    // }

    public function test_AddMeal ()
    {$meals = Meal::create([
            'partner_id' => '1',
            'meal_title' => 'Nasi Goreng Spesial kya kmu',
            'meal_type' => 'Hot',
            'meal_description' => 'Spesial bngt lah pkoknya',
            'meal_image' => '',

        ]);

        $mealCheck = Meal::find($meals);
        // $registeredMember = Member::find($member);
        $this->assertNotNull($mealCheck);
    }

    public function test_UpdateMeal ()
    {
        $this->partnerLogin();
        $response = $this->post('/partner/updateMeal/26', [
            '_token' => csrf_token(),
            'id' => '26',
            'meal_title' => 'Update meal',
            'meal_description' => 'Deliciouss',
            'meal_type' => 'Hot',
            'partner' => 1,
        ]);

        $response->assertSessionHasNoErrors(' mealUpdated', 'Meal Has Been Updated Successfully!');
    }
}
