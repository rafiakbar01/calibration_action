<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadTempHumidTransmitter extends Model
{
    protected $table = 'head_temp_humid_transmitter';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','tertelusur'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details_t()
    {
        return $this->hasMany(Detail_T_TempHumidTransmitter::class, 'calibration_id', 'calibration_id');
    }

    
    public function details_rh()
    {
        return $this->hasMany(Detail_RH_TempHumidTransmitter::class, 'calibration_id', 'calibration_id');
    }
}