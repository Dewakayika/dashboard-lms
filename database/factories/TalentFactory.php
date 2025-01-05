<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class TalentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>'2',
            'full_name'=>'I Dewa Gede Ananda Putra Kayika',
            'Address'=> 'Payangan, Gianyar',
            'Bank_Account'=>'123456789',
            'profile_photo'=>'photo.jpg',
            'phone_number'=>'08133733709',
            'gender'=>'male',
            'date_of_birth'=>'agustus 2004',
            'id_card'=>'11123456789',
            'bank_name'=>'BRI',
            'swift_code'=>'BRITAMA',
            'subjected_tax'=>'None',
        ];
    }
}
