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
        Schema::create('add_pressure_transmitter', function (Blueprint $table) {
            $table->id();
                // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->string('satuan_P'); 
            $table->decimal('repeatibility_P', 8, 3);
            $table->decimal('repP01', 8, 3);
            $table->decimal('repP02', 8, 3);
            $table->decimal('repP03', 8, 3);
            $table->decimal('repP04', 8, 3);
            $table->decimal('repP05', 8, 3);
            $table->decimal('repP06', 8, 3);
            $table->decimal('repP07', 8, 3);
            $table->decimal('repP08', 8, 3);
            $table->decimal('repP09', 8, 3);
            $table->decimal('repP10', 8, 3);


            
            $table->string('satuan_SO'); 
            $table->decimal('repeatibility_SO', 8, 3);
            $table->decimal('repSO01', 8, 3);
            $table->decimal('repSO02', 8, 3);
            $table->decimal('repSO03', 8, 3);
            $table->decimal('repSO04', 8, 3);
            $table->decimal('repSO05', 8, 3);
            $table->decimal('repSO06', 8, 3);
            $table->decimal('repSO07', 8, 3);
            $table->decimal('repSO08', 8, 3);
            $table->decimal('repSO09', 8, 3);
            $table->decimal('repSO10', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_pressure_transmitter');
    }
};
