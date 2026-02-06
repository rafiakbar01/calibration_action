<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStopwatch extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $table = 'detail_stopwatchs';
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'STDm1',
        'STDs1',
        'STDms1',
        'STDm2',
        'STDs2',
        'STDms2',
        'STDm3',
        'STDs3',
        'STDms3',
        'STDm4',
        'STDs4',
        'STDms4',
        'STDm5',
        'STDs5',
        'STDms5',
        'UUTm1',
        'UUTs1',
        'UUTms1',
        'UUTm2',
        'UUTs2',
        'UUTms2',
        'UUTm3',
        'UUTs3',
        'UUTms3',
        'UUTm4',
        'UUTs4',
        'UUTms4',
        'UUTm5',
        'UUTs5',
        'UUTms5'
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'titikUkur' => 'decimal:5',
        'STDm1'   => 'decimal:5',
        'STDs1'   => 'decimal:5',
        'STDms1'   => 'decimal:5',
        'STDm2'   => 'decimal:5',
        'STDs2'   => 'decimal:5',
        'STDms2'   => 'decimal:5',
        'STDm3'   => 'decimal:5',
        'STDs3'   => 'decimal:5',
        'STDms3'   => 'decimal:5',
        'STDm4'   => 'decimal:5',
        'STDs4'   => 'decimal:5',
        'STDms4'   => 'decimal:5',
        'STDm5'   => 'decimal:5',
        'STDs5'   => 'decimal:5',
        'STDms5'   => 'decimal:5',
        'UUTm1'   => 'decimal:5',
        'UUTs1'   => 'decimal:5',
        'UUTms1'   => 'decimal:5',
        'UUTm2'   => 'decimal:5',
        'UUTs2'   => 'decimal:5',
        'UUTms2'   => 'decimal:5',
        'UUTm3'   => 'decimal:5',
        'UUTs3'   => 'decimal:5',
        'UUTms3'   => 'decimal:5',
        'UUTm4'   => 'decimal:5',
        'UUTs4'   => 'decimal:5',
        'UUTms4'   => 'decimal:5',
        'UUTm5'   => 'decimal:5',
        'UUTs5'   => 'decimal:5',
        'UUTms5'   => 'decimal:5'
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}