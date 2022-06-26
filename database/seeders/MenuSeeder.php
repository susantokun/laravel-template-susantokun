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
            // superadmin
            [
                'id' => 1,
                'role_id' => 1,
                'parent_id' => 0,
                'title' => 'Dashboard',
                'route_name' => 'dashboard',
                'route_group' => NULL,
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
                'route_name' => 'settings*',
                'route_group' => NULL,
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
                'title' => 'Accounts',
                'route_name' => 'accounts*',
                'route_group' => NULL,
                'icon' => 'users',
                'order' => 999,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // admin
            [
                'id' => 15,
                'role_id' => 2,
                'parent_id' => 0,
                'title' => 'Dashboard',
                'route_name' => 'dashboard',
                'route_group' => NULL,
                'icon' => 'home',
                'order' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'role_id' => 2,
                'parent_id' => 0,
                'title' => 'Settings',
                'route_name' => 'settings*',
                'route_group' => NULL,
                'icon' => 'settings',
                'order' => 998,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 17,
                'role_id' => 2,
                'parent_id' => 0,
                'title' => 'Accounts',
                'route_name' => 'accounts*',
                'route_group' => NULL,
                'icon' => 'users',
                'order' => 999,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
