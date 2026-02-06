<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPushpull extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = 'add_push_pull'; // ✅ TAMBAHKAN INI
    /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
        'calibration_id',
        'repeatabilityTarik01',
        'repeatabilityTarik02',
        'repeatabilityTarik03',
        'repeatabilityTarik04',
        'repeatabilityTarik05',
        'repeatabilityTarik06',
        'repeatabilityTarik07',
        'repeatabilityTarik08',
        'repeatabilityTarik09',
        'repeatabilityTarik10',

        'repeatabilityTekan01',
        'repeatabilityTekan02',
        'repeatabilityTekan03',
        'repeatabilityTekan04',
        'repeatabilityTekan05',
        'repeatabilityTekan06',
        'repeatabilityTekan07',
        'repeatabilityTekan08',
        'repeatabilityTekan09',
        'repeatabilityTekan10',

    ];

    protected $casts = [
        'repeatabilityTarik01'=>'decimal:5',
        'repeatabilityTarik02'=>'decimal:5',
        'repeatabilityTarik03'=>'decimal:5',
        'repeatabilityTarik04'=>'decimal:5',
        'repeatabilityTarik05'=>'decimal:5',
        'repeatabilityTarik06'=>'decimal:5',
        'repeatabilityTarik07'=>'decimal:5',
        'repeatabilityTarik08'=>'decimal:5',
        'repeatabilityTarik09'=>'decimal:5',
        'repeatabilityTarik10'=>'decimal:5',

        'repeatabilityTekan01'=>'decimal:5',
        'repeatabilityTekan02'=>'decimal:5',
        'repeatabilityTekan03'=>'decimal:5',
        'repeatabilityTekan04'=>'decimal:5',
        'repeatabilityTekan05'=>'decimal:5',
        'repeatabilityTekan06'=>'decimal:5',
        'repeatabilityTekan07'=>'decimal:5',
        'repeatabilityTekan08'=>'decimal:5',
        'repeatabilityTekan09'=>'decimal:5',
        'repeatabilityTekan10'=>'decimal:5',
    ];
  

    /**
     * Get the calibration that owns the dial indicator data.
     */
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }
}