<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->string('tahun_surat');
            $table->string('namavip');
            $table->string('nipvip');
            $table->string('jbtvip');
            $table->string('nip');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('atas_dasar');
            $table->string('dalam_rangka');
            $table->date('tgl_kegiatan');
            $table->string('tempat_tgs');
            $table->string('dikeluarkan');
            $table->date('pd_tgl');
            $table->enum('anggaran',['APBN', 'APBD1', 'APBD2',
            'Globalfund', 'BOK', 'USSAID', 'Lain-lain', '-']);
            $table->string('typesurat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
