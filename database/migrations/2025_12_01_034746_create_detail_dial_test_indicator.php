<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_dial_test_indicators', function (Blueprint $table) {
            $table->id();

            // FK ke calibration_id di head_dial_indicator
            $table->foreignId('calibration_id')
                  ->constrained('head_dial_test_indicator') // pastikan nama table head benar
                  ->onDelete('cascade');

            $table->decimal('titikUkur', 8, 3)->nullable(); 
            $table->decimal('ulanganNaik', 8, 3)->nullable();
            $table->decimal('ulanganTurun', 8, 3)->nullable();
            $table->timestamps();

            // Index untuk performa
            $table->index('calibration_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_dial_test_indicators');
    }
};