<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadSurfaceRoughnessTester extends Model
{
    protected $table = 'head_surface_roughness_tester';
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
        return $this->hasMany(DetailSurfaceRoughnessTester::class, 'head_surface_roughness_tester_id'); // ✅ UBAH
    }
}