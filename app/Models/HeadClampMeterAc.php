<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadClampMeterAc extends Model
{
    protected $table = 'head_clamp_meter_ac';
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
        return $this->hasMany(DetailClampMeterAc::class, 'head_clamp_meter_ac_id'); // ✅ UBAH
    }
}