<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detail_inside_micrometers', function (Blueprint $table) {
            // 1. Hapus foreign key constraint yang salah
            $table->dropForeign(['calibration_id']);
            
            // 2. Pastikan tipe data kolom sesuai dengan calibrations.id
            // Jika calibrations.id adalah bigint, sesuaikan
            $table->unsignedBigInteger('calibration_id')->change();
            
            // 3. Tambahkan foreign key constraint yang benar
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('detail_inside_micrometers', function (Blueprint $table) {
            $table->dropForeign(['calibration_id']);
            
            // Kembalikan ke foreign key lama (head_inside_micrometers)
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
        });
    }
};