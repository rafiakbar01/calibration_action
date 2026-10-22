<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInsulation extends Model
{
    use HasFactory;

    protected $table = 'detail_insulations';

    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'parameter_type',
        'rentang',
        'titik_ukur',
        'readAlat_1',
        'readAlat_2',
        'readAlat_3',
        'readAlat_4',
        'readAlat_5',
        'resolusi_alat',
        'frequency',
        'coil'
    ];

    protected $casts = [
        'titik_ukur' => 'string',
        'readAlat_1' => 'string',
        'readAlat_2' => 'string',
        'readAlat_3' => 'string',
        'readAlat_4' => 'string',
        'readAlat_5' => 'string',
        'resolusi_alat' => 'string',
        'frequency' => 'string',
        'coil' => 'string',
    ];

    /**
     * Relasi ke Calibration utama
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }
}
