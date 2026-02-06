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
        Schema::create('detail_ir_thermometers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->decimal('titikUkur', 8, 3); 
            $table->decimal('STD01', 8, 3);
            $table->decimal('STD02', 8, 3);
            $table->decimal('STD03', 8, 3);
            $table->decimal('UUT01', 8, 3);
            $table->decimal('UUT02', 8, 3);
            $table->decimal('UUT03', 8, 3);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ir_thermometers');
    }
};
