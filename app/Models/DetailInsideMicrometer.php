<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInsideMicrometer extends Model
{
    use HasFactory;

    protected $casts = [
        'titikUkur' => 'decimal:5',
        'ulangan01' => 'decimal:5',
        'ulangan02' => 'decimal:5',
        'ulangan03' => 'decimal:5',
        'ulangan04' => 'decimal:5',
        'ulangan05' => 'decimal:5',
    ];

    protected $fillable = [
        'calibration_id', 
        'titikUkur',
        'ulangan01',
        'ulangan02',
        'ulangan03',
        'ulangan04',
        'ulangan05'
    ];

    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

    // ❌ HAPUS relation ke HeadInsideMicrometer (jika tidak digunakan)
    // public function headInsideMicrometer()
    // {
    //     return $this->belongsTo(HeadInsideMicrometer::class);
    // }
}