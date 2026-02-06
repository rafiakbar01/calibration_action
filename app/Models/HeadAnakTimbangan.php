<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadAnakTimbangan extends Model
{
    protected $table = 'head_anak_timbangan';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_unit01','satuan_unit02'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailAnakTimbangan::class, 'head_anak_timbangan_id'); // ✅ UBAH
    }
}