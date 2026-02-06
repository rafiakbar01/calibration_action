<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPlasticShim extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'nominal',
        'sn',
        'STD01',
        'STD02',
        'STD03',
        'STD04',
        'STD05'
    ];

    protected $casts = [
        'nominal' => 'decimal:5',
        'STD01'   => 'decimal:5',
        'STD02'   => 'decimal:5',
        'STD03'   => 'decimal:5',
        'STD04'   => 'decimal:5',
        'STD05'   => 'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}