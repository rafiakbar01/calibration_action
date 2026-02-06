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
        Schema::create('add_push_pull', function (Blueprint $table) {
            $table->id();
             // Relasi dengan calibration
              $table->foreignId('calibration_id')
              ->constrained('calibrations')
              ->onDelete('cascade');

                $table->decimal('repeatabilityTarik01', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik02', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik03', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik04', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik05', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik06', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik07', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik08', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik09', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTarik10', 8, 5)->nullable(); // Set point alat

                $table->decimal('repeatabilityTekan01', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan02', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan03', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan04', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan05', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan06', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan07', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan08', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan09', 8, 5)->nullable(); // Set point alat
                $table->decimal('repeatabilityTekan10', 8, 5)->nullable(); // Set point alat

              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_push_pull');
    }
};
