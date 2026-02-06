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
        Schema::create('detail_microscopes', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pembacaan
            $table->string('titikUkur');
            $table->float('X1')->nullable();
            $table->float('X2')->nullable();
            $table->float('X3')->nullable();
            $table->float('X4')->nullable();
            $table->float('X5')->nullable();
            $table->float('Y1')->nullable();
            $table->float('Y2')->nullable();
            $table->float('Y3')->nullable();
            $table->float('Y4')->nullable();
            $table->float('Y5')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_microscopes');
    }
};
