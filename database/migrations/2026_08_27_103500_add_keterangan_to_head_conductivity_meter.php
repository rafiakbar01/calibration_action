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
        Schema::table('head_conductivity_meter', function (Blueprint $table) {
            if (!Schema::hasColumn('head_conductivity_meter', 'keterangan_fungsi_komponen')) {
                $table->text('keterangan_fungsi_komponen')->nullable()->after('calibrationMethod');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('head_conductivity_meter', function (Blueprint $table) {
            if (Schema::hasColumn('head_conductivity_meter', 'keterangan_fungsi_komponen')) {
                $table->dropColumn('keterangan_fungsi_komponen');
            }
        });
    }
};
