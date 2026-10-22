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
        'titikUkur' => 'string',
        'STDm1'   => 'string',
        'STDs1'   => 'string',
        'STDms1'   => 'string',
        'STDm2'   => 'string',
        'STDs2'   => 'string',
        'STDms2'   => 'string',
        'STDm3'   => 'string',
        'STDs3'   => 'string',
        'STDms3'   => 'string',
        'STDm4'   => 'string',
        'STDs4'   => 'string',
        'STDms4'   => 'string',
        'STDm5'   => 'string',
        'STDs5'   => 'string',
        'STDms5'   => 'string',
        'UUTm1'   => 'string',
        'UUTs1'   => 'string',
        'UUTms1'   => 'string',
        'UUTm2'   => 'string',
        'UUTs2'   => 'string',
        'UUTms2'   => 'string',
        'UUTm3'   => 'string',
        'UUTs3'   => 'string',
        'UUTms3'   => 'string',
        'UUTm4'   => 'string',
        'UUTs4'   => 'string',
        'UUTms4'   => 'string',
        'UUTm5'   => 'string',
        'UUTs5'   => 'string',
        'UUTms5'   => 'string'
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}