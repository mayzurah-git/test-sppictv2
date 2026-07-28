<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Cipta semua role
        foreach (config('rbac.roles') as $roleName) {

            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

        }

        // Assign permission kepada role
        foreach (config('rbac.matrix') as $roleName => $permissions) {

            $role = Role::findByName($roleName, 'web');

            if (in_array('*', $permissions)) {

                $role->syncPermissions(Permission::all());

            } else {

                $role->syncPermissions($permissions);

            }
        }
    }

    public function rollback(): void
    {
        // Padam semua role
        foreach (config('rbac.roles') as $roleName) {
            $role = Role::findByName($roleName, 'web');
            if ($role) {
                $role->delete();
            }
        }
    }

    public function rollbackPermissions(): void
    {
        // Padam semua permission
        foreach (config('rbac.permissions') as $permissionName) {
            $permission = Permission::findByName($permissionName, 'web');
            if ($permission) {
                $permission->delete();
            }
        }
    }

}