<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewUsersTest extends TestCase
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
    public function adminLogin()
    {
        $this->get('/login');

        $this->post('/login', [
            'email'    => 'admin3@gmail.com',
            'password' => '123123',
        ]);
    }

    public function test_viewAllMembers()
    {
        $this->adminLogin();
        $response = $this->get('/admin/memberlist');

        $response->assertStatus(200);
    }

    public function test_viewAllPartners()
    {
        $this->adminLogin();
        $response = $this->get('/admin/partnerlist');

        $response->assertStatus(200);
    }

    public function test_viewAllVolunteers()
    {
        $this->adminLogin();
        $response = $this->get('/admin/volunteerlist');

        $response->assertStatus(200);
    }
    public function test_viewAllDrivers()
    {
        $this->adminLogin();
        $response = $this->get('/admin/driverlist');

        $response->assertStatus(200);
    }
}
