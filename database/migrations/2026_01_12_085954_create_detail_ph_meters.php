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
        Schema::create('detail_ph_meters', function (Blueprint $table) {
            $table->id();
            // calibration_id = PK + FK ke calibrations.id
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                  
            $table->decimal('nilaiBuffer', 8, 3); 
            $table->decimal('rep01', 8, 3);
            $table->decimal('rep02', 8, 3);
            $table->decimal('rep03', 8, 3);
            $table->decimal('rep04', 8, 3);
            $table->decimal('rep05', 8, 3);
            $table->decimal('Resolusi', 8, 3);
            $table->decimal('Tbuffer', 8, 3);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ph_meters');
    }
};
