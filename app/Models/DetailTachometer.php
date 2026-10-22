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
        'nilaiStandard' => 'string',
        'rep01'         => 'string',
        'rep02'         => 'string',
        'rep03'         => 'string',
        'rep04'         => 'string',
        'rep05'         => 'string',
        'resolusiAlat'  => 'string',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}