<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom keterangan_gambar ke tabel head_enclosure
     * untuk menyimpan path gambar canvas penempatan sensor.
     */
    public function up(): void
    {
        Schema::table('head_enclosure', function (Blueprint $table) {
            $table->string('keterangan_gambar', 500)->nullable()->after('calibrationMethod')
                  ->comment('Path file gambar canvas penempatan sensor (disimpan di public/img_Enclosure/)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('head_enclosure', function (Blueprint $table) {
            $table->dropColumn('keterangan_gambar');
        });
    }
};
