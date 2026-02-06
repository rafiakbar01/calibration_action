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
        Schema::create('add_calipers', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel calibration
            $table->unsignedBigInteger('calibration_id');
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade'); // Jika calibration dihapus, detail juga terhapus
                  
            // Titik ukur
            $table->decimal('titikUkurKesajajaran', 8, 5)->nullable(); // Bisa diisi dengan posisi pengukuran
            // Ulangan pengukuran
            $table->decimal('kesejajaranAwal', 8, 5)->nullable(); // 8 digit total, 4 digit desimal
            $table->decimal('kesejajaranTengah', 8, 5)->nullable();
            $table->decimal('kesejajaranAkhir', 8, 5)->nullable();
            $table->decimal('pengukuranDalamPisauBersilang', 8, 5)->nullable();
            $table->decimal('pembacaan1', 8, 5)->nullable();
            $table->decimal('pembacaan2', 8, 5)->nullable();
            $table->decimal('pembacaan3', 8, 5)->nullable();

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
        Schema::dropIfExists('add_caliper');
    }
};
