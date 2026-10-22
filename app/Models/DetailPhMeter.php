<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPhMeter extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nilaiBuffer',
        'rep01',
        'rep02',
        'rep03',
        'rep04',
        'rep05',
        'Resolusi',
        'TBuffer',
    ];

    protected $casts = [
        'nilaiBuffer' => 'string',
        'rep01'  => 'string',
        'rep02'  => 'string',
        'rep03'  => 'string',
        'rep04'  => 'string',
        'rep05'  => 'string',
        'Resolusi'  => 'string',
        'TBuffer' => 'string',

    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}