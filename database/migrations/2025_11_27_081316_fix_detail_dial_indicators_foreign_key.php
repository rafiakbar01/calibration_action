<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_dial_indicators', function (Blueprint $table) {
            // Hapus bagian drop foreign key (karena tidak perlu atau bikin error)

            // Tambahkan foreign key constraint yang benar (dengan nama custom biar aman)
            $table->foreign('calibration_id', 'fk_detail_dial_indicators_calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('detail_dial_indicators', function (Blueprint $table) {
            // Untuk rollback: hapus foreign key yang baru dibuat
            $table->dropForeign('fk_detail_dial_indicators_calibration_id');

            // Opsional: kalau mau revert ke foreign key lama (head_dial_indicator)
            // $table->foreign('calibration_id')
            //       ->references('id')
            //       ->on('head_dial_indicator')
            //       ->onDelete('cascade');
        });
    }
};