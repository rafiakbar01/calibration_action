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
        Schema::create('head_pressure_transmitter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->string('certificate_id');
            $table->string('standard');
            $table->string('calibrationMethod');
            $table->string('tertelusur')->nullable();
            $table->string('satuan_set_point')->nullable();
            $table->string('satuan_p_naik')->nullable();
            $table->string('satuan_p_turun')->nullable();
            $table->string('satuan_so_naik')->nullable();
            $table->string('satuan_so_turun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_pressure_transmitter');
    }
};
