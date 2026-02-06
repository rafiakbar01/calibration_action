<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadVolumetrik extends Model
{
    protected $table = 'head_volumetrik';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_alatUkur','satuan_rep'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailVolumetrik::class, 'head_volumetrik_id'); // ✅ UBAH
    }
}