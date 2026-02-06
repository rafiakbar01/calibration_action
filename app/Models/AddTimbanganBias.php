<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddTimbanganBias extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
  
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',

        // Setengah Kapasitas Maksimal - MI (1-10)
        'HalfMax_m1_01','HalfMax_m1_02','HalfMax_m1_03','HalfMax_m1_04','HalfMax_m1_05',
        'HalfMax_m1_06','HalfMax_m1_07','HalfMax_m1_08','HalfMax_m1_09','HalfMax_m1_10',

        // Setengah Kapasitas Maksimal - ZI (1-10)
        'HalfMax_z1_01','HalfMax_z1_02','HalfMax_z1_03','HalfMax_z1_04','HalfMax_z1_05',
        'HalfMax_z1_06','HalfMax_z1_07','HalfMax_z1_08','HalfMax_z1_09','HalfMax_z1_10',

        // Kapasitas Maksimal - ZI (1-10)
        'FullMax_z1_01','FullMax_z1_02','FullMax_z1_03','FullMax_z1_04','FullMax_z1_05',
        'FullMax_z1_06','FullMax_z1_07','FullMax_z1_08','FullMax_z1_09','FullMax_z1_10',

        // Kapasitas Maksimal - MI (1-10)
        'FullMax_m1_01','FullMax_m1_02','FullMax_m1_03','FullMax_m1_04','FullMax_m1_05',
        'FullMax_m1_06','FullMax_m1_07','FullMax_m1_08','FullMax_m1_09','FullMax_m1_10',

        'bebanOffCenter',
        'offCenterFront','offCenterMiddle','offCenterBack',
        'offCenterRight','offCenterLeft'
    ];

    protected $casts = [
        // Setengah Kapasitas Maksimal - MI (1-10)
        'HalfMax_m1_01'=>'decimal:5','HalfMax_m1_02'=>'decimal:5','HalfMax_m1_03'=>'decimal:5',
        'HalfMax_m1_04'=>'decimal:5','HalfMax_m1_05'=>'decimal:5','HalfMax_m1_06'=>'decimal:5',
        'HalfMax_m1_07'=>'decimal:5','HalfMax_m1_08'=>'decimal:5','HalfMax_m1_09'=>'decimal:5',
        'HalfMax_m1_10'=>'decimal:5',

        // Setengah Kapasitas Maksimal - ZI (1-10)
        'HalfMax_z1_01'=>'decimal:5','HalfMax_z1_02'=>'decimal:5','HalfMax_z1_03'=>'decimal:5',
        'HalfMax_z1_04'=>'decimal:5','HalfMax_z1_05'=>'decimal:5','HalfMax_z1_06'=>'decimal:5',
        'HalfMax_z1_07'=>'decimal:5','HalfMax_z1_08'=>'decimal:5','HalfMax_z1_09'=>'decimal:5',
        'HalfMax_z1_10'=>'decimal:5',

        // Kapasitas Maksimal - ZI (1-10)
        'FullMax_z1_01'=>'decimal:5','FullMax_z1_02'=>'decimal:5','FullMax_z1_03'=>'decimal:5',
        'FullMax_z1_04'=>'decimal:5','FullMax_z1_05'=>'decimal:5','FullMax_z1_06'=>'decimal:5',
        'FullMax_z1_07'=>'decimal:5','FullMax_z1_08'=>'decimal:5','FullMax_z1_09'=>'decimal:5',
        'FullMax_z1_10'=>'decimal:5',

        // Kapasitas Maksimal - MI (1-10)
        'FullMax_m1_01'=>'decimal:5','FullMax_m1_02'=>'decimal:5','FullMax_m1_03'=>'decimal:5',
        'FullMax_m1_04'=>'decimal:5','FullMax_m1_05'=>'decimal:5','FullMax_m1_06'=>'decimal:5',
        'FullMax_m1_07'=>'decimal:5','FullMax_m1_08'=>'decimal:5','FullMax_m1_09'=>'decimal:5',
        'FullMax_m1_10'=>'decimal:5',

        'bebanOffCenter'=>'decimal:5',
        'offCenterFront'=>'decimal:5',
        'offCenterMiddle'=>'decimal:5',
        'offCenterBack'=>'decimal:5',
        'offCenterRight'=>'decimal:5',
        'offCenterLeft'=>'decimal:5',
    ];

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}