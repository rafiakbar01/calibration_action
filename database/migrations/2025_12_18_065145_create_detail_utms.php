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
        Schema::create('detail_utms', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pembacaan
            $table->string('titikUkur')->nullable();

            $table->float('readTekanSTD1')->nullable();
            $table->float('readTekanSTD2')->nullable();
            $table->float('readTekanSTD3')->nullable();
            $table->float('readTekanUUT1')->nullable();
            $table->float('readTekanUUT2')->nullable();
            $table->float('readTekanUUT3')->nullable();

            $table->float('readTarikSTD1')->nullable();
            $table->float('readTarikSTD2')->nullable();
            $table->float('readTarikSTD3')->nullable();
            $table->float('readTarikUUT1')->nullable();
            $table->float('readTarikUUT2')->nullable();
            $table->float('readTarikUUT3')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_utms');
    }
};
