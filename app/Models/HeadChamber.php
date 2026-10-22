<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeadChamber extends Model
{
    protected $table = 'head_chamber';
    protected $primaryKey = 'id'; 
    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = [
        'calibration_id', 'certificate_id', 'standard', 'calibrationMethod','form_index', 'keterangan_gambar'
    ];

    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    public function details()
    {
        return $this->hasMany(DetailEnclosure::class, 'head_chamber_id'); // ✅ UBAH
    }
}