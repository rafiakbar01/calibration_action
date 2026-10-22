<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOutsideMicrometer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_outside_micrometers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'calibration_id',
        'ukuranAnvil1',
        'jumlahAnvil1',
        'ukuranAnvil2',
        'jumlahAnvil2',
        'ukuranSpindle1',
        'jumlahSpindle1',
        'ukuranSpindle2',
        'jumlahSpindle2',
        'form_index'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'ukuranAnvil1' => 'decimal:2',
    //     'ukuranAnvil2' => 'decimal:2',
    //     'ukuranSpindle1' => 'decimal:2',
    //     'ukuranSpindle2' => 'decimal:2',
    // ];

    /**
     * Get the calibration that owns the outside micrometer data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}