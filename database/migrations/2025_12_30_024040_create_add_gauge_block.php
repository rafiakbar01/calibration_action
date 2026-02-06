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
        Schema::create('add_gauge_block', function (Blueprint $table) {
            $table->id();
              // Relasi dengan calibration
              $table->foreignId('calibration_id')
              ->constrained('calibrations')
              ->onDelete('cascade');

            $table->decimal('titikUkurKerataan', 8, 5)->nullable();
            $table->string('Lsurface')->nullable();
            $table->string('Rsurface')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_gauge_block');
    }
};
