<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadProfilProjector extends Model
{
    protected $table = 'head_profil_projector';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_titik_ukur','satuan_alat_x','satuan_alat_y'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailProfilProjector::class, 'head_profil_projector_id'); // ✅ UBAH
    }
}