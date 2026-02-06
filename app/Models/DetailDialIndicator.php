<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDialIndicator extends Model
{
    use HasFactory;

    protected $casts = [
        'titikUkur' => 'decimal:5',
        'ulanganNaik' => 'decimal:5',
        'ulanganTurun' => 'decimal:5',
    ];

    protected $fillable = [
        'calibration_id', 
        'titikUkur',
        'ulanganNaik',
        'ulanganTurun',
    ];

    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}