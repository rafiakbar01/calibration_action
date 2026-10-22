<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detail_dial_test_indicators', function (Blueprint $table) {
            // Tidak perlu drop di sini (asumsi foreign key lama sudah tidak ada atau akan di-drop manual)

            // Tambah foreign key baru ke calibrations dengan nama custom
            $table->foreign('calibration_id', 'fk_detail_dial_test_indicators_calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('detail_dial_test_indicators', function (Blueprint $table) {
            // Untuk rollback: cukup hapus foreign key yang baru dibuat (pakai nama custom)
            $table->dropForeign('fk_detail_dial_test_indicators_calibration_id');

            // Opsional: kalau mau revert ke foreign key lama (head_dial_test_indicator)
            // Uncomment kalau perlu
            // $table->foreign('calibration_id')
            //       ->references('id')
            //       ->on('head_dial_test_indicator')
            //       ->onDelete('cascade');
        });
    }
};