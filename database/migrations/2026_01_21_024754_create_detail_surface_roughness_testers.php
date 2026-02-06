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
        Schema::create('detail_surface_roughness_testers', function (Blueprint $table) {
            $table->id();
              $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->decimal('nominalSTD', 8, 3); 
            $table->string('parameter');
            $table->decimal('ukurAlat1', 8, 3);
            $table->decimal('ukurAlat2', 8, 3);
            $table->decimal('ukurAlat3', 8, 3);
            $table->decimal('CutOff', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surface_roughness_testers');
    }
};
