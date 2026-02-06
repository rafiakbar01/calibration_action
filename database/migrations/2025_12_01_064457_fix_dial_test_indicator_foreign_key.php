<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  // database/migrations/xxxx_fix_dial_test_indicator_foreign_key.php
public function up()
{
    Schema::table('detail_dial_test_indicators', function (Blueprint $table) {
        // Hapus foreign key lama
        $table->dropForeign(['calibration_id']);
        
        // Tambah foreign key baru ke calibrations
        $table->foreign('calibration_id')
              ->references('id')
              ->on('calibrations')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('detail_dial_test_indicators', function (Blueprint $table) {
        $table->dropForeign(['calibration_id']);
        
        // Kembalikan ke head_dial_test_indicator jika perlu
        $table->foreign('calibration_id')
              ->references('id')
              ->on('head_dial_test_indicator')
              ->onDelete('cascade');
    });
}
};
