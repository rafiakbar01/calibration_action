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
        Schema::create('detail_depth_calipers', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel calibration
            $table->unsignedBigInteger('calibration_id');
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade'); // Jika calibration dihapus, detail juga terhapus
                  
            // Titik ukur
            $table->decimal('titikUkur', 8, 5)->nullable(); // Bisa diisi dengan posisi pengukuran
            
            // Ulangan pengukuran
            $table->decimal('ulangan01', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('ulangan02', 8, 5)->nullable();
            $table->decimal('ulangan03', 8, 5)->nullable();
            $table->decimal('ulangan04', 8, 5)->nullable();
            $table->decimal('ulangan05', 8, 5)->nullable();
            
            // Kode standard
            $table->string('kodeStandardKiri')->nullable(); // Kode alat standard kiri
            $table->string('kodeStandardKanan')->nullable(); // Kode alat standard kanan
            
            $table->timestamps();
            
            // Index untuk performa query
            $table->index('calibration_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_depth_caliper');
    }
};