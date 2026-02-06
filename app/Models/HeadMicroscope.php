<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadMicroscope extends Model
{
    protected $table = 'head_microscope';
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
        return $this->hasMany(DetailMicroscope::class, 'head_microscope_id'); // ✅ UBAH
    }
}