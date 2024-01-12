<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surats = [
            [
                "no_surat" => "001",
                "tahun_surat" => "2024",
                "namavip" => "Dani Miarso",
                "nipvip" => "32683162",
                "jbtvip" => "Kepala Divisi",
                "nip" => "326028",
                "nama" => "Anggun",
                "jabatan" => "Pegawai",
                "atas_dasar" => "Tugas Dinas",
                "dalam_rangka" => "Wolfbachia",
                "tgl_kegiatan" => "2024-01-11",
                "tempat_tgs" => "Semarang",
                "dikeluarkan" => "Semarang",
                "pd_tgl" => "2024-01-11",
                "anggaran" => "Globalfund",
                "typesurat" => "individu",
    
            ]
         
            ];
            foreach ($surats as $surat){
                Surat::create($surat);
            }
    }
}
