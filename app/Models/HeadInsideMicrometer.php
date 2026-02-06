<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadInsideMicrometer extends Model
{
    protected $table = 'head_inside_micrometers';
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
        return $this->hasMany(DetailInsideMicrometer::class, 'head_inside_micrometer_id'); // ✅ UBAH
    }
}