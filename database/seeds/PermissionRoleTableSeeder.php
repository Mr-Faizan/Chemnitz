<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));


        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) == 'shop_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);


        $power_user_permissions = $admin_permissions->filter(function ($permission) {
            return $permission->id == 27;
        });
        Role::findOrFail(3)->permissions()->sync($power_user_permissions);
    }
}
