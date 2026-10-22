<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTorqueMeter extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

     protected $table = 'detail_torque_meters'; // Atau nama tabel yang benar

    protected $fillable = [
        'calibration_id',
        'titikUkurBeban',
        'kodeStandard',
        'cw1',
        'cw2',
        'cw3',
        'ccw1',
        'ccw2',
        'ccw3',
    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'titikUkurBeban' => 'decimal:5',
    //     'cw1' => 'decimal:5',
    //     'cw2' => 'decimal:5',
    //     'cw3' => 'decimal:5',
    //     'ccw1' => 'decimal:5',
    //     'ccw2' => 'decimal:5',
    //     'ccw3'  => 'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}