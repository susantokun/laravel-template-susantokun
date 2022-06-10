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
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);
        $superAdmin->assignRole($superadminRole);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'configurations.view',
            'configurations.create',
            'configurations.edit',

            'roles.view',
            'roles.create',
            'roles.edit',

            'permissions.view',
            'permissions.create',
            'permissions.edit',

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
        ]);

        $admin1 = User::factory()->create([
            'name' => 'Susantokun',
            'email' => 'susantokun@mail.com',
            'password' => bcrypt('password'),
        ]);
        $admin1->assignRole($adminRole);

        $admin2 = User::factory()->create([
            'name' => 'Ekstra',
            'email' => 'ekstra@mail.com',
            'password' => bcrypt('password'),
        ]);
        $admin2->assignRole($adminRole);

        $memberRole = Role::create(['name' => 'member']);
        $memberRole->givePermissionTo([]);

        $member1 = User::factory()->create([
            'name' => 'Adon',
            'email' => 'adon@mail.com',
            'password' => bcrypt('password'),
        ]);
        $member1->assignRole($memberRole);
    }
}
