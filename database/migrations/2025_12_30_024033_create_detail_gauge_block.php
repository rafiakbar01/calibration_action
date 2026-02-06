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
        Schema::create('detail_gauge_blocks', function (Blueprint $table) {
            $table->id();
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
              $table->decimal('NoSeri', 8, 5)->nullable(); // Sensor 1
              $table->decimal('STD', 8, 5)->nullable(); // Sensor 2
              $table->decimal('C1M', 8, 5)->nullable(); // Sensor 3
              $table->decimal('C2M', 8, 5)->nullable(); // Sensor 4
              $table->decimal('C1UL', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C2UL', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C1LL', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C2LL', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C1UR', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C2UR', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C1LR', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C2LR', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C1C', 8, 5)->nullable(); // Sensor 5
              $table->decimal('C2C', 8, 5)->nullable(); // Sensor 5

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_gauge_blocks');
    }
};
