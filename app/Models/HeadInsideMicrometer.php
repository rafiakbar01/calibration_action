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
        'id', 'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','satuan_unit','form_index', 'rentang_ukur_min','rentang_ukur_max','kapasitas','resolusi'
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