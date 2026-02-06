<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('head_depth_micrometers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            $table->string('certificate_id');
            $table->string('standard');
            $table->string('calibrationMethod');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('head_depth_micrometers');
    }
};