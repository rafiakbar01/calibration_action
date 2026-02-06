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
        Schema::create('detail_timbangans', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
              $table->decimal('Lm1', 8, 5)->nullable(); // Sensor 1
              $table->decimal('Lz1', 8, 5)->nullable(); // Sensor 2
              $table->decimal('Rm1', 8, 5)->nullable(); // Sensor 3
              $table->decimal('Rz1', 8, 5)->nullable(); // Sensor 4
              $table->decimal('STD', 8, 5)->nullable(); // Sensor 5

              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_timbangans');
    }
};
