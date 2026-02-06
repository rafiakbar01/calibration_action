<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailThermometer extends Model
{
    use HasFactory;
        protected $table = 'detail_thermometers';


    protected $casts = [
        'STD01' => 'decimal:5',
        'STD02' => 'decimal:5',
        'STD03' => 'decimal:5',
        'UUT01' => 'decimal:5',
        'UUT02' => 'decimal:5',
        'UUT03' => 'decimal:5',
    ];

    protected $fillable = [
        'calibration_id', 
        'titikUkur',
        'satuan', 
        'STD01',
        'STD02',
        'STD03',
        'UUT01',
        'UUT02',
        'UUT03'
    ];

    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}