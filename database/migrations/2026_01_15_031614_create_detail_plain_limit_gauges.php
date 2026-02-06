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
        Schema::create('detail_plain_limit_gauges', function (Blueprint $table) {
            $table->id();
              $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->decimal('titikUkurGO', 8, 3); 
            $table->decimal('posisiAtasX1', 8, 3);
            $table->decimal('posisiAtasX2', 8, 3);
            $table->decimal('posisiAtasY1', 8, 3);
            $table->decimal('posisiAtasY2', 8, 3);
            $table->decimal('posisiBawahX1', 8, 3);
            $table->decimal('posisiBawahX2', 8, 3);
            $table->decimal('posisiBawahY1', 8, 3);
            $table->decimal('posisiBawahY2', 8, 3);

            $table->decimal('titikUkurNOGO', 8, 3); 
            $table->decimal('sumbuAtasX1', 8, 3);
            $table->decimal('sumbuAtasX2', 8, 3);
            $table->decimal('sumbuAtasY1', 8, 3);
            $table->decimal('sumbuAtasY2', 8, 3);
            $table->decimal('sumbuBawahX1', 8, 3);
            $table->decimal('sumbuBawahX2', 8, 3);
            $table->decimal('sumbuBawahY1', 8, 3);
            $table->decimal('sumbuBawahY2', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_plain_limit_gauges');
    }
};
