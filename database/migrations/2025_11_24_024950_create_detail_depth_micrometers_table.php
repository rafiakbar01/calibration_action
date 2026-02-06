<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_depth_micrometers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            $table->decimal('titikUkur', 8, 3); 
            $table->decimal('ulangan01', 8, 3)->nullable();
            $table->decimal('ulangan02', 8, 3)->nullable();
            $table->decimal('ulangan03', 8, 3)->nullable();
            $table->decimal('ulangan04', 8, 3)->nullable();
            $table->decimal('ulangan05', 8, 3)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_depth_micrometers');
    }
};