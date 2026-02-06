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
        Schema::create('detail_chambers', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
            $table->decimal('readAlat', 8, 5)->nullable(); // Set point alat
            $table->decimal('RHAlat', 8, 5)->nullable(); // Set point alat
            $table->decimal('ulangan01', 8, 5)->nullable(); // Sensor 1
            $table->decimal('ulangan02', 8, 5)->nullable(); // Sensor 2
            $table->decimal('ulangan03', 8, 5)->nullable(); // Sensor 3
            $table->decimal('ulangan04', 8, 5)->nullable(); // Sensor 4
            $table->decimal('ulangan05', 8, 5)->nullable(); // Sensor 5
            $table->decimal('ulangan06', 8, 5)->nullable(); // Sensor 6
            $table->decimal('ulangan07', 8, 5)->nullable(); // Sensor 7
            $table->decimal('ulangan08', 8, 5)->nullable(); // Sensor 8
            $table->decimal('ulangan09', 8, 5)->nullable(); // Sensor 9
            $table->decimal('RHulangan', 8, 5)->nullable(); // Sensor 9
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_chambers');
    }
};
