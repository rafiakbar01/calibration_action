<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->string('no_po')->nullable()->after('pemilikAlat');
        });
    }

    public function down(): void
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->dropColumn('no_po');
        });
    }
};
