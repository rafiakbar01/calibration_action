<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSurfacePlate extends Model
{
    use HasFactory;

   /**
     * Kolom yang dapat diisi (mass assignable)
     */
    protected $fillable = [
    'calibration_id',
    'a1_1', 'a1_2', 'a1_3', 'a1_4',
    'a2_1', 'a2_2', 'a2_3', 'a2_4',
    'a3_1', 'a3_2', 'a3_3', 'a3_4',
    'a4_1', 'a4_2', 'a4_3', 'a4_4',
    'a5_1', 'a5_2', 'a5_3', 'a5_4',
    'a6_1', 'a6_2', 'a6_3', 'a6_4',
    'a7_1', 'a7_2', 'a7_3', 'a7_4',
    'a8_1', 'a8_2', 'a8_3', 'a8_4',
    'a9_1', 'a9_2', 'a9_3', 'a9_4',
    'a10_1', 'a10_2', 'a10_3', 'a10_4',

    // tbl1
    'a1_1_tbl1', 'a1_2_tbl1',
    'a2_1_tbl1', 'a2_2_tbl1',
    'a3_1_tbl1', 'a3_2_tbl1',
    'a4_1_tbl1', 'a4_2_tbl1',
    'a5_1_tbl1', 'a5_2_tbl1',
    'a6_1_tbl1', 'a6_2_tbl1',
    'a7_1_tbl1', 'a7_2_tbl1',
    'a8_1_tbl1', 'a8_2_tbl1',
    'a9_1_tbl1', 'a9_2_tbl1',

    // tbl2
    'a1_1_tbl2', 'a1_2_tbl2',
    'b1_1_tbl2', 'b1_2_tbl2',
    'b2_1_tbl2', 'b2_2_tbl2',
    'b3_1_tbl2', 'b3_2_tbl2',
    'b4_1_tbl2', 'b4_2_tbl2',
    'b5_1_tbl2', 'b5_2_tbl2',
    'b6_1_tbl2', 'b6_2_tbl2',
    'b7_1_tbl2', 'b7_2_tbl2',
    'b8_1_tbl2', 'b8_2_tbl2',

    // tbl3
    'a1_1_tbl3', 'a1_2_tbl3',
    'c1_1_tbl3', 'c1_2_tbl3',
    'c2_1_tbl3', 'c2_2_tbl3',
    'c3_1_tbl3', 'c3_2_tbl3',
    'c4_1_tbl3', 'c4_2_tbl3',
    'c5_1_tbl3', 'c5_2_tbl3',
    'c6_1_tbl3', 'c6_2_tbl3',
    'c7_1_tbl3', 'c7_2_tbl3',
    'c8_1_tbl3', 'c8_2_tbl3',

    // tbl4
    'a1_1_tbl4', 'a1_2_tbl4',
    'd1_1_tbl4', 'd1_2_tbl4',
    'd2_1_tbl4', 'd2_2_tbl4',
    'd3_1_tbl4', 'd3_2_tbl4',
    'd4_1_tbl4', 'd4_2_tbl4',
    'd5_1_tbl4', 'd5_2_tbl4',
    'd6_1_tbl4', 'd6_2_tbl4',
    'd7_1_tbl4', 'd7_2_tbl4',
    'd8_1_tbl4', 'd8_2_tbl4',

    // tbl5
    'a1_1_tbl5', 'a1_2_tbl5',
    'e1_1_tbl5', 'e1_2_tbl5',
    'e2_1_tbl5', 'e2_2_tbl5',
    'e3_1_tbl5', 'e3_2_tbl5',
    'e4_1_tbl5', 'e4_2_tbl5',
    'e5_1_tbl5', 'e5_2_tbl5',
    'e6_1_tbl5', 'e6_2_tbl5',
    'e7_1_tbl5', 'e7_2_tbl5',
    'e8_1_tbl5', 'e8_2_tbl5',

    // tbl6
    'a1_1_tbl6', 'a1_2_tbl6',
    'f1_1_tbl6', 'f1_2_tbl6',
    'f2_1_tbl6', 'f2_2_tbl6',
    'f3_1_tbl6', 'f3_2_tbl6',
    'f4_1_tbl6', 'f4_2_tbl6',
    'f5_1_tbl6', 'f5_2_tbl6',
    'f6_1_tbl6', 'f6_2_tbl6',
    'f7_1_tbl6', 'f7_2_tbl6',
    'f8_1_tbl6', 'f8_2_tbl6',

    // tbl7
    'a1_1_tbl7', 'a1_2_tbl7',
    'g1_1_tbl7', 'g1_2_tbl7',
    'g2_1_tbl7', 'g2_2_tbl7',
    'g3_1_tbl7', 'g3_2_tbl7',
    'g4_1_tbl7', 'g4_2_tbl7',
    'g5_1_tbl7', 'g5_2_tbl7',
    'g6_1_tbl7', 'g6_2_tbl7',
    'g7_1_tbl7', 'g7_2_tbl7',
    'g8_1_tbl7', 'g8_2_tbl7',

    // tbl8
    'a1_1_tbl8', 'a1_2_tbl8',
    'h1_1_tbl8', 'h1_2_tbl8',
    'h2_1_tbl8', 'h2_2_tbl8',
    'h3_1_tbl8', 'h3_2_tbl8',
    'h4_1_tbl8', 'h4_2_tbl8',
    'h5_1_tbl8', 'h5_2_tbl8',
    'h6_1_tbl8', 'h6_2_tbl8',
    'h7_1_tbl8', 'h7_2_tbl8',
    'h8_1_tbl8', 'h8_2_tbl8',

    // tbl9
    'a1_1_tbl9', 'a1_2_tbl9',
    'i1_1_tbl9', 'i1_2_tbl9',
    'i2_1_tbl9', 'i2_2_tbl9',
    'i3_1_tbl9', 'i3_2_tbl9',
    'i4_1_tbl9', 'i4_2_tbl9',
    'i5_1_tbl9', 'i5_2_tbl9',
    'i6_1_tbl9', 'i6_2_tbl9',
    'i7_1_tbl9', 'i7_2_tbl9',
    'i8_1_tbl9', 'i8_2_tbl9',

    // tbl10
    'a1_1_tbl10', 'a1_2_tbl10',
    'j1_1_tbl10', 'j1_2_tbl10',
    'j2_1_tbl10', 'j2_2_tbl10',
    'j3_1_tbl10', 'j3_2_tbl10',
    'j4_1_tbl10', 'j4_2_tbl10',
    'j5_1_tbl10', 'j5_2_tbl10',
    'j6_1_tbl10', 'j6_2_tbl10',
    'j7_1_tbl10', 'j7_2_tbl10',
    'j8_1_tbl10', 'j8_2_tbl10',
];
  
protected $casts = [
    'calibration_id' => 'integer',

    'a1_1' => 'decimal:5', 'a1_2' => 'decimal:5', 'a1_3' => 'decimal:5', 'a1_4' => 'decimal:5',
    'a2_1' => 'decimal:5', 'a2_2' => 'decimal:5', 'a2_3' => 'decimal:5', 'a2_4' => 'decimal:5',
    'a3_1' => 'decimal:5', 'a3_2' => 'decimal:5', 'a3_3' => 'decimal:5', 'a3_4' => 'decimal:5',
    'a4_1' => 'decimal:5', 'a4_2' => 'decimal:5', 'a4_3' => 'decimal:5', 'a4_4' => 'decimal:5',
    'a5_1' => 'decimal:5', 'a5_2' => 'decimal:5', 'a5_3' => 'decimal:5', 'a5_4' => 'decimal:5',
    'a6_1' => 'decimal:5', 'a6_2' => 'decimal:5', 'a6_3' => 'decimal:5', 'a6_4' => 'decimal:5',
    'a7_1' => 'decimal:5', 'a7_2' => 'decimal:5', 'a7_3' => 'decimal:5', 'a7_4' => 'decimal:5',
    'a8_1' => 'decimal:5', 'a8_2' => 'decimal:5', 'a8_3' => 'decimal:5', 'a8_4' => 'decimal:5',
    'a9_1' => 'decimal:5', 'a9_2' => 'decimal:5', 'a9_3' => 'decimal:5', 'a9_4' => 'decimal:5',
    'a10_1' => 'decimal:5', 'a10_2' => 'decimal:5', 'a10_3' => 'decimal:5', 'a10_4' => 'decimal:5',

    'a1_1_tbl1' => 'decimal:5', 'a1_2_tbl1' => 'decimal:5',
    'a2_1_tbl1' => 'decimal:5', 'a2_2_tbl1' => 'decimal:5',
    'a3_1_tbl1' => 'decimal:5', 'a3_2_tbl1' => 'decimal:5',
    'a4_1_tbl1' => 'decimal:5', 'a4_2_tbl1' => 'decimal:5',
    'a5_1_tbl1' => 'decimal:5', 'a5_2_tbl1' => 'decimal:5',
    'a6_1_tbl1' => 'decimal:5', 'a6_2_tbl1' => 'decimal:5',
    'a7_1_tbl1' => 'decimal:5', 'a7_2_tbl1' => 'decimal:5',
    'a8_1_tbl1' => 'decimal:5', 'a8_2_tbl1' => 'decimal:5',
    'a9_1_tbl1' => 'decimal:5', 'a9_2_tbl1' => 'decimal:5',

    'a1_1_tbl2' => 'decimal:5', 'a1_2_tbl2' => 'decimal:5',
    'b1_1_tbl2' => 'decimal:5', 'b1_2_tbl2' => 'decimal:5',
    'b2_1_tbl2' => 'decimal:5', 'b2_2_tbl2' => 'decimal:5',
    'b3_1_tbl2' => 'decimal:5', 'b3_2_tbl2' => 'decimal:5',
    'b4_1_tbl2' => 'decimal:5', 'b4_2_tbl2' => 'decimal:5',
    'b5_1_tbl2' => 'decimal:5', 'b5_2_tbl2' => 'decimal:5',
    'b6_1_tbl2' => 'decimal:5', 'b6_2_tbl2' => 'decimal:5',
    'b7_1_tbl2' => 'decimal:5', 'b7_2_tbl2' => 'decimal:5',
    'b8_1_tbl2' => 'decimal:5', 'b8_2_tbl2' => 'decimal:5',

    'a1_1_tbl3' => 'decimal:5', 'a1_2_tbl3' => 'decimal:5',
    'c1_1_tbl3' => 'decimal:5', 'c1_2_tbl3' => 'decimal:5',
    'c2_1_tbl3' => 'decimal:5', 'c2_2_tbl3' => 'decimal:5',
    'c3_1_tbl3' => 'decimal:5', 'c3_2_tbl3' => 'decimal:5',
    'c4_1_tbl3' => 'decimal:5', 'c4_2_tbl3' => 'decimal:5',
    'c5_1_tbl3' => 'decimal:5', 'c5_2_tbl3' => 'decimal:5',
    'c6_1_tbl3' => 'decimal:5', 'c6_2_tbl3' => 'decimal:5',
    'c7_1_tbl3' => 'decimal:5', 'c7_2_tbl3' => 'decimal:5',
    'c8_1_tbl3' => 'decimal:5', 'c8_2_tbl3' => 'decimal:5',

    'a1_1_tbl4' => 'decimal:5', 'a1_2_tbl4' => 'decimal:5',
    'd1_1_tbl4' => 'decimal:5', 'd1_2_tbl4' => 'decimal:5',
    'd2_1_tbl4' => 'decimal:5', 'd2_2_tbl4' => 'decimal:5',
    'd3_1_tbl4' => 'decimal:5', 'd3_2_tbl4' => 'decimal:5',
    'd4_1_tbl4' => 'decimal:5', 'd4_2_tbl4' => 'decimal:5',
    'd5_1_tbl4' => 'decimal:5', 'd5_2_tbl4' => 'decimal:5',
    'd6_1_tbl4' => 'decimal:5', 'd6_2_tbl4' => 'decimal:5',
    'd7_1_tbl4' => 'decimal:5', 'd7_2_tbl4' => 'decimal:5',
    'd8_1_tbl4' => 'decimal:5', 'd8_2_tbl4' => 'decimal:5',

    'a1_1_tbl5' => 'decimal:5', 'a1_2_tbl5' => 'decimal:5',
    'e1_1_tbl5' => 'decimal:5', 'e1_2_tbl5' => 'decimal:5',
    'e2_1_tbl5' => 'decimal:5', 'e2_2_tbl5' => 'decimal:5',
    'e3_1_tbl5' => 'decimal:5', 'e3_2_tbl5' => 'decimal:5',
    'e4_1_tbl5' => 'decimal:5', 'e4_2_tbl5' => 'decimal:5',
    'e5_1_tbl5' => 'decimal:5', 'e5_2_tbl5' => 'decimal:5',
    'e6_1_tbl5' => 'decimal:5', 'e6_2_tbl5' => 'decimal:5',
    'e7_1_tbl5' => 'decimal:5', 'e7_2_tbl5' => 'decimal:5',
    'e8_1_tbl5' => 'decimal:5', 'e8_2_tbl5' => 'decimal:5',

    'a1_1_tbl6' => 'decimal:5', 'a1_2_tbl6' => 'decimal:5',
    'f1_1_tbl6' => 'decimal:5', 'f1_2_tbl6' => 'decimal:5',
    'f2_1_tbl6' => 'decimal:5', 'f2_2_tbl6' => 'decimal:5',
    'f3_1_tbl6' => 'decimal:5', 'f3_2_tbl6' => 'decimal:5',
    'f4_1_tbl6' => 'decimal:5', 'f4_2_tbl6' => 'decimal:5',
    'f5_1_tbl6' => 'decimal:5', 'f5_2_tbl6' => 'decimal:5',
    'f6_1_tbl6' => 'decimal:5', 'f6_2_tbl6' => 'decimal:5',
    'f7_1_tbl6' => 'decimal:5', 'f7_2_tbl6' => 'decimal:5',
    'f8_1_tbl6' => 'decimal:5', 'f8_2_tbl6' => 'decimal:5',

    'a1_1_tbl7' => 'decimal:5', 'a1_2_tbl7' => 'decimal:5',
    'g1_1_tbl7' => 'decimal:5', 'g1_2_tbl7' => 'decimal:5',
    'g2_1_tbl7' => 'decimal:5', 'g2_2_tbl7' => 'decimal:5',
    'g3_1_tbl7' => 'decimal:5', 'g3_2_tbl7' => 'decimal:5',
    'g4_1_tbl7' => 'decimal:5', 'g4_2_tbl7' => 'decimal:5',
    'g5_1_tbl7' => 'decimal:5', 'g5_2_tbl7' => 'decimal:5',
    'g6_1_tbl7' => 'decimal:5', 'g6_2_tbl7' => 'decimal:5',
    'g7_1_tbl7' => 'decimal:5', 'g7_2_tbl7' => 'decimal:5',
    'g8_1_tbl7' => 'decimal:5', 'g8_2_tbl7' => 'decimal:5',

    'a1_1_tbl8' => 'decimal:5', 'a1_2_tbl8' => 'decimal:5',
    'h1_1_tbl8' => 'decimal:5', 'h1_2_tbl8' => 'decimal:5',
    'h2_1_tbl8' => 'decimal:5', 'h2_2_tbl8' => 'decimal:5',
    'h3_1_tbl8' => 'decimal:5', 'h3_2_tbl8' => 'decimal:5',
    'h4_1_tbl8' => 'decimal:5', 'h4_2_tbl8' => 'decimal:5',
    'h5_1_tbl8' => 'decimal:5', 'h5_2_tbl8' => 'decimal:5',
    'h6_1_tbl8' => 'decimal:5', 'h6_2_tbl8' => 'decimal:5',
    'h7_1_tbl8' => 'decimal:5', 'h7_2_tbl8' => 'decimal:5',
    'h8_1_tbl8' => 'decimal:5', 'h8_2_tbl8' => 'decimal:5',

    'a1_1_tbl9' => 'decimal:5', 'a1_2_tbl9' => 'decimal:5',
    'i1_1_tbl9' => 'decimal:5', 'i1_2_tbl9' => 'decimal:5',
    'i2_1_tbl9' => 'decimal:5', 'i2_2_tbl9' => 'decimal:5',
    'i3_1_tbl9' => 'decimal:5', 'i3_2_tbl9' => 'decimal:5',
    'i4_1_tbl9' => 'decimal:5', 'i4_2_tbl9' => 'decimal:5',
    'i5_1_tbl9' => 'decimal:5', 'i5_2_tbl9' => 'decimal:5',
    'i6_1_tbl9' => 'decimal:5', 'i6_2_tbl9' => 'decimal:5',
    'i7_1_tbl9' => 'decimal:5', 'i7_2_tbl9' => 'decimal:5',
    'i8_1_tbl9' => 'decimal:5', 'i8_2_tbl9' => 'decimal:5',

    'a1_1_tbl10' => 'decimal:5', 'a1_2_tbl10' => 'decimal:5',
    'j1_1_tbl10' => 'decimal:5', 'j1_2_tbl10' => 'decimal:5',
    'j2_1_tbl10' => 'decimal:5', 'j2_2_tbl10' => 'decimal:5',
    'j3_1_tbl10' => 'decimal:5', 'j3_2_tbl10' => 'decimal:5',
    'j4_1_tbl10' => 'decimal:5', 'j4_2_tbl10' => 'decimal:5',
    'j5_1_tbl10' => 'decimal:5', 'j5_2_tbl10' => 'decimal:5',
    'j6_1_tbl10' => 'decimal:5', 'j6_2_tbl10' => 'decimal:5',
    'j7_1_tbl10' => 'decimal:5', 'j7_2_tbl10' => 'decimal:5',
    'j8_1_tbl10' => 'decimal:5', 'j8_2_tbl10' => 'decimal:5',
];


    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}