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
        Schema::create('detail_profil_projectors', function (Blueprint $table) {
            $table->id();
              $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->decimal('titikUkur', 8, 3); 
            $table->decimal('X1', 8, 3);
            $table->decimal('X2', 8, 3);
            $table->decimal('X3', 8, 3);
            $table->decimal('X4', 8, 3);
            $table->decimal('X5', 8, 3);
            $table->decimal('Y1', 8, 3);
            $table->decimal('Y2', 8, 3);
            $table->decimal('Y3', 8, 3);
            $table->decimal('Y4', 8, 3);
            $table->decimal('Y5', 8, 3);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_profil_projectors');
    }
};
