<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $writer = Role::find(2);
        $writer->permissions()->attach([1,2,3]);

        $watcher = Role::find(3);
        $watcher->permissions()->attach([1,2,3,4,7,8,9,12]);

        $admin = Role::find(4);
        $admin->permissions()->attach([1,2,3,4,5,6,7,8,9,10,11,12]);
    }
}
