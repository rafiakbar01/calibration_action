<?php
// database/migrations/2024_01_01_000001_create_log_kalibrasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogKalibrasiTable extends Migration
{
    public function up()
    {
        Schema::create('log_kalibrasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kalibrasi_id');
            $table->string('aksi'); // BUAT, UBAH, HAPUS, LIHAT, dll
            $table->text('deskripsi')->nullable();
            $table->json('data_lama')->nullable();
            $table->json('data_baru')->nullable();
            $table->string('alamat_ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            
            $table->index('kalibrasi_id');
            $table->index('user_id');
            $table->index('aksi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_kalibrasi');
    }
}