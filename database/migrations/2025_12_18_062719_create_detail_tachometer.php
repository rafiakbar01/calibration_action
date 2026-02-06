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
        Schema::create('detail_tachometers', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data TACHOMETER
            $table->decimal('nilaiStandard', 10, 3)->nullable();

            $table->decimal('rep01', 10, 3)->nullable();
            $table->decimal('rep02', 10, 3)->nullable();
            $table->decimal('rep03', 10, 3)->nullable();
            $table->decimal('rep04', 10, 3)->nullable();
            $table->decimal('rep05', 10, 3)->nullable();

            $table->decimal('resolusiAlat', 10, 3)->nullable();
              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tachometers');
    }
};