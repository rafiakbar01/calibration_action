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
            if (!Schema::hasColumn('head_conductivity_meter', 'kapasitas')) {
                $table->string('kapasitas')->nullable()->after('form_index');
            }
            if (!Schema::hasColumn('head_conductivity_meter', 'resolusi')) {
                $table->string('resolusi')->nullable()->after('kapasitas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('head_conductivity_meter', function (Blueprint $table) {
            if (Schema::hasColumn('head_conductivity_meter', 'kapasitas')) {
                $table->dropColumn('kapasitas');
            }
            if (Schema::hasColumn('head_conductivity_meter', 'resolusi')) {
                $table->dropColumn('resolusi');
            }
        });
    }
};
