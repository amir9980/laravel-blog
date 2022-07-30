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
                'title' => 'user',
                'farsi_name'=>'کاربر'
            ],
            [
                'title' => 'writer','farsi_name'=>'نویسنده'
            ],
            [
                'title' => 'watcher','farsi_name'=>'بازرس'
            ],
            ['title' => 'admin','farsi_name'=>'مدیر'
            ]
        ];

        Role::insert($data);
    }
}
