<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'configurations.view']);
        Permission::create(['name' => 'configurations.create']);
        Permission::create(['name' => 'configurations.edit']);
        Permission::create(['name' => 'configurations.delete']);

        Permission::create(['name' => 'roles.view']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        Permission::create(['name' => 'permissions.view']);
        Permission::create(['name' => 'permissions.create']);
        Permission::create(['name' => 'permissions.edit']);
        Permission::create(['name' => 'permissions.delete']);

        Permission::create(['name' => 'users.view']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);

        $superadminRole = Role::create(['name' => 'super-admin']);
        $superadminRole->givePermissionTo([
            'configurations.view',
            'configurations.create',
            'configurations.edit',
            'configurations.delete',

            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
        ]);
        $superAdmin = User::factory()->create([
            'username' => 'susantokun',
            'first_name' => 'Susantokun',
            'last_name' => NULL,
            'full_name' => 'Susantokun',
            'email' => 'susantokun.com@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '081906515912',
            'image_name' => NULL,
            'image_file' => NULL,
            'status' => 'active',
            'last_login_at' => NULL,
            'last_login_ip' => NULL,
            'created_by' => 'susantokun',
            'updated_by' => 'susantokun',
        ]);
        $superAdmin->assignRole($superadminRole);

        $superAdmin2 = User::factory()->create([
            'username' => 'superadmin',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'full_name' => 'Super Administrator',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('password'),
            'phone' => '081906515912',
            'image_name' => NULL,
            'image_file' => NULL,
            'status' => 'active',
            'last_login_at' => NULL,
            'last_login_ip' => NULL,
            'created_by' => 'susantokun',
            'updated_by' => 'susantokun',
        ]);
        $superAdmin2->assignRole($superadminRole);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'configurations.view',
            'configurations.create',
            'configurations.edit',

            'roles.view',
            'roles.create',
            'roles.edit',

            'permissions.view',

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
        ]);

        $admin1 = User::factory()->create([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => NULL,
            'full_name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'phone' => '081906515912',
            'image_name' => NULL,
            'image_file' => NULL,
            'status' => 'active',
            'last_login_at' => NULL,
            'last_login_ip' => NULL,
            'created_by' => 'superadmin',
            'updated_by' => 'superadmin',
        ]);
        $admin1->assignRole($adminRole);

        $memberRole = Role::create(['name' => 'member']);
        $memberRole->givePermissionTo([]);

        $member1 = User::factory()->create([
            'username' => 'member',
            'first_name' => 'Member',
            'last_name' => 'One',
            'full_name' => 'Member One',
            'email' => 'member@mail.com',
            'password' => bcrypt('password'),
            'phone' => '081906515912',
            'image_name' => NULL,
            'image_file' => NULL,
            'status' => 'active',
            'last_login_at' => NULL,
            'last_login_ip' => NULL,
            'created_by' => 'admin',
            'updated_by' => 'admin',
        ]);
        $member1->assignRole($memberRole);
    }
}
