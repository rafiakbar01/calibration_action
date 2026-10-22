<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOutsideMicrometer extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'titikUkur' => 'string',
    //     'ulangan01' => 'string',
    //     'ulangan02' => 'string',
    //     'ulangan03' => 'string',
    //     'ulangan04' => 'string',
    //     'ulangan05' => 'string',
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
}