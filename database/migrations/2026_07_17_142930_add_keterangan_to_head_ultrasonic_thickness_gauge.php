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
        Schema::table('head_ultrasonic_thickness_gauge', function (Blueprint $table) {
            $table->text('keterangan_fungsi_komponen')->nullable()->after('standard');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('head_ultrasonic_thickness_gauge', function (Blueprint $table) {
            $table->dropColumn('keterangan_fungsi_komponen');
        });
    }
};
