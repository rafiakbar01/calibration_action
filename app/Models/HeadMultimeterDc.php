<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadMultimeterDc extends Model
{
    protected $table = 'head_multimeter_dc';
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
        return $this->hasMany(DetailMultimeterDc::class, 'head_multimeter_dc_id'); // ✅ UBAH
    }
}