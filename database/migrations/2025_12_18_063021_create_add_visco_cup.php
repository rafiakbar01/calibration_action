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
        Schema::create('add_viscocup', function (Blueprint $table) {
            $table->id();
              // Relasi dengan calibration
              $table->foreignId('calibration_id')
              ->constrained('calibrations')
              ->onDelete('cascade');
              
              
              $table->string('type')->nullable();
              $table->string('kodeNomor')->nullable();

              $table->timestamps();

              
               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_viscocup');
    }
};
