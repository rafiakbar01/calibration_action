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
        Schema::create('head_thickness_gauge', function (Blueprint $table) {
            $table->id();
            // calibration_id = PK + FK ke calibrations.id
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->string('certificate_id');
            $table->string('standard');
            $table->string('calibrationMethod');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('head_thickness_gauge');
    }
};
