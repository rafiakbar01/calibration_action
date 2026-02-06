<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadConductivityMeter extends Model
{
    protected $table = 'head_conductivity_meter';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailConductivityMeter::class, 'head_condictivity_meter_id'); // ✅ UBAH
    }
}