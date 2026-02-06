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
        Schema::create('add_thermoindicator', function (Blueprint $table) {
            $table->id();
             $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
                   
            $table->string('wireType')->nullable(); 
            $table->decimal('rep01', 8, 3);
            $table->decimal('rep02', 8, 3);
            $table->decimal('rep03', 8, 3);
            $table->decimal('rep04', 8, 3);
            $table->decimal('rep05', 8, 3);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_thermoindicator');
    }
};
