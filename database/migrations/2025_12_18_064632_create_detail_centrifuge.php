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
        Schema::create('detail_centrifuges', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pembacaan
            $table->decimal('nominalRPM', 8, 3)->nullable();
            $table->decimal('STD1', 8, 3)->nullable();
            $table->decimal('STD2', 8, 3)->nullable();
            $table->decimal('STD3', 8, 3)->nullable();
            $table->decimal('STD4', 8, 3)->nullable();
            $table->decimal('STD5', 8, 3)->nullable();
            $table->decimal('resolusi', 8, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_centrifuges');
    }
};
