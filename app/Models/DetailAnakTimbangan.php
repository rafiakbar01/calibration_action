<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnakTimbangan extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominalAlat',
        'ULSTD',
        'ULUUT',
        'LLUUT',
        'LLSTD',
        'URSTD',
        'URUUT',
        'LRUUT',
        'LRSTD',
        'ATSTD',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'ULSTD' => 'decimal:5',
        'ULUUT' => 'decimal:5',
        'LLUUT' => 'decimal:5',
        'LLSTD' => 'decimal:5',
        'URSTD' => 'decimal:5',
        'URUUT' => 'decimal:5',
        'LRUUT' => 'decimal:5',
        'LRSTD' => 'decimal:5',
        'ATSTD' => 'string',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}