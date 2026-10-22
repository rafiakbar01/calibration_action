<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAbrationTester extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominalRPM',
        'STD1',
        'STD2',
        'STD3',
        'STD4',
        'STD5',
        'resolusi',
    
        'titikUkur',
        'STDm1',
        'STDs1',
        'STDms1',
        'STDm2',
        'STDs2',
        'STDms2',
        'STDm3',
        'STDs3',
        'STDms3',
        'STDm4',
        'STDs4',
        'STDms4',
        'STDm5',
        'STDs5',
        'STDms5',
        'UUTm1',
        'UUTs1',
        'UUTms1',
        'UUTm2',
        'UUTs2',
        'UUTms2',
        'UUTm3',
        'UUTs3',
        'UUTms3',
        'UUTm4',
        'UUTs4',
        'UUTms4',
        'UUTm5',
        'UUTs5',
        'UUTms5'
    ];

  

    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}

