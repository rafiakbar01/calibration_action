<?php
// app/Models/LogKalibrasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogKalibrasi extends Model
{
    use HasFactory;

    protected $table = 'log_kalibrasi';
    
    protected $fillable = [
        'kalibrasi_id',
        'aksi',
        'deskripsi',
        'data_lama',
        'data_baru',
        'alamat_ip',
        'user_agent',
        'user_id'
    ];

    protected $casts = [
        'data_lama' => 'array',
        'data_baru' => 'array',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke data kalibrasi (jika ada tabel kalibrasi)
    // public function kalibrasi()
    // {
    //     return $this->belongsTo(Kalibrasi::class);
    // }
}