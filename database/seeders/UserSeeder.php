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
        Permission::create(['name' => 'configurations.publish']);
        Permission::create(['name' => 'configurations.unpublish']);

        $superadminRole = Role::create(['name' => 'super-admin']);
        $superadminRole->givePermissionTo([
            'configurations.view',
            'configurations.create',
            'configurations.edit',
            'configurations.delete',
            'configurations.publish',
            'configurations.unpublish',
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
            'configurations.publish',
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
        $memberRole->givePermissionTo([
            'configurations.view',
        ]);

        $member1 = User::factory()->create([
            'name' => 'Adon',
            'email' => 'adon@mail.com',
            'password' => bcrypt('password'),
        ]);
        $member1->assignRole($memberRole);
    }
}
