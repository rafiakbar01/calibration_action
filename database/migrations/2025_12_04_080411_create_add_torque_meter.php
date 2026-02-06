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
        Schema::create('add_torque_meter', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel calibration
            $table->unsignedBigInteger('calibration_id');
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade'); // Jika calibration dihapus, detail juga terhapus
                  
            // Titik ukur
            $table->decimal('repCw01', 8, 5)->nullable(); // Bisa diisi dengan posisi pengukuran
            $table->decimal('repCw02', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('repCw03', 8, 5)->nullable();
            $table->decimal('repCw04', 8, 5)->nullable();
            $table->decimal('repCw05', 8, 5)->nullable();
            $table->decimal('repCw06', 8, 5)->nullable();
            $table->decimal('repCw07', 8, 5)->nullable();
            $table->decimal('repCw08', 8, 5)->nullable();
            $table->decimal('repCw09', 8, 5)->nullable();
            $table->decimal('repCw10', 8, 5)->nullable();

            $table->decimal('repCcw01', 8, 5)->nullable(); // Bisa diisi dengan posisi pengukuran
            $table->decimal('repCcw02', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('repCcw03', 8, 5)->nullable();
            $table->decimal('repCcw04', 8, 5)->nullable();
            $table->decimal('repCcw05', 8, 5)->nullable();
            $table->decimal('repCcw06', 8, 5)->nullable();
            $table->decimal('repCcw07', 8, 5)->nullable();
            $table->decimal('repCcw08', 8, 5)->nullable();
            $table->decimal('repCcw09', 8, 5)->nullable();
            $table->decimal('repCcw10', 8, 5)->nullable();

            $table->string('radiusAlatBantuSTD')->nullable();
            $table->string('kodeAlatBantuSTD')->nullable();



            $table->timestamps();
            
            // Index untuk performa query
            $table->index('calibration_id');
        });
    }

    /**
     * Reverse the migrations.  
     */
    public function down(): void
    {
        Schema::dropIfExists('add_torque_meter');
    }
};
