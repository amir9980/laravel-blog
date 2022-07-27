<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'user'
            ],
            [
                'title' => 'writer'
            ],
            [
                'title' => 'watcher'
            ],
            ['title' => 'admin'
            ]
        ];

        Role::insert($data);
    }
}
