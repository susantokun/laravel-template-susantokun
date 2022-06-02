<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSubOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'role_id' => 1,
                'parent_id' => 2,
                'title' => 'Configurations',
                'route_name' => NULL,
                'icon' => 'corner-down-right',
                'order' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'role_id' => 1,
                'parent_id' => 3,
                'title' => 'Lists',
                'route_name' => 'users.index',
                'icon' => 'corner-down-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'role_id' => 1,
                'parent_id' => 3,
                'title' => 'Roles',
                'route_name' => 'roles.index',
                'icon' => 'corner-down-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'role_id' => 1,
                'parent_id' => 3,
                'title' => 'Permissions',
                'route_name' => 'permissions.index',
                'icon' => 'corner-down-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'role_id' => 1,
                'parent_id' => 3,
                'title' => 'User Role Permission',
                'route_name' => 'userRolePermission',
                'icon' => 'corner-down-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
