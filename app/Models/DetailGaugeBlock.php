<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGaugeBlock extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

    //  protected $table = 'detail_torque_meters'; // Atau nama tabel yang benar

    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'NoSeri',
        'STD',
        'C1M',
        'C2M',
        'C1UL',
        'C2UL',
        'C1LL',
        'C2LL',
        'C1UR',
        'C2UR',
        'C1LR',
        'C2LR',
        'C1C',
        'C2C',

    ];

    /**
     * Casting tipe data
     */
    // protected $casts = [
    //     'titikUkur' => 'decimal:5',
    //     'NoSeri' => 'decimal:5',
    //     'STD' => 'decimal:5',
    //     'C1M' => 'decimal:5',
    //     'C2M' => 'decimal:5',
    //     'C1UL' => 'decimal:5',
    //     'C2UL' => 'decimal:5',
    //     'C1LL' => 'decimal:5',
    //     'C2LL' => 'decimal:5',
    //     'C1UR' => 'decimal:5',
    //     'C2UR' => 'decimal:5',
    //     'C1LR' => 'decimal:5',
    //     'C2LR' => 'decimal:5',
    //     'C1C' => 'decimal:5',
    //     'C2C' => 'decimal:5',
    // ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}