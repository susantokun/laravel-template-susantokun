<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
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
                'id' => 1,
                'role_id' => 1,
                'parent_id' => 0,
                'title' => 'Dashboard',
                'route_name' => 'dashboard',
                'icon' => 'home',
                'order' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'role_id' => 1,
                'parent_id' => 0,
                'title' => 'Settings',
                'route_name' => NULL,
                'icon' => 'settings',
                'order' => 998,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'role_id' => 1,
                'parent_id' => 0,
                'title' => 'Users',
                'route_name' => NULL,
                'icon' => 'users',
                'order' => 999,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // admin
            [
                'id' => 4,
                'role_id' => 2,
                'parent_id' => 0,
                'title' => 'Dashboard',
                'route_name' => 'dashboard',
                'icon' => 'home',
                'order' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'role_id' => 2,
                'parent_id' => 0,
                'title' => 'Users',
                'route_name' => NULL,
                'icon' => 'users',
                'order' => 999,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
