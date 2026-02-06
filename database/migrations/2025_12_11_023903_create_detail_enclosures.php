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
        Schema::create('detail_enclosures', function (Blueprint $table) {
            $table->id();
            
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
            $table->decimal('readAlat', 8, 5)->nullable(); // Set point alat
            $table->decimal('readSensor1', 8, 5)->nullable(); // Sensor 1
            $table->decimal('readSensor2', 8, 5)->nullable(); // Sensor 2
            $table->decimal('readSensor3', 8, 5)->nullable(); // Sensor 3
            $table->decimal('readSensor4', 8, 5)->nullable(); // Sensor 4
            $table->decimal('readSensor5', 8, 5)->nullable(); // Sensor 5
            $table->decimal('readSensor6', 8, 5)->nullable(); // Sensor 6
            $table->decimal('readSensor7', 8, 5)->nullable(); // Sensor 7
            $table->decimal('readSensor8', 8, 5)->nullable(); // Sensor 8
            $table->decimal('readSensor9', 8, 5)->nullable(); // Sensor 9
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_enclosures');
    }
};