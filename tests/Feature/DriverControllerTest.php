<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotFalse;

class DriverControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    public function test_driver_action()
    {
        $driver_response = $this->post(
            '/login',
            [
                "email" => 'driver@gmail.com',
                'password' => '123123'
            ]
        );

        $driver_auth = Auth::user();
        assertEquals('driver', $driver_auth->role);
        $driver_response->assertRedirect(route('dashboard'));

        Auth::logout();
    }

    public function test_driver_profile()
    {
        $response = $this -> get('/profile');

        assertNotFalse($response);

    }

}