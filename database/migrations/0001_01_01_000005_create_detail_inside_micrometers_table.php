<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_inside_micrometers', function (Blueprint $table) {
            $table->id();

            // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('head_inside_micrometers')
                  ->onDelete('cascade');

            $table->decimal('titikUkur', 8, 3); 
            $table->decimal('ulangan01', 8, 3);
            $table->decimal('ulangan02', 8, 3);
            $table->decimal('ulangan03', 8, 3);
            $table->decimal('ulangan04', 8, 3);
            $table->decimal('ulangan05', 8, 3);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_inside_micrometers');
    }
};