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
        Schema::create('detail_anak_timbangans', function (Blueprint $table) {
            $table->id();
             // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->string('nominalAlat'); 
            $table->decimal('ULSTD', 8, 3);
            $table->decimal('ULUUT', 8, 3);
            $table->decimal('LLUUT', 8, 3);
            $table->decimal('LLSTD', 8, 3);
            $table->decimal('URSTD', 8, 3);
            $table->decimal('URUUT', 8, 3);
            $table->decimal('LRUUT', 8, 3);
            $table->decimal('LRSTD', 8, 3);
            $table->string('ATSTD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_anak_timbangans');
    }
};
