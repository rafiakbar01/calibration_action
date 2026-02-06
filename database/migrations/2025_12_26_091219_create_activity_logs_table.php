<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relationship - untuk relasi ke model apapun
            $table->string('logable_type'); // Contoh: App\Models\Document
            $table->unsignedBigInteger('logable_id'); // ID dari model terkait
            
            // Informasi Aktivitas
            $table->string('activity_type', 50); // create, update, delete, verify, approve, etc
            $table->text('description')->nullable(); // Deskripsi aktivitas
            
            // Data perubahan (untuk update)
            $table->json('old_data')->nullable(); // Data sebelum perubahan
            $table->json('new_data')->nullable(); // Data setelah perubahan
            $table->json('changed_fields')->nullable(); // Field yang berubah
            
            // User yang melakukan
            $table->foreignId('performed_by')->constrained('users')->onDelete('restrict');
            
            // Informasi request
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('method', 10)->nullable(); // GET, POST, PUT, DELETE
            $table->string('url', 500)->nullable(); // URL endpoint
            
            // Metadata tambahan
            $table->json('metadata')->nullable();
            
            // Batch ID untuk tracking aktivitas dalam satu session/request
            $table->uuid('batch_uuid')->nullable();
            
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['logable_type', 'logable_id']);
            $table->index('activity_type');
            $table->index('performed_by');
            $table->index('created_at');
            $table->index('batch_uuid');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }
};