<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBoreGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'penunjukAlat',
        'std_naik',
        'std_turun',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'penunjukAlat' => 'string',
        'std_naik' => 'string',
        'std_turun' => 'string',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}