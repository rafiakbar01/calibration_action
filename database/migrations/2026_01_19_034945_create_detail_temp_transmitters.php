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
        Schema::create('detail_temp_transmitters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->decimal('T_setting', 8, 3); 
            $table->decimal('T_STD1', 8, 3);
            $table->decimal('T_STD2', 8, 3);
            $table->decimal('T_STD3', 8, 3);
            $table->decimal('T_Indicator1', 8, 3);
            $table->decimal('T_Indicator2', 8, 3);
            $table->decimal('T_Indicator3', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_temp_transmitters');
    }
};
