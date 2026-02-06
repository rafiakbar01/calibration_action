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
        Schema::create('head_profil_projector', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->string('certificate_id');
            $table->string('standard');
            $table->string('calibrationMethod');
            $table->string('satuan_titik_ukur')->nullable();
            $table->string('satuan_alat_x')->nullable();
            $table->string('satuan_alat_y')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_profil_projector');
    }
};
