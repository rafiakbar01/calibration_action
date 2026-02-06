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
        Schema::create('detail_torque_wrenchs', function (Blueprint $table) {
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
            $table->decimal('cw1', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('cw2', 8, 5)->nullable();
            $table->decimal('cw3', 8, 5)->nullable();
            $table->decimal('ccw1', 8, 5)->nullable();
            $table->decimal('ccw2', 8, 5)->nullable();
            $table->decimal('ccw3', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
           
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
        Schema::dropIfExists('detail_torque_wrenchs');
    }
};
