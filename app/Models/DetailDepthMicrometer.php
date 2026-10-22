<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDepthMicrometer extends Model
{
    use HasFactory;
  protected $table = 'detail_depth_micrometers';
    // protected $casts = [
    //     'titikUkur' => 'decimal:3',
    //     'ulangan01' => 'decimal:3',
    //     'ulangan02' => 'decimal:3',
    //     'ulangan03' => 'decimal:3',
    //     'ulangan04' => 'decimal:3',
    //     'ulangan05' => 'decimal:3',
    // ];

    protected $fillable = [
        'calibration_id', 
        'titikUkur',
        'ulangan01',
        'ulangan02',
        'ulangan03',
        'ulangan04',
        'ulangan05',
        'form_index'
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