<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationFee;
use Stripe;

use Illuminate\Http\Request;

class donorController extends Controller
{
    public function donorInfo()
    {
        return view('donation.donorInfo');
    }
    public function donorPayment(Request $request)
    {
        $name = $request->name_donate;
        $email = $request->email_donate;
        $gender = $request->gender_donate;
        $phone = $request->phone_donate;
        $address = $request->address_donate;

        return view('donation.donorPayment')->with(['name' => $name, 'email' => $email, 'gender' => $gender, 'phone' => $phone, 'address' => $address]);
    }

    public function donorCheckout(Request $request)
    {
        $email = $request->email;
        $email_validation = Donation::where('email_donate', $email)->count();
        if ($email_validation == 0) {
            $donation = new Donation();
            $donationFee = new DonationFee();
            $donation->email_donate = $request->email;
            $donation->name_donate = $request->name;
            $donation->gender_donate = $request->gender;
            $donation->address_donate = $request->address;
            $donation->phone_donate = $request->phone;
            $donation->save();

            $donationFee->donation_id = $donation->id;
            $donationFee->amount = $request->amount;
            $donationFee->description = $request->description;
            $donationFee->save();

        } else {
            $donationId = Donation::where('email_donate', $email)->first();

            $donationFee = new DonationFee();
            $donationFee->donation_id = $donationId->id;
            $donationFee->amount = $request->amount;
            $donationFee->description = $request->description;
            $donationFee->save();
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "email" => $email,
            "name" => $request->name,
            "source" => $request->stripeToken
        ));
        \Stripe\Charge::create([
            "amount" => $request->amount * 100,
            "currency" => (env('STRIPE_CURRENCY')),
            "customer" => $customer->id,
            "description" => $request->description
        ]);
        sweetAlert()->addSuccess('Donor Successfuly');
        // return $email_validation;
        return redirect()->route('main');
    }
}
