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
        Schema::create('detail_plastic_shims', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pembacaan
            $table->decimal('nominal', 8, 5)->nullable();
            $table->string('sn')->nullable();
            $table->decimal('STD01', 8, 5)->nullable();
            $table->decimal('STD02', 8, 5)->nullable();
            $table->decimal('STD03', 8, 5)->nullable();
            $table->decimal('STD04', 8, 5)->nullable();
            $table->decimal('STD05', 8, 5)->nullable();
              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_plastic_shims');
    }
};
