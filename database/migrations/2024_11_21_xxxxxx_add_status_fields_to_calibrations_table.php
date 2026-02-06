<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('calibrations', function (Blueprint $table) {
            // Kolom status utama dengan workflow baru
            $table->enum('status', [
                'draft',                   // Draft / dalam proses input
                'waiting_verification',    // Menunggu verifikasi
                'waiting_approval',        // Menunggu persetujuan
                'verified',                // Sudah diverifikasi
                'approved',                // Sudah disetujui
                'rejected',                // Ditolak
                'completed'                // Selesai
            ])->default('waiting_verification')->after('keterangan');
            
            // Kolom untuk tracking transaksi status
            $table->json('status_transaction')->nullable()->after('status')
                  ->comment('JSON berisi history status changes');
            
            // Tambahkan index untuk performance
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::table('calibrations', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn('status');
            $table->dropColumn('status_transaction');
        });
    }
};