<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertNotTrue;
use function PHPUnit\Framework\assertTrue;

class memberTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_loginMember()
    {
        $member_response = $this->post(
            '/login',
            [
                "email" => 'member@gmail.com',
                'password' => '123123'
            ]
        );

        // $partner_auth = Auth::user();
        assertNotFalse($member_response);
        // $partner_response->assertEquals('partner', $partner_auth->role);
        // $partner_response->assertRedirect(route('dashboard'));

        // Auth::logout();

    }
}
