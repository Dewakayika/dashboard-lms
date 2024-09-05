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
            'user_id' => '2',
            'school' => 'SMK TI Global',
            'date_of_birth' => 'sekarang',
            'bank_name' => 'BRI',
            'bank_account' => '09866383',
        ];
    }
}
