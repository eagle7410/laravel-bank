<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $count = Role::count();

        if ($count === 0) {
            // create roles and assign existing permissions
            $role = Role::create(['name' => User::ROLE_EMPLOYEE]);
            $role = Role::create(['name' => User::ROLE_CLIENT]);
            $role = Role::create(['name' => User::ROLE_SYSTEM]);
        }
    }
}
