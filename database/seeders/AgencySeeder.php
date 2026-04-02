<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agencies')->insert([
            [
                'agency_name' => 'Jabatan Hal Ehwal Agama Islam Negeri Sembilan',
                'agency_code' => 'JHEAINS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Kerja Raya Negeri Sembilan',
                'agency_code' => 'JKRNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Kehakiman Syariah Negeri Sembilan',
                'agency_code' => 'JKSNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Pengairan dan Saliran Negeri Sembilan',
                'agency_code' => 'JPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Pendakwaan Syariah Negeri Sembilan',
                'agency_code' => 'JPeNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Mufti Kerajaan Negeri Sembilan',
                'agency_code' => 'MuftiNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'PLANMalaysia@Negeri Sembilan',
                'agency_code' => 'PLANNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Perhutanan Negeri Sembilan',
                'agency_code' => 'HutanNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Perkhidmatan Veterinar Negeri Sembilan',
                'agency_code' => 'VeterinarNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Jabatan Pertanian Negeri Sembilan',
                'agency_code' => 'PertanianNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Lembaga Muzium Negeri Sembilan',
                'agency_code' => 'LMNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Lembaga Pelancongan Negeri Sembilan',
                'agency_code' => 'LPNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Agama Negeri Sembilan',
                'agency_code' => 'MAINS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Bandaraya Seremban',
                'agency_code' => 'MBS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Daerah Jelebu',
                'agency_code' => 'MDJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Daerah Rembau',
                'agency_code' => 'MDR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Daerah Kuala Pilah',
                'agency_code' => 'MDKP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Daerah Tampin',
                'agency_code' => 'MDT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Perbandaran Jempol',
                'agency_code' => 'MPJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Majlis Perbandaran Port Dickson',
                'agency_code' => 'MPPD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Jelebu',
                'agency_code' => 'PDTJel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Jempol',
                'agency_code' => 'PDTJ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Kuala Pilah',
                'agency_code' => 'PDTKP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Rembau',
                'agency_code' => 'PDTR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Tampin',
                'agency_code' => 'PDTT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Port Dickson',
                'agency_code' => 'PDTPD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah dan Tanah Seremban',
                'agency_code' => 'PDTS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Daerah Kecil dan Tanah Gemas',
                'agency_code' => 'PDTKG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Kewangan Negeri',
                'agency_code' => 'PKN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Menteri Besar Negeri Sembilan',
                'agency_code' => 'PMBNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Pejabat Tanah dan Galian Negeri Sembilan',
                'agency_code' => 'PTGNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Perbadanan Kemajuan Negeri Sembilan',
                'agency_code' => 'PKNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Bahagian Dewan Undangan Negeri Sembilan',
                'agency_code' => 'BDUN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Unit Pengurusan Bangunan dan Aset',
                'agency_code' => 'UPBA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Unit Perancang Ekonomi Negeri',
                'agency_code' => 'UPEN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Yayasan Negeri Sembilan',
                'agency_code' => 'YNS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Badan Kawal Selia Air',
                'agency_code' => 'BKSA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Bahagian Khidmat Pengurusan',
                'agency_code' => 'BKP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Bahagian Perumahan',
                'agency_code' => 'BHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Bahagian Teknologi Maklumat',
                'agency_code' => 'BTM',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
