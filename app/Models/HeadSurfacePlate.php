<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadSurfacePlate extends Model
{
    protected $table = 'head_surface_plate';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','keterangan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailSurfacePlate::class, 'head_surface_plate_id'); // ✅ UBAH
    }
}