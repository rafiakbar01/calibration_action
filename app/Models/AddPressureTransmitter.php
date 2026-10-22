<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPressureTransmitter extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
  
    protected $table = 'add_pressure_transmitter';
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'satuan_P',
        'repeatibility_P',
        'repP01',
        'repP02',
        'repP03',
        'repP04',
        'repP05',
        'repP06',
        'repP07',
        'repP08',
        'repP09',
        'repP10',

        'satuan_SO',
        'repeatibility_SO',
        'repSO01',
        'repSO02',
        'repSO03',
        'repSO04',
        'repSO05',
        'repSO06',
        'repSO07',
        'repSO08',
        'repSO09',
        'repSO10'
    ];

    protected $casts = [
        'repeatibility_P'=>'string',
        'repP01'=>'string',
        'repP02'=>'string',
        'repP03'=>'string',
        'repP04'=>'string',
        'repP05'=>'string',
        'repP06'=>'string',
        'repP07'=>'string',
        'repP08'=>'string',
        'repP09'=>'string',
        'repP10'=>'string',
        'repeatibility_SO'=>'string',
        'repSO01'=>'string',
        'repSO02'=>'string',
        'repSO03'=>'string',
        'repSO04'=>'string',
        'repSO05'=>'string',
        'repSO06'=>'string',
        'repSO07'=>'string',
        'repSO08'=>'string',
        'repSO09'=>'string',
        'repSO10'=>'string'
    ];

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}