<?php

namespace Database\Seeders;

use App\Models\Vip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vips = [
            [
                "nama" => "Dani Miarso,S.KM",
                "nip" => "3260290",
                "jabatan" => "Kepala Bidang",
                "npwp" => "675858",
                "nama_bank" => "BCA",
                "no_rek" => "4728978"
                
            ]
         
            ];
            foreach ($vips as $vip){
                Vip::create($vip);
            }
    }
}
