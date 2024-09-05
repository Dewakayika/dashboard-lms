<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class partnerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAddMeal()
    {
        $partner_response = $this->post(
            '/login',
            [
                "email" => 'partner@gmail.com',
                'password' => '123123'
            ]
        );

        $partner_auth = Auth::user();
        assertEquals('partner', $partner_auth->role);
        $partner_response->assertRedirect(route('dashboard'));

        Auth::logout();

    }

    // public function test_saveMenu()
    // {
    //     $this->partnerLogin();

    //     Storage::fake('local');
    //     $file = UploadedFile::fake()->create('MeatBall.jpg');

    //     $response = $this->post('/partner/saveMenu', [
    //         '_token' => csrf_token(),
    //         'partner_id' => '1',
    //         'meal_title' => 'Meatball',
    //         'meal_type' => 'Hot',
    //         'meal_description' => 'Homemade Chicken Meatball',
    //         'meal_image' => $file,
    //         ''
    //     ]);

    //     $response->assertSessionHas('menuCreated', 'Menu Has Been Created Sucessfully!');
    // }
}
