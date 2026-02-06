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
        Schema::create('detail_viscocups', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pengukuran
            $table->decimal('nilaiStandar', 8, 5)->nullable();
            $table->decimal('ulangan1', 8, 5)->nullable();
            $table->decimal('ulangan2', 8, 5)->nullable();
            $table->decimal('ulangan3', 8, 5)->nullable();
            $table->decimal('ulangan4', 8, 5)->nullable();
            $table->decimal('ulangan5', 8, 5)->nullable();

            $table->decimal('suhuCRM', 8, 2)->nullable();
              
                  $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_viscocups');
    }
};
