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
        Schema::create('detail_pin_gauges', function (Blueprint $table) {
            $table->id();
            // calibration_id = PK + FK ke calibrations.id
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                  
            $table->decimal('titikUkur', 8, 3); 
            $table->decimal('ulangan1', 8, 3);
            $table->decimal('ulangan2', 8, 3);
            $table->decimal('ulangan3', 8, 3);
            $table->decimal('ulangan4', 8, 3);
            $table->decimal('ulangan5', 8, 3);
            $table->decimal('ulangan6', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pin_gauges');
    }
};
