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
            // superadmin
            [
                'id' => 10,
                'role_id' => 1,
                'parent_id' => 4,
                'title' => 'General',
                'route_name' => 'settings.configurations.general',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'role_id' => 1,
                'parent_id' => 4,
                'title' => 'About',
                'route_name' => 'settings.configurations.about',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'role_id' => 1,
                'parent_id' => 4,
                'title' => 'Contact',
                'route_name' => 'settings.configurations.contact',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'role_id' => 1,
                'parent_id' => 4,
                'title' => 'Privacy Policy',
                'route_name' => 'settings.configurations.privacyPolicy',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'role_id' => 1,
                'parent_id' => 4,
                'title' => 'Term And Condition',
                'route_name' => 'settings.configurations.termAndCondition',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // admin
            [
                'id' => 21,
                'role_id' => 2,
                'parent_id' => 18,
                'title' => 'General',
                'route_name' => 'settings.configurations.general',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 22,
                'role_id' => 2,
                'parent_id' => 18,
                'title' => 'About',
                'route_name' => 'settings.configurations.about',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 23,
                'role_id' => 2,
                'parent_id' => 18,
                'title' => 'Contact',
                'route_name' => 'settings.configurations.contact',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 24,
                'role_id' => 2,
                'parent_id' => 18,
                'title' => 'Privacy Policy',
                'route_name' => 'settings.configurations.privacyPolicy',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 25,
                'role_id' => 2,
                'parent_id' => 18,
                'title' => 'Term And Condition',
                'route_name' => 'settings.configurations.termAndCondition',
                'route_group' => 'settings.configurations*',
                'icon' => 'chevron-right',
                'order' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
