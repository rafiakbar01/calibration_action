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
        Schema::create('detail_pressure_gauges', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
            $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
            $table->decimal('STDNaik', 8, 5)->nullable(); // Set point alat
            $table->decimal('STDTurun', 8, 5)->nullable(); // Sensor 1
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pressure_gauges');
    }
};
