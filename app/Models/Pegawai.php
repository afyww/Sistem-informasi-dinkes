<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PegawaiController;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'tb_pegawai';
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'npwp',
        'nama_bank',
        'no_rek'
        
    ];
}
