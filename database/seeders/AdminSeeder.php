<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $config = config('rbac.admin');

        $admin = User::firstOrCreate(

            [
                'email' => $config['email'],
            ],

            [
                'name' => $config['name'],
                'password' => Hash::make($config['password']),
            ]

        );

        // Pastikan hanya satu role diberikan
        $admin->syncRoles([$config['role']]);
    }
}