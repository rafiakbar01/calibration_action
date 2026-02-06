<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddThermoIndicator extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_thermoindicator';
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'wireType',
        'rep01',
        'rep02',
        'rep03',
        'rep04',
        'rep05',
    ];

    protected $casts = [
        'rep01'=>'decimal:5',
        'rep02'=>'decimal:5',
        'rep03'=>'decimal:5',
        'rep04'=>'decimal:5',
        'rep05'=>'decimal:5',
    ];
  

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}