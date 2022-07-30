<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
                'name'=>'امیر',
                'username'=>'amir',
                'email'=>'amir@yahoo.com',
                'password'=>bcrypt('11111111'),
                'role_id'=>4,
                'remember_token'=>Str::random(10)
        ]);

        $user->profile()->create();

        User::factory()
            ->has(Profile::factory()->count(1))
            ->has(Article::factory()
                ->has(Comment::factory()->count(10))->count(5))
            ->count(10)->create();
    }
}
