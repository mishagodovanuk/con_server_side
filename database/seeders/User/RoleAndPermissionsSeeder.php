<?php

namespace Database\Seeders\User;

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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        if (Role::count() == 0) {

            $commonPermission = [
                'dispatcher', 'logistic'
            ];

            foreach ($commonPermission as $permission) {
                Permission::create(['name' => $permission]);
            }


            Role::create([
                'name' => 'super_admin',
                'title' => 'Адміністратор системи',
                'visible' => 0
            ]);

            Role::create([
                'name' => 'admin',
                'title' => 'Адміністратор'
            ])->givePermissionTo($commonPermission);

            Role::create([
                'name' => 'user',
                'title' => 'Користувач',
            ]);

            Role::create([
                'name' => 'logistic',
                'title' => 'Логіст',
                'visible' => 0
            ])->givePermissionTo('logistic');

            Role::create([
                'name' => 'dispatcher',
                'title' => 'Диспечер',
                'visible' => 0
            ])->givePermissionTo('dispatcher');

        }

    }
}
