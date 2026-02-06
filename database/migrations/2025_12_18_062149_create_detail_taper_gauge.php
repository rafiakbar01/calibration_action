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
        Schema::create('detail_tapergauges', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data pengukuran
            $table->decimal('titikUkur', 8, 5)->nullable();

            $table->decimal('rep01', 8, 5)->nullable();
            $table->decimal('rep02', 8, 5)->nullable();
            $table->decimal('rep03', 8, 5)->nullable();
            $table->decimal('rep04', 8, 5)->nullable();
            $table->decimal('rep05', 8, 5)->nullable();

              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tapergauges');
    }
};
