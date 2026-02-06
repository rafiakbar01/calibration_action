<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailThreadGauge extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'sensor','kodeGO','satuan_go','nominalGO','GOatasX1','GOatasY1',
        'GObawahX1','GObawahY1','kodeNOTGO','satuan_not_go','nominalNOTGO',
        'NOTGOatasX1','NOTGOatasY1','NOTGObawahX1','NOTGObawahY1',
        'ukuranPitch','satuan_pitch','sudutUlir'
    ];

    protected $casts = [
        'nominalGO' => 'decimal:5',
        'GOatasX1'=>'decimal:5','GOatasY1'=>'decimal:5',
        'GObawahX1'=>'decimal:5','GObawahY1'=>'decimal:5',
        'nominalNOTGO'=>'decimal:5','NOTGOatasX1'=>'decimal:5','NOTGOatasY1'=>'decimal:5',
        'NOTGObawahX1'=>'decimal:5','NOTGObawahY1'=>'decimal:5',
        'ukuranPitch'=>'decimal:5',
        
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}