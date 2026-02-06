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
        Schema::create('detail_conductivity_meters', function (Blueprint $table) {
            $table->id();
              // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('nilaiCRM', 8, 5)->nullable(); // Set point alat
              $table->decimal('rep01', 8, 5)->nullable(); // Sensor 1
              $table->decimal('rep02', 8, 5)->nullable(); // Sensor 2
              $table->decimal('rep03', 8, 5)->nullable(); // Sensor 3
              $table->decimal('rep04', 8, 5)->nullable(); // Sensor 4
              $table->decimal('rep05', 8, 5)->nullable(); // Sensor 5
              $table->decimal('Resolusi', 8, 5)->nullable(); // Sensor 5
              $table->decimal('suhuCRM', 8, 5)->nullable(); // Sensor 5

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_conductivity_meters');
    }
};
