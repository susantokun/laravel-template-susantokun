<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSubTwoSeeder extends Seeder
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
                'id' => 11,
                'role_id' => 1,
                'parent_id' => 6,
                'title' => 'General',
                'route_name' => 'configurations.general',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'role_id' => 1,
                'parent_id' => 6,
                'title' => 'About',
                'route_name' => 'configurations.about',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'role_id' => 1,
                'parent_id' => 6,
                'title' => 'Contact',
                'route_name' => 'configurations.contact',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'role_id' => 1,
                'parent_id' => 6,
                'title' => 'Privacy Policy',
                'route_name' => 'configurations.privacyPolicy',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'role_id' => 1,
                'parent_id' => 6,
                'title' => 'Term And Condition',
                'route_name' => 'configurations.termAndCondition',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
