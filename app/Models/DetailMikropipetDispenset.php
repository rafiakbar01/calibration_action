<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMikropipetDispenset extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'titikUkur' => 'decimal:5',
    //     'm0' => 'decimal:5',
    //     'm1' => 'decimal:5',
    //     'm2' => 'decimal:5',
    //     'm3' => 'decimal:5',
    //     'm4' => 'decimal:5',
    //     'm5' => 'decimal:5',
    //     'm6' => 'decimal:5',
    //     'm7' => 'decimal:5',
    //     'm8' => 'decimal:5',
    //     'm9' => 'decimal:5',
    //     'm10' => 'decimal:5',
    //     'm11' => 'decimal:5',
    //     'TUdaraS' => 'decimal:5',
    //     'TUdaraE' => 'decimal:5',
    //     'RHS' => 'decimal:5',
    //     'RHE' => 'decimal:5',
    //     'PUdaraS' => 'decimal:5',
    //     'PUdaraE' => 'decimal:5',
    //     'TAirS' => 'decimal:5',
    //     'TAirE' => 'decimal:5',
    // ];

    protected $fillable = [
        'calibration_id', 
        'titikUkur',
        'm0',
        'm1',
        'm2',
        'm3',
        'm4',
        'm5',
        'm6',
        'm7',
        'm8',
        'm9',
        'm10',
        'm11',
        'TUdaraS',
        'TUdaraE',
        'RHS',
        'RHE',
        'PUdaraS',
        'PUdaraE',
        'TAirS',
        'TAirE',
        'waktu',
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