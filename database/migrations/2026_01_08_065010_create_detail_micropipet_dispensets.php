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
        Schema::create('detail_mikropipet_dispensets', function (Blueprint $table) {
            $table->id();
              // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
              $table->decimal('m0', 8, 5)->nullable(); // Sensor 1
              $table->decimal('m1', 8, 5)->nullable(); // Sensor 2
              $table->decimal('m2', 8, 5)->nullable(); // Sensor 3
              $table->decimal('m3', 8, 5)->nullable(); // Sensor 4
              $table->decimal('m4', 8, 5)->nullable(); // Sensor 5
              $table->decimal('m5', 8, 5)->nullable(); // Sensor 6
              $table->decimal('m6', 8, 5)->nullable(); // Sensor 7
              $table->decimal('m7', 8, 5)->nullable(); // Sensor 8
              $table->decimal('m8', 8, 5)->nullable(); // Sensor 9
              $table->decimal('m9', 8, 5)->nullable(); // Sensor 10
              $table->decimal('m10', 8, 5)->nullable(); // Sensor 11
              $table->decimal('m11', 8, 5)->nullable(); // Sensor 12
              $table->decimal('TUdaraS', 8, 5)->nullable(); // Sensor 13
              $table->decimal('TUdaraE', 8, 5)->nullable(); // Sensor 14
              $table->decimal('RHS', 8, 5)->nullable(); // Sensor 3
              $table->decimal('RHE', 8, 5)->nullable(); // Sensor 3
              $table->decimal('PUdaraS', 8, 5)->nullable(); // Sensor 3
              $table->decimal('PUdaraE', 8, 5)->nullable(); // Sensor 3
              $table->decimal('TAirS', 8, 5)->nullable(); // Sensor 3
              $table->decimal('TAirE', 8, 5)->nullable(); // Sensor 3
              $table->decimal('waktu', 8, 5)->nullable(); // Sensor 3
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_mikropipet_dispensets');
    }
};
    