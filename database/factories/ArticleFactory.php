<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ybazli\Faker\Facades\Faker as PersianFaker;
use function Ybazli\Faker\randomNumber;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = PersianFaker::sentence();
        return [
            'title'=> $title,
            'description'=> PersianFaker::sentence(),
            'body'=> PersianFaker::paragraph().PersianFaker::paragraph(),
            'slug'=> Str::replace(' ','-',$title).randomNumber(10),
            'tags'=>json_encode([PersianFaker::word(),PersianFaker::word()]),
            'category_id'=>random_int(1,5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
