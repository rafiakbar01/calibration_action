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
        Schema::create('detail_feeler_gauges', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data FEELER GAUGE
            $table->decimal('nominalUUT', 8, 5)->nullable();
            $table->decimal('nominalGB', 8, 5)->nullable();

            $table->decimal('GBA1', 8, 5)->nullable();
            $table->decimal('UUTB1', 8, 5)->nullable();

            $table->decimal('GBA2', 8, 5)->nullable();
            $table->decimal('UUTB2', 8, 5)->nullable();

            $table->decimal('GBA3', 8, 5)->nullable();
            $table->decimal('UUTC3', 8, 5)->nullable();

            $table->decimal('GBA4', 8, 5)->nullable();
            $table->decimal('UUTC4', 8, 5)->nullable();

              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_feeler_gauges');
    }
};
