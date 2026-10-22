<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menghapus kolom speed, last_speed, dan imei dari tabel gps_tracking.
     */
    public function up(): void
    {
        Schema::table('gps_tracking', function (Blueprint $table) {
            $table->dropColumn(['speed', 'last_speed', 'imei']);
        });
    }

    /**
     * Reverse the migrations.
     * Mengembalikan kolom speed, last_speed, dan imei ke tabel gps_tracking.
     */
    public function down(): void
    {
        Schema::table('gps_tracking', function (Blueprint $table) {
            $table->float('speed')->nullable()->after('longitude');
            $table->float('last_speed')->nullable()->after('speed');
            $table->string('imei')->nullable()->after('last_speed');
        });
    }
};
