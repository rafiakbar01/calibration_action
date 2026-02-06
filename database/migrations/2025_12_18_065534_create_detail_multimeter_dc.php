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
        Schema::create('detail_multimeter_dcs', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pembacaan
            $table->string('titikUkur')->nullable();

            // STD1
            $table->float('STD1_1')->nullable();
            $table->float('STD1_2')->nullable();
            $table->float('STD1_3')->nullable();
            $table->float('STD1_4')->nullable();
            $table->float('STD1_5')->nullable();
            $table->float('resolusiSTD1')->nullable();

            // STD2
            $table->float('STD2_1')->nullable();
            $table->float('STD2_2')->nullable();
            $table->float('STD2_3')->nullable();
            $table->float('STD2_4')->nullable();
            $table->float('STD2_5')->nullable();
            $table->float('resolusiSTD2')->nullable();

            // STD3
            $table->float('STD3_1')->nullable();
            $table->float('STD3_2')->nullable();
            $table->float('STD3_3')->nullable();
            $table->float('STD3_4')->nullable();
            $table->float('STD3_5')->nullable();
            $table->float('resolusiSTD3')->nullable();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_multimeter_dcs');
    }
};
