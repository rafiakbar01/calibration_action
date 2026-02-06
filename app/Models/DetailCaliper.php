<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCaliper extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'titikUkur',
        'outside01',
        'outside02',
        'outside03',
        'outside04',
        'outside05',
        'inside01',
        'inside02',
        'inside03',
        'inside04',
        'inside05'
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'titikUkur' => 'decimal:5',
        'outside01' => 'decimal:5',
        'outside02' => 'decimal:5',
        'outside03' => 'decimal:5',
        'outside04' => 'decimal:5',
        'outside05' => 'decimal:5',
        'inside01'  => 'decimal:5',
        'inside02'  => 'decimal:5',
        'inside03'  => 'decimal:5',
        'inside04'  => 'decimal:5',
        'inside05'  => 'decimal:5',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}