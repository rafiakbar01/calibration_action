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
        'repeatibility_P'=>'decimal:5',
        'repP01'=>'decimal:5',
        'repP02'=>'decimal:5',
        'repP03'=>'decimal:5',
        'repP04'=>'decimal:5',
        'repP05'=>'decimal:5',
        'repP06'=>'decimal:5',
        'repP07'=>'decimal:5',
        'repP08'=>'decimal:5',
        'repP09'=>'decimal:5',
        'repP10'=>'decimal:5',
        'repeatibility_SO'=>'decimal:5',
        'repSO01'=>'decimal:5',
        'repSO02'=>'decimal:5',
        'repSO03'=>'decimal:5',
        'repSO04'=>'decimal:5',
        'repSO05'=>'decimal:5',
        'repSO06'=>'decimal:5',
        'repSO07'=>'decimal:5',
        'repSO08'=>'decimal:5',
        'repSO09'=>'decimal:5',
        'repSO10'=>'decimal:5'
    ];

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}