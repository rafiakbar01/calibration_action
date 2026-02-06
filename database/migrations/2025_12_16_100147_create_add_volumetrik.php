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
        Schema::create('add_volumetrik', function (Blueprint $table) {
            $table->id();
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
            ->constrained('calibrations')
            ->onDelete('cascade');
            
            $table->decimal('titikUkur', 8, 5)->nullable(); // Set point alat
            $table->decimal('massaKosong', 8, 5)->nullable(); // Set point alat
            $table->decimal('massaIsi', 8, 5)->nullable(); // Set point alat
            $table->decimal('T_airSuling', 8, 5)->nullable(); // Set point alat
            $table->decimal('P_Udara', 8, 5)->nullable(); // Set point alat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_volumetrik');
    }
};
