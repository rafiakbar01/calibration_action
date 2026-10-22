<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEnclosure extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

    //  protected $table = 'detail_torque_meters'; // Atau nama tabel yang benar

    protected $fillable = [
        'calibration_id',
        'repetition_number',
        'interval_number',
        'readAlat',
        'readSensor1',
        'readSensor2',
        'readSensor3',
        'readSensor4',
        'readSensor5',
        'readSensor6',
        'readSensor7',
        'readSensor8',
        'readSensor9',

    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'repetition_number' => 'integer',
        'interval_number' => 'integer',
      
        // 'readAlat' => 'decimal:5',
        // 'readSensor1' => 'decimal:5',
        // 'readSensor2' => 'decimal:5',
        // 'readSensor3' => 'decimal:5',
        // 'readSensor4' => 'decimal:5',
        // 'readSensor5' => 'decimal:5',
        // 'readSensor6'  => 'decimal:5',
        // 'readSensor7'  => 'decimal:5',
        // 'readSensor8'  => 'decimal:5',
        // 'readSensor9'  => 'decimal:5',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}