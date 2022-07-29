<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
                'title'=>'create articles'
            ],
            [
                'title'=>'update owned articles'
            ],
            [
                'title'=>'delete owned articles'
            ],
            [
                'title'=>'activate and deactivate articles'
            ],
            [
                'title'=>'update users articles'
            ],
            [
                'title'=>'delete users articles'
            ],
            [
                'title'=>'activate and deactivate users'
            ],
            [
                'title'=>'edit users'
            ],
            [
                'title'=>'activate and deactivate comments'
            ],
            [
                'title'=>'delete users comments'
            ],
            [
                'title'=>'create, edit and delete categories'
            ],
            [
                'title'=>'view any users'
            ]
        ];

        Permission::insert($data);
    }
}
