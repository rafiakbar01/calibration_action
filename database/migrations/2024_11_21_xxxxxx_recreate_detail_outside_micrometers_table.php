<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Backup data existing (jika ada)
        $existingData = [];
        if (Schema::hasTable('detail_outside_micrometers')) {
            $existingData = DB::table('detail_outside_micrometers')->get()->toArray();
        }
        
        // Hapus table lama
        Schema::dropIfExists('detail_outside_micrometers');
        
        // Buat table baru dengan struktur yang benar
        Schema::create('detail_outside_micrometers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calibration_id');
            $table->decimal('titikUkur', 10, 3)->nullable();
            $table->decimal('ulangan01', 10, 3)->nullable();
            $table->decimal('ulangan02', 10, 3)->nullable();
            $table->decimal('ulangan03', 10, 3)->nullable();
            $table->decimal('ulangan04', 10, 3)->nullable();
            $table->decimal('ulangan05', 10, 3)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('calibration_id')
                  ->references('id')
                  ->on('calibrations')
                  ->onDelete('cascade');
                  
            // Index
            $table->index('calibration_id');
        });
        
        // Restore data (jika ada dan diperlukan)
        if (!empty($existingData)) {
            foreach ($existingData as $data) {
                // Mapping data lama ke struktur baru
                DB::table('detail_outside_micrometers')->insert([
                    'calibration_id' => $data->head_outside_micrometer_id ?? $data->calibration_id ?? null,
                    'titikUkur' => $data->titikUkur,
                    'ulangan01' => $data->ulangan01,
                    'ulangan02' => $data->ulangan02,
                    'ulangan03' => $data->ulangan03,
                    'ulangan04' => $data->ulangan04,
                    'ulangan05' => $data->ulangan05,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                ]);
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('detail_outside_micrometers');
        
        // Kembalikan ke struktur lama jika diperlukan
        Schema::create('detail_outside_micrometers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('head_outside_micrometer_id');
            $table->decimal('titikUkur', 10, 3)->nullable();
            $table->decimal('ulangan01', 10, 3)->nullable();
            $table->decimal('ulangan02', 10, 3)->nullable();
            $table->decimal('ulangan03', 10, 3)->nullable();
            $table->decimal('ulangan04', 10, 3)->nullable();
            $table->decimal('ulangan05', 10, 3)->nullable();
            $table->timestamps();

            $table->foreign('head_outside_micrometer_id')
                  ->references('id')
                  ->on('head_outside_micrometers')
                  ->onDelete('cascade');
        });
    }
};