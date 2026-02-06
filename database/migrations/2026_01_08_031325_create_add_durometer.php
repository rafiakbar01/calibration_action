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
        Schema::create('add_durometer', function (Blueprint $table) {
            $table->id();
             // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('rep01', 8, 5)->nullable(); // Sensor 1
              $table->decimal('rep02', 8, 5)->nullable(); // Sensor 2
              $table->decimal('rep03', 8, 5)->nullable(); // Sensor 3
              $table->decimal('rep04', 8, 5)->nullable(); // Sensor 4
              $table->decimal('rep05', 8, 5)->nullable(); // Sensor 5
              $table->decimal('rep06', 8, 5)->nullable(); // Sensor 6
              $table->decimal('rep07', 8, 5)->nullable(); // Sensor 7
              $table->decimal('rep08', 8, 5)->nullable(); // Sensor 8
              $table->decimal('rep09', 8, 5)->nullable(); // Sensor 9
              $table->decimal('rep10', 8, 5)->nullable(); // Sensor 10
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_durometer');
    }
};
