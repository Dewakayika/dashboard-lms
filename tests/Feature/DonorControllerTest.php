<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotFalse;
use function PHPUnit\Framework\assertTrue;

class DonorControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *php artisan test --filter DonorControllerTest
     * @return void
     */
    public function test_donor_page()
    {
        $response = $this->get('/donorInfo');

        $response->assertStatus(200);

    }

    public function test_donor_payment()
    {
        $response = $this->get('/donorPayment');

       assertNotFalse($response);

    }

    public function test_donor_post()
    {
        $response = $this->post('/donorCheckout',[
            'email_donate'=>'fredy@gmail.com',
            'name_donate'=>'fredy',
            'gender_donate'=>'male',
            'address_donate'=>'indonesia',
            'phone_donate'=>'0812345678',
            'donation_id'=>'1',
            'amount'=>'$100',
            'description'=>'hello',
        ]);

      $this -> assertTrue(true);

    }


}
