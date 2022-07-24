<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker as PersianFaker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'articles_count'=> random_int(0,10),
            'bio'=>PersianFaker::paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
