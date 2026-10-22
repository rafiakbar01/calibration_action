<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calibrations', function (Blueprint $table) {
            $table->id();
            $table->string('NIK');
            $table->string('namaAlat');
            $table->string('LK');
            $table->string('brandAlat');
            $table->string('kodeAlat');
            $table->string('typeAlat');
            $table->string('NoSeri');
            $table->string('kapasitas');
            $table->string('resolusi');
            $table->string('rangeMin');
            $table->string('rangeMax');
            $table->string('pemilikAlat');
            $table->date('tanggalMasuk');
            $table->date('tanggalKalibrasi');
            $table->string('tempatKalibrasi');
            $table->string('lokasiPT');
            $table->string('jenisPembacaan');
            $table->string('lokasiAlat')->nullable();
            $table->decimal('RT_condition1', 5, 2);
            $table->decimal('RT_condition2', 5, 2);
            $table->decimal('RT_condition3', 5, 2);
            $table->decimal('RH_condition1', 5, 2); 
            $table->decimal('RH_condition2', 5, 2);
            $table->decimal('RH_condition3', 5, 2);
            $table->string('kondisiAlat');
            $table->text('keterangan')->nullable();
            $table->string('calibratedBy');
            $table->date('calibrated')->nullable();
            $table->string('verifiedBy')->nullable();
            $table->date('verified')->nullable();
            $table->string('approvedBy')->nullable();
            $table->date('approved')->nullable();
            $table->string('type');
            $table->string('location_data')->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calibrations');
    }
};