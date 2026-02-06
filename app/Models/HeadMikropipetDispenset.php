<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadMikropipetDispenset extends Model
{
    protected $table = 'head_mikropipet_dispenset';
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
        return $this->hasMany(DetailMikropipetDispenset::class, 'head_mikropipet_dispenset_id'); // ✅ UBAH
    }
}