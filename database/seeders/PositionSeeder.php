<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['position_name' => 'Akauntan'],
            ['position_name' => 'Juruteknik Komputer'],
            ['position_name' => 'Jurutera (Awam)'],
            ['position_name' => 'Ketua Pembantu Tadbir'],
            ['position_name' => 'Pegawai Belia dan Sukan'],
            ['position_name' => 'Pegawai Khas'],
            ['position_name' => 'Pegawai Khidmat Pelanggan'],
            ['position_name' => 'Pegawai Perancang Bandar dan Desa'],
            ['position_name' => 'Pegawai Pertanian'],
            ['position_name' => 'Pegawai Psikologi'],
            ['position_name' => 'Pegawai Syariah'],
            ['position_name' => 'Pegawai Tadbir'],
            ['position_name' => 'Pegawai Tadbir dan Diplomatik'],
            ['position_name' => 'Pegawai Teknologi Maklumat'],
            ['position_name' => 'Pegawai Tugas-tugas Khas'],
            ['position_name' => 'Pegawai Veterinar'],
            ['position_name' => 'Pelukis Pelan'],
            ['position_name' => 'Penolong Akauntan'],
            ['position_name' => 'Penolong Bendahari Negeri'],
            ['position_name' => 'Penolong Jurutera'],
            ['position_name' => 'Penolong Kurator'],
            ['position_name' => 'Penolong Pegawai Belia dan Sukan'],
            ['position_name' => 'Penolong Pegawai Hal Ehwal Islam'],
            ['position_name' => 'Penolong Pegawai Perancang Bandar dan Desa'],
            ['position_name' => 'Penolong Pegawai Pertanian'],
            ['position_name' => 'Penolong Pegawai Psikologi'],
            ['position_name' => 'Penolong Pegawai Tadbir'],
            ['position_name' => 'Penolong Pegawai Tanah'],
            ['position_name' => 'Penolong Pegawai Teknologi Maklumat'],
            ['position_name' => 'Penolong Pegawai Veterinar'],
            ['position_name' => 'Penolong Pemelihara Hutan'],
            ['position_name' => 'Renjer Hutan'],
            ['position_name' => 'Setiausaha Pejabat'],
            ['position_name' => 'Timbalan Bendahari Negeri'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
