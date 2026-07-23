<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $permissions = [

            // Dashboard
            'dashboard.view',

            // User
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Agency
            'agency.view',
            'agency.create',
            'agency.edit',
            'agency.delete',

            // Position
            'position.view',
            'position.create',
            'position.edit',
            'position.delete',

            // Project
            'project.view',
            'project.create',
            'project.edit',
            'project.delete',
            'project.submit',
            'project.review',
            'project.approve',
            'project.reject',

            // Meeting
            'meeting.view',
            'meeting.create',
            'meeting.edit',
            'meeting.delete',

            // Audit
            'audit.view',

            // Report
            'report.view',
            'report.export',
        ];

        foreach (config('rbac.permissions') as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
