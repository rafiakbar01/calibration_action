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
        Schema::create('add_outside_micrometers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calibration_id');
            $table->decimal('ukuranAnvil1', 8, 2)->nullable();
            $table->integer('jumlahAnvil1')->nullable();
            $table->decimal('ukuranAnvil2', 8, 2)->nullable();
            $table->integer('jumlahAnvil2')->nullable();
            $table->decimal('ukuranSpindle1', 8, 2)->nullable();
            $table->integer('jumlahSpindle1')->nullable();
            $table->decimal('ukuranSpindle2', 8, 2)->nullable();
            $table->integer('jumlahSpindle2')->nullable();
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
        Schema::dropIfExists('add_outside_micrometers');
    }
};