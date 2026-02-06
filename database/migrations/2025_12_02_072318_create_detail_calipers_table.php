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
        Schema::create('detail_calipers', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel calibration
            $table->unsignedBigInteger('calibration_id');
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade'); // Jika calibration dihapus, detail juga terhapus
                  
            // Titik ukur
            $table->decimal('titikUkur', 8, 5)->nullable(); // Bisa diisi dengan posisi pengukuran
            // Ulangan pengukuran
            $table->decimal('outside01', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('outside02', 8, 5)->nullable();
            $table->decimal('outside03', 8, 5)->nullable();
            $table->decimal('outside04', 8, 5)->nullable();
            $table->decimal('outside05', 8, 5)->nullable();

            $table->decimal('inside01', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('inside02', 8, 5)->nullable();
            $table->decimal('inside03', 8, 5)->nullable();
            $table->decimal('inside04', 8, 5)->nullable();
            $table->decimal('inside05', 8, 5)->nullable();
            
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
        Schema::dropIfExists('detail_calipers');
    }
};
