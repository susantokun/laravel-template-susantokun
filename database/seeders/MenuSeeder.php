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
        ]);
    }
}
