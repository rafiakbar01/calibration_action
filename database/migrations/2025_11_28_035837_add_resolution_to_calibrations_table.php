<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->enum('skala', ['0.001', '0.01'])
                  ->nullable()
                  ->after('typeAlat') ;  // sesuaikan kalau kolom setelahnya beda
                  
        });
    }

    public function down(): void
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->dropColumn('skala');
        });
    }
};