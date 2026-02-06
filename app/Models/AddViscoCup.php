<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddViscoCup extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
  
    protected $table = 'add_visco_cup';
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'type',
        'kodeNomor',
        'others',

    ];

  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}