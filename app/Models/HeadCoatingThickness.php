<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadCoatingThickness extends Model
{
    protected $table = 'head_coating_thickness';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_unit'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailCoatingThickness::class, 'head_coating_thickness_id'); // ✅ UBAH
    }
}