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
        Schema::create('add_dial_indicator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calibration_id');
            $table->string('repeatability');
            $table->decimal('ulangan01', 8, 2)->nullable();
            $table->decimal('ulangan02', 8, 2)->nullable();
            $table->decimal('ulangan03', 8, 2)->nullable();
            $table->decimal('ulangan04', 8, 2)->nullable();
            $table->decimal('ulangan05', 8, 2)->nullable();
            $table->decimal('ulangan06', 8, 2)->nullable();
            $table->decimal('ulangan07', 8, 2)->nullable();
            $table->decimal('ulangan08', 8, 2)->nullable();
            $table->decimal('ulangan09', 8, 2)->nullable();
            $table->decimal('ulangan10', 8, 2)->nullable();

           
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
                  
            // Index
            $table->index('calibration_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_dial_indicator');
    }
};