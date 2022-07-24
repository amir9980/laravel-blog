<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker as PersianFaker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=> PersianFaker::word(),
            'body'=> PersianFaker::sentence(),
            'user_id'=>random_int(1,10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
