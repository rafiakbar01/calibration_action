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
        Schema::create('detail_stopwatchs', function (Blueprint $table) {
            $table->id();
              // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->string('titikUkur'); 
            $table->decimal('STDm1', 8, 3);
            $table->decimal('STDs1', 8, 3);
            $table->decimal('STDms1', 8, 3);
            $table->decimal('STDm2', 8, 3);
            $table->decimal('STDs2', 8, 3);
            $table->decimal('STDms2', 8, 3);
            $table->decimal('STDm3', 8, 3);
            $table->decimal('STDs3', 8, 3);
            $table->decimal('STDms3', 8, 3);
            $table->decimal('STDm4', 8, 3);
            $table->decimal('STDs4', 8, 3);
            $table->decimal('STDms4', 8, 3);
            $table->decimal('STDm5', 8, 3);
            $table->decimal('STDs5', 8, 3);
            $table->decimal('STDms5', 8, 3);
            $table->decimal('UUTm1', 8, 3);
            $table->decimal('UUTs1', 8, 3);
            $table->decimal('UUTms1', 8, 3);
            $table->decimal('UUTm2', 8, 3);
            $table->decimal('UUTs2', 8, 3);
            $table->decimal('UUTms2', 8, 3);
            $table->decimal('UUTm3', 8, 3);
            $table->decimal('UUTs3', 8, 3);
            $table->decimal('UUTms3', 8, 3);
            $table->decimal('UUTm4', 8, 3);
            $table->decimal('UUTs4', 8, 3);
            $table->decimal('UUTms4', 8, 3);
            $table->decimal('UUTm5', 8, 3);
            $table->decimal('UUTs5', 8, 3);
            $table->decimal('UUTms5', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_stopwatchs');
    }
};
