<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = [
            [
                "nama" => "Anggun",
                "nip" => "Anggun@gmail.com",
                "jabatan" => "Kepala",
                "npwp" => "326021",
                "nama_bank" => "BCA",
                "no_rek" => "4676537",
    
            ]
          
            ];
            foreach ($pegawais as $pegawai){
                Pegawai::create($pegawai);
            }
    }
}
