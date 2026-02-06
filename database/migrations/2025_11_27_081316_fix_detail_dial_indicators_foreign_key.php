<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus foreign key constraint yang salah
        Schema::table('detail_dial_indicators', function (Blueprint $table) {
            $table->dropForeign(['calibration_id']);
        });

        // Tambahkan foreign key constraint yang benar
        Schema::table('detail_dial_indicators', function (Blueprint $table) {
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('detail_dial_indicators', function (Blueprint $table) {
            $table->dropForeign(['calibration_id']);
        });

        // Kembalikan ke yang salah (untuk rollback)
        Schema::table('detail_dial_indicators', function (Blueprint $table) {
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('head_dial_indicator')
                  ->onDelete('cascade');
        });
    }
};