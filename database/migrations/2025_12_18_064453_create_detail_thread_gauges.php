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
        Schema::create('detail_thread_gauges', function (Blueprint $table) {
            $table->id();
              
            // Relasi dengan calibration
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');
            
            // Data Pembacaan
            $table->string('sensor')->nullable();
            $table->string('kodeGO')->nullable();
            $table->string('satuan_go');
            $table->decimal('nominalGO', 8, 5)->nullable();
            $table->decimal('GOatasX1', 8, 5)->nullable();
            $table->decimal('GOatasY1', 8, 5)->nullable();        
            $table->decimal('GObawahX1', 8, 5)->nullable();
            $table->decimal('GObawahY1', 8, 5)->nullable();
            $table->string('kodeNOTGO')->nullable();
            $table->string('satuan_not_go');
            $table->decimal('nominalNOTGO', 8, 5)->nullable();
            $table->decimal('NOTGOatasX1', 8, 5)->nullable();        
            $table->decimal('NOTGOatasY1', 8, 5)->nullable();           
            $table->decimal('NOTGObawahX1', 8, 5)->nullable();       
            $table->decimal('NOTGObawahY1', 8, 5)->nullable();      
        
            $table->decimal('ukuranPitch', 8, 5)->nullable();
            $table->string('satuan_pitch')->nullable();
            $table->string('sudutUlir')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_thread_gauges');
    }
};
