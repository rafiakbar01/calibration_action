<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detail_inside_micrometers', function (Blueprint $table) {
            // Hapus bagian drop foreign key (karena tidak ada atau tidak perlu)
            
            // 1. Pastikan tipe data kolom sesuai dengan calibrations.id (biasanya unsignedBigInteger)
            $table->unsignedBigInteger('calibration_id')->change();

            // 2. Tambahkan foreign key constraint yang benar
            $table->foreign('calibration_id', 'fk_detail_inside_micrometers_calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('detail_inside_micrometers', function (Blueprint $table) {
            // Untuk rollback: hapus foreign key yang baru dibuat
            $table->dropForeign('fk_detail_inside_micrometers_calibration_id');
            
            // Opsional: kembalikan tipe data kalau perlu (tapi biasanya tidak usah)
            // $table->unsignedInteger('calibration_id')->change(); // atau sesuai tipe lama
        });
    }
};