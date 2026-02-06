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
        Schema::create('detail_pressure_transmitters', function (Blueprint $table) {
            $table->id();
              // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->decimal('setPoint', 8, 3);
            $table->decimal('readP_UP', 8, 3);
            $table->decimal('readS_UP', 8, 3);
            $table->decimal('readP_DOWN', 8, 3);
            $table->decimal('readS_DOWN', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pressure_transmitters');
    }
};
