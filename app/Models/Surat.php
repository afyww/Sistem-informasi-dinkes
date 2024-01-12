<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surats';

    protected $fillable = [
        'id',
        'no_surat',
        'tahun_surat',
        'namavip',
        'nipvip',
        'jbtvip',
        'nip',
        'jabatan',
        'nama',
        'atas_dasar',
        'dalam_rangka',
        'tgl_kegiatan',
        'tempat_tgs',
        'dikeluarkan',
        'pd_tgl',
        'anggaran',
        'typesurat'
    ];
    
    use HasFactory;
}
