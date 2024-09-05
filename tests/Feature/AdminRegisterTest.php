<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    // use RefreshDatabase;
    public function test_adminRegister()
    {
        $user = User::factory()->create([
            'name' => 'Admin3',
            'email' => 'admin3@gmail.com',
            'gender' => '1',
            'address' => 'Who I am',
            'long' => '-8.690116547940255',
            'lat' => '15.22790351696909',
            'phone' => '7637871',
            'password' => bcrypt('123123'),
            'role' => 'admin',
            
        ]);
        $registered = User::find($user);
        $this->assertNotNull($registered);
    }
}
