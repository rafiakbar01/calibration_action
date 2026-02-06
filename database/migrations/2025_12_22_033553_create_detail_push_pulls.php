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
        Schema::create('detail_push_pulls', function (Blueprint $table) {
            $table->id();
             // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
              $table->string('STD')->nullable(); // Set point alat
              $table->decimal('ulanganTarik01', 8, 5)->nullable(); // Sensor 1
              $table->decimal('ulanganTarik02', 8, 5)->nullable(); // Sensor 2
              $table->decimal('ulanganTarik03', 8, 5)->nullable(); // Sensor 3
              $table->decimal('ulanganTekan01', 8, 5)->nullable(); // Sensor 4
              $table->decimal('ulanganTekan02', 8, 5)->nullable(); // Sensor 5
              $table->decimal('ulanganTekan03', 8, 5)->nullable(); // Sensor 5
        

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_push_pulls');
    }
};
