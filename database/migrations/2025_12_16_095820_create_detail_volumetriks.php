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
        Schema::create('detail_volumetriks', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
              // Data pembacaan
              $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
              $table->decimal('masssaKosong01', 8, 5)->nullable(); // Set point alat
              $table->decimal('masssaKosong02', 8, 5)->nullable(); // Sensor 1
              $table->decimal('masssaKosong03', 8, 5)->nullable(); // Sensor 2
              $table->decimal('massaIsi01', 8, 5)->nullable(); // Sensor 3
              $table->decimal('massaIsi02', 8, 5)->nullable(); // Sensor 4
              $table->decimal('massaIsi03', 8, 5)->nullable(); // Sensor 5
              $table->decimal('T_airSuling01', 8, 5)->nullable(); // Sensor 9
              $table->decimal('T_airSuling02', 8, 5)->nullable(); // sensor 10
              $table->decimal('T_airSuling03', 8, 5)->nullable(); // sensor 11
              $table->decimal('P_Udara01', 8, 5)->nullable(); // sensor 12
              $table->decimal('P_Udara02', 8, 5)->nullable(); // sensor 13
              $table->decimal('P_Udara03', 8, 5)->nullable(); // sensor 14


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_volumetriks');
    }
};
