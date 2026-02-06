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
        Schema::create('detail_rh_temp_humid_transmitters', function (Blueprint $table) {
            $table->id();
             $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->decimal('RH_setting', 8, 3); 
            $table->decimal('RH_STD1', 8, 3);
            $table->decimal('RH_STD2', 8, 3);
            $table->decimal('RH_STD3', 8, 3);
            $table->decimal('RH_OSmA1', 8, 3);
            $table->decimal('RH_OSmA2', 8, 3);
            $table->decimal('RH_OSmA3', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_rh_temp_humid_transmitters');
    }
};
