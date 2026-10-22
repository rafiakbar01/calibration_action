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
        Schema::create('schedule_calibrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compass_inlab_id')->unique()->comment('ID dari tabel inlab_calibrations di compass');
            $table->enum('calibration_type', ['inlab', 'onsite'])->default('inlab');
            $table->string('status', 50)->index();

            // Tanggal
            $table->dateTime('calibration_at')->nullable()->index();
            $table->dateTime('calibrated_at')->nullable();
            $table->dateTime('registered_at')->nullable();
            $table->dateTime('pickup_at')->nullable();

            // Info sertifikat / worksheet
            $table->string('certificate_no')->nullable();
            $table->string('worksheet_no')->nullable();

            // Info Customer
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_phone', 50)->nullable();
            $table->string('customer_code', 50)->nullable();
            $table->string('area_name', 100)->nullable();

            // Info Sales Order
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->string('sales_order_no')->nullable();
            $table->date('sales_order_date')->nullable();

            // Info Alat / Item
            $table->unsignedBigInteger('sales_order_item_id')->nullable();
            $table->string('instrument_name')->nullable();
            $table->text('instrument_description')->nullable();
            $table->string('instrument_unit', 50)->nullable();

            // Info Teknisi & Marketing
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->string('technician_name')->nullable();
            $table->string('technician_phone', 50)->nullable();
            $table->string('marketing_name')->nullable();

            $table->dateTime('synced_at')->nullable()->comment('Waktu terakhir sync dari Compass');
            $table->timestamps();

            $table->index(['status', 'calibration_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_calibrations');
    }
};
