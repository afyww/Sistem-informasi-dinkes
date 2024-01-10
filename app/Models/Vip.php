<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    use HasFactory;

    protected $table = 'vips';
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'npwp',
        'nama_bank',
        'no_rek'
        
    ];
}
