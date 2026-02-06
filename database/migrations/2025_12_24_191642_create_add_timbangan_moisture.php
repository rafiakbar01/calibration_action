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
        Schema::create('add_timbangan_moisture', function (Blueprint $table) {
            $table->id();
              // Relasi dengan calibration
              $table->foreignId('calibration_id')
              ->constrained('calibrations')
              ->onDelete('cascade');
              
        // Half Max $table->string('HalfMax_z1_01')->nullable();
        $table->string('HalfMax_z1_01')->nullable();
        $table->string('HalfMax_z1_02')->nullable();
        $table->string('HalfMax_z1_03')->nullable();
        $table->string('HalfMax_z1_04')->nullable();
        $table->string('HalfMax_z1_05')->nullable();
        $table->string('HalfMax_z1_06')->nullable();
        $table->string('HalfMax_z1_07')->nullable();
        $table->string('HalfMax_z1_08')->nullable();
        $table->string('HalfMax_z1_09')->nullable();
        $table->string('HalfMax_z1_10')->nullable();
        $table->string('HalfMax_m1_01')->nullable();
        $table->string('HalfMax_m1_02')->nullable();
        $table->string('HalfMax_m1_03')->nullable();
        $table->string('HalfMax_m1_04')->nullable();
        $table->string('HalfMax_m1_05')->nullable();
        $table->string('HalfMax_m1_06')->nullable();
        $table->string('HalfMax_m1_07')->nullable();
        $table->string('HalfMax_m1_08')->nullable();
        $table->string('HalfMax_m1_09')->nullable();
        $table->string('HalfMax_m1_10')->nullable();
       

        // Full Max
        $table->string('FullMax_z1_01')->nullable();
        $table->string('FullMax_z1_02')->nullable();
        $table->string('FullMax_z1_03')->nullable();
        $table->string('FullMax_z1_04')->nullable();
        $table->string('FullMax_z1_05')->nullable();
        $table->string('FullMax_z1_06')->nullable();
        $table->string('FullMax_z1_07')->nullable();
        $table->string('FullMax_z1_08')->nullable();
        $table->string('FullMax_z1_09')->nullable();
        $table->string('FullMax_z1_10')->nullable();
        $table->string('FullMax_m1_01')->nullable();
        $table->string('FullMax_m1_02')->nullable();
        $table->string('FullMax_m1_03')->nullable();
        $table->string('FullMax_m1_04')->nullable();
        $table->string('FullMax_m1_05')->nullable();
        $table->string('FullMax_m1_06')->nullable();
        $table->string('FullMax_m1_07')->nullable();
        $table->string('FullMax_m1_08')->nullable();
        $table->string('FullMax_m1_09')->nullable();
        $table->string('FullMax_m1_10')->nullable();
        
        // Off Center
        $table->string('bebanOffCenter')->nullable();
        $table->string('offCenterFront')->nullable();
        $table->string('offCenterMiddle')->nullable();
        $table->string('offCenterBack')->nullable();
        $table->string('offCenterRight')->nullable();
        $table->string('offCenterLeft')->nullable();

   


        $table->timestamps();
               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_timbangan_moisture');
    }
};
