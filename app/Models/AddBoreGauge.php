<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBoreGauge extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'add_bore_gauge';
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'repeatability',
        'rep01',
        'rep02',
        'rep03',
        'rep04',
        'rep05',
        'rep06',
        'rep07',
        'rep08',
        'rep09',
        'rep10',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
      
        'repeatability' => 'string', 
        'rep01' => 'string', 
        'rep02' => 'string', 
        'rep03' => 'string', 
        'rep04' => 'string', 
        'rep05' => 'string', 
        'rep06' => 'string', 
        'rep07' => 'string', 
        'rep08' => 'string', 
        'rep09' => 'string', 
        'rep10' => 'string', 
    ];
  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}