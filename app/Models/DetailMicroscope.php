<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMicroscope extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominal',
        'sn','calibration_id',
        'titikUkur',
        'X1','X2','X3','X4','X5',
        'Y1','Y2','Y3','Y4','Y5'
    ];

    protected $casts = [
        'titikUkur' => 'decimal:5',
        'X1' => 'decimal:5',
        'X2' => 'decimal:5',
        'X3' => 'decimal:5',
        'X4' => 'decimal:5',
        'X5' => 'decimal:5',
        'Y1' => 'decimal:5',
        'Y2' => 'decimal:5',
        'Y3' => 'decimal:5',
        'Y4' => 'decimal:5',
        'Y5' => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}