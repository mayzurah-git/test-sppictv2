<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('roles')->insert([
        [
            'role_name' => 'Pengguna Biasa',
            'description' => 'Pemohon projek ICT dari jabatan atau agensi',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'role_name' => 'Urus Setia',
            'description' => 'Urus setia / pentadbir sistem',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'role_name' => 'Pengurusan',
            'description' => 'Ahli Jawatankuasa Pra JTICT / JTICT / JPICT',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'role_name' => 'Superadmin',
            'description' => 'Pembangun dan pentadbir tertinggi sistem',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

}
