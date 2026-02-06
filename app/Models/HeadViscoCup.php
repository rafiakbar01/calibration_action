<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadViscoCup extends Model
{
    protected $table = 'head_visco_cup';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','catatan'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailViscoCup::class, 'head_visco_cup_id'); // ✅ UBAH
    }
}