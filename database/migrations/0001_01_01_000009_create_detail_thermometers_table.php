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
        Schema::create('detail_thermometers', function (Blueprint $table) {
            $table->id();
            // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('head_thermometers')
                  ->onDelete('cascade');

            $table->string('titikUkur')->nullable(); // Titik ukur thermometer
            $table->decimal('STD01', 8, 3)->nullable(); // Standard 01 - decimal dengan 8 digit, 3 desimal
            $table->decimal('STD02', 8, 3)->nullable(); // Standard 02 - decimal dengan 8 digit, 3 desimal
            $table->decimal('STD03', 8, 3)->nullable(); // Standard 03 - decimal dengan 8 digit, 3 desimal
            $table->decimal('UUT01', 8, 3)->nullable(); // Unit Under Test 01 - decimal dengan 8 digit, 3 desimal
            $table->decimal('UUT02', 8, 3)->nullable(); // Unit Under Test 02 - decimal dengan 8 digit, 3 desimal
            $table->decimal('UUT03', 8, 3)->nullable(); // Unit Under Test 03 - decimal dengan 8 digit, 3 desimal
            $table->timestamps(); // created_at dan updated_at

          
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_thermometers');
    }
};