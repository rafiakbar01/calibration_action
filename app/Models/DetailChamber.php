<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailChamber extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */

    //  protected $table = 'detail_torque_meters'; // Atau nama tabel yang benar

    protected $fillable = [
        'calibration_id',
        'repetition_number',
        'interval_number',
        'readAlat',
        'RHAlat',
        'ulangan01',
        'ulangan02',
        'ulangan03',
        'ulangan04',
        'ulangan05',
        'ulangan06',
        'ulangan07',
        'ulangan08',
        'ulangan09',
        'RHulangan',
        'form_index'

    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'repetition_number' => 'integer',
        'interval_number' => 'integer',
      
        // 'readAlat' => 'decimal:5',
        // 'RHAlat' => 'decimal:5',
        // 'ulangan01' => 'decimal:5',
        // 'ulangan02' => 'decimal:5',
        // 'ulangan03' => 'decimal:5',
        // 'ulangan04' => 'decimal:5',
        // 'ulangan05' => 'decimal:5',
        // 'ulangan06'  => 'decimal:5',
        // 'ulangan07'  => 'decimal:5',
        // 'ulangan08'  => 'decimal:5',
        // 'ulangan09'  => 'decimal:5',
        // 'RHulangan'  => 'decimal:5',
    ];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}