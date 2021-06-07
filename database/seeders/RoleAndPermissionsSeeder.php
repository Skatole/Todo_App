<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'add posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);

        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view developers']);
        Permission::create(['name' => 'view managers']);
        Permission::create(['name' => 'view everyone']);


        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'Developer']);
        $role->givePermissionTo('edit posts', 'delete posts', 'add posts', 'view managers');

        // or may be done by chaining
        $role = Role::create(['name' => 'Manager']);
        $role->givePermissionTo(['add posts', 'edit posts', 'delete posts', 'view developers']);

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
