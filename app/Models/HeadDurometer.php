<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadDurometer extends Model
{
    protected $table = 'head_durometer';
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
        return $this->hasMany(DetailDurometer::class, 'head_durometer_id'); // ✅ UBAH
    }
}