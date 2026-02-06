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
        Schema::create('detail_thermohygrometers', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('titikUkur_T', 8, 5)->nullable(); // Set point alat
              $table->decimal('T_STD1', 8, 5)->nullable(); // Set point alat
              $table->decimal('T_STD2', 8, 5)->nullable(); // Sensor 1
              $table->decimal('T_STD3', 8, 5)->nullable(); // Sensor 2
              $table->decimal('T_IN1', 8, 5)->nullable(); // Sensor 3
              $table->decimal('T_IN2', 8, 5)->nullable(); // Sensor 4
              $table->decimal('T_IN3', 8, 5)->nullable(); // Sensor 5
              $table->decimal('T_OUT1', 8, 5)->nullable(); // Sensor 6
              $table->decimal('T_OUT2', 8, 5)->nullable(); // Sensor 7
              $table->decimal('T_OUT3', 8, 5)->nullable(); // Sensor 8
              $table->decimal('titikUkur_RH', 8, 5)->nullable(); // Sensor 9
              $table->decimal('RH_STD1', 8, 5)->nullable(); // Sensor 9
              $table->decimal('RH_STD2', 8, 5)->nullable(); // sensor 10
              $table->decimal('RH_STD3', 8, 5)->nullable(); // sensor 11
              $table->decimal('RH_ALAT1', 8, 5)->nullable(); // sensor 12
              $table->decimal('RH_ALAT2', 8, 5)->nullable(); // sensor 13
              $table->decimal('RH_ALAT3', 8, 5)->nullable(); // sensor 14


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_thermohygrometers');
    }
};
