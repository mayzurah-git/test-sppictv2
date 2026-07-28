<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    'roles' => [

        User::ROLE_SUPER_ADMIN,
        User::ROLE_URUS_SETIA,
        User::ROLE_PENGURUSAN,
        User::ROLE_PENGGUNA,

    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    */

    'permissions' => [

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

        // Report
        'report.view',
        'report.export',

        // Audit
        'audit.view',

    ],
/*
    |--------------------------------------------------------------------------
    | Matrix
    |--------------------------------------------------------------------------
    */
    'matrix' => [

        User::ROLE_SUPER_ADMIN => [
            '*',
        ],

        User::ROLE_URUS_SETIA => [

            'dashboard.view',

            'project.view',
            'project.create',
            'project.edit',
            'project.review',

            'meeting.view',
            'meeting.create',
            'meeting.edit',

            'user.view',
            'user.edit',

            'agency.view',

            'report.view',

        ],

        User::ROLE_PENGURUSAN => [

            'dashboard.view',

            'project.view',
            'project.review',

            'meeting.view',

            'report.view',

        ],

        User::ROLE_PENGGUNA => [

            'dashboard.view',

            'project.view',
            'project.create',
            'project.edit',
            'project.submit',

            ],

        ],
/*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    'admin' => [

        'name' => 'Super Administrator',

        'email' => 'admin@sppict.test',

        'password' => 'password',

        'role' => User::ROLE_SUPER_ADMIN,

    ],
/*
    |--------------------------------------------------------------------------
    | Pengguna
    |--------------------------------------------------------------------------
    */
    'pengguna' => [

        'name' => 'Pengguna',

        'email' => 'pengguna@sppict.test',

        'password' => 'password',

        'role' => User::ROLE_PENGGUNA,

    ],

    
];