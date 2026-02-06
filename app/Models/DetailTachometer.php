<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTachometer extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nilaiStandard',
        'rep01',
        'rep02',
        'rep03',
        'rep04',
        'rep05',
        'resolusiAlat'
    ];

    protected $casts = [
        'nilaiStandard' => 'decimal:5',
        'rep01'         => 'decimal:5',
        'rep02'         => 'decimal:5',
        'rep03'         => 'decimal:5',
        'rep04'         => 'decimal:5',
        'rep05'         => 'decimal:5',
        'resolusiAlat'  => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}