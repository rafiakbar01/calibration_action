<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadEnclosure extends Model
{
    protected $table = 'head_enclosure';
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
        return $this->hasMany(DetailEnclosure::class, 'head_enclosure_id'); // ✅ UBAH
    }
}