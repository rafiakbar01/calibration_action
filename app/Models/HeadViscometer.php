<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadViscometer extends Model
{
    protected $table = 'head_viscometer';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_std','satuan_alat'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailViscometer::class, 'head_Viscometer_id'); // ✅ UBAH
    }
}