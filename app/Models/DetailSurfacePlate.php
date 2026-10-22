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
        'a1_1',  'a1_2',  'a1_3',  'a1_4',  'a1_5',  'a1_6',  'a1_7',  'a1_8',  'a1_9',  'a1_10',
        'a2_1',  'a2_2',  'a2_3',  'a2_4',  'a2_5',  'a2_6',  'a2_7',  'a2_8',  'a2_9',  'a2_10',
        'a3_1',  'a3_2',  'a3_3',  'a3_4',  'a3_5',  'a3_6',  'a3_7',  'a3_8',  'a3_9',  'a3_10',
        'a4_1',  'a4_2',  'a4_3',  'a4_4',  'a4_5',  'a4_6',  'a4_7',  'a4_8',  'a4_9',  'a4_10',
        'a5_1',  'a5_2',  'a5_3',  'a5_4',  'a5_5',  'a5_6',  'a5_7',  'a5_8',  'a5_9',  'a5_10',
        'a6_1',  'a6_2',  'a6_3',  'a6_4',  'a6_5',  'a6_6',  'a6_7',  'a6_8',  'a6_9',  'a6_10',
        'a7_1',  'a7_2',  'a7_3',  'a7_4',  'a7_5',  'a7_6',  'a7_7',  'a7_8',  'a7_9',  'a7_10',
        'a8_1',  'a8_2',  'a8_3',  'a8_4',  'a8_5',  'a8_6',  'a8_7',  'a8_8',  'a8_9',  'a8_10',
        'a9_1',  'a9_2',  'a9_3',  'a9_4',  'a9_5',  'a9_6',  'a9_7',  'a9_8',  'a9_9',  'a9_10',
        'a10_1', 'a10_2', 'a10_3', 'a10_4', 'a10_5', 'a10_6', 'a10_7', 'a10_8', 'a10_9', 'a10_10',
        'a11_1', 'a11_2', 'a11_3', 'a11_4', 'a11_5', 'a11_6', 'a11_7', 'a11_8', 'a11_9', 'a11_10',
        'a12_1', 'a12_2', 'a12_3', 'a12_4', 'a12_5', 'a12_6', 'a12_7', 'a12_8', 'a12_9', 'a12_10',
        'a13_1', 'a13_2', 'a13_3', 'a13_4', 'a13_5', 'a13_6', 'a13_7', 'a13_8', 'a13_9', 'a13_10',

       // ================= TBL1 (Group A) - 10 baris =================
        'a1_1_tbl1', 'a1_2_tbl1',
        'a2_1_tbl1', 'a2_2_tbl1',
        'a3_1_tbl1', 'a3_2_tbl1',
        'a4_1_tbl1', 'a4_2_tbl1',
        'a5_1_tbl1', 'a5_2_tbl1',
        'a6_1_tbl1', 'a6_2_tbl1',
        'a7_1_tbl1', 'a7_2_tbl1',
        'a8_1_tbl1', 'a8_2_tbl1',
        'a9_1_tbl1', 'a9_2_tbl1',
        'a10_1_tbl1', 'a10_2_tbl1',   // <-- TAMBAHAN

        // ================= TBL2 (Group B) - 10 baris =================
        'a1_1_tbl2', 'a1_2_tbl2',
        'b1_1_tbl2', 'b1_2_tbl2',
        'b2_1_tbl2', 'b2_2_tbl2',
        'b3_1_tbl2', 'b3_2_tbl2',
        'b4_1_tbl2', 'b4_2_tbl2',
        'b5_1_tbl2', 'b5_2_tbl2',
        'b6_1_tbl2', 'b6_2_tbl2',
        'b7_1_tbl2', 'b7_2_tbl2',
        'b8_1_tbl2', 'b8_2_tbl2',
        'b9_1_tbl2', 'b9_2_tbl2',     // <-- TAMBAHAN
        'b10_1_tbl2', 'b10_2_tbl2',   // <-- TAMBAHAN

        // ================= TBL3 (Group C) - 10 baris =================
        'a1_1_tbl3', 'a1_2_tbl3',
        'c1_1_tbl3', 'c1_2_tbl3',
        'c2_1_tbl3', 'c2_2_tbl3',
        'c3_1_tbl3', 'c3_2_tbl3',
        'c4_1_tbl3', 'c4_2_tbl3',
        'c5_1_tbl3', 'c5_2_tbl3',
        'c6_1_tbl3', 'c6_2_tbl3',
        'c7_1_tbl3', 'c7_2_tbl3',
        'c8_1_tbl3', 'c8_2_tbl3',
        'c9_1_tbl3', 'c9_2_tbl3',     // <-- TAMBAHAN
        'c10_1_tbl3', 'c10_2_tbl3',   // <-- TAMBAHAN

        // ================= TBL4 (Group D) - 10 baris =================
        'a1_1_tbl4', 'a1_2_tbl4',
        'd1_1_tbl4', 'd1_2_tbl4',
        'd2_1_tbl4', 'd2_2_tbl4',
        'd3_1_tbl4', 'd3_2_tbl4',
        'd4_1_tbl4', 'd4_2_tbl4',
        'd5_1_tbl4', 'd5_2_tbl4',
        'd6_1_tbl4', 'd6_2_tbl4',
        'd7_1_tbl4', 'd7_2_tbl4',
        'd8_1_tbl4', 'd8_2_tbl4',
        'd9_1_tbl4', 'd9_2_tbl4',     // <-- TAMBAHAN
        'd10_1_tbl4', 'd10_2_tbl4',   // <-- TAMBAHAN

        // ================= TBL5 (Group E) - 10 baris =================
        'a1_1_tbl5', 'a1_2_tbl5',
        'e1_1_tbl5', 'e1_2_tbl5',
        'e2_1_tbl5', 'e2_2_tbl5',
        'e3_1_tbl5', 'e3_2_tbl5',
        'e4_1_tbl5', 'e4_2_tbl5',
        'e5_1_tbl5', 'e5_2_tbl5',
        'e6_1_tbl5', 'e6_2_tbl5',
        'e7_1_tbl5', 'e7_2_tbl5',
        'e8_1_tbl5', 'e8_2_tbl5',
        'e9_1_tbl5', 'e9_2_tbl5',     // <-- TAMBAHAN
        'e10_1_tbl5', 'e10_2_tbl5',   // <-- TAMBAHAN

        // ================= TBL6 (Group F) - 10 baris =================
        'a1_1_tbl6', 'a1_2_tbl6',
        'f1_1_tbl6', 'f1_2_tbl6',
        'f2_1_tbl6', 'f2_2_tbl6',
        'f3_1_tbl6', 'f3_2_tbl6',
        'f4_1_tbl6', 'f4_2_tbl6',
        'f5_1_tbl6', 'f5_2_tbl6',
        'f6_1_tbl6', 'f6_2_tbl6',
        'f7_1_tbl6', 'f7_2_tbl6',
        'f8_1_tbl6', 'f8_2_tbl6',
        'f9_1_tbl6', 'f9_2_tbl6',     // <-- TAMBAHAN
        'f10_1_tbl6', 'f10_2_tbl6',   // <-- TAMBAHAN

        // ================= TBL7 (Group G) - 10 baris =================
        'a1_1_tbl7', 'a1_2_tbl7',
        'g1_1_tbl7', 'g1_2_tbl7',
        'g2_1_tbl7', 'g2_2_tbl7',
        'g3_1_tbl7', 'g3_2_tbl7',
        'g4_1_tbl7', 'g4_2_tbl7',
        'g5_1_tbl7', 'g5_2_tbl7',
        'g6_1_tbl7', 'g6_2_tbl7',
        'g7_1_tbl7', 'g7_2_tbl7',
        'g8_1_tbl7', 'g8_2_tbl7',
        'g9_1_tbl7', 'g9_2_tbl7',     // <-- TAMBAHAN
        'g10_1_tbl7', 'g10_2_tbl7',   // <-- TAMBAHAN

        // ================= TBL8 (Group H) - 10 baris =================
        'a1_1_tbl8', 'a1_2_tbl8',
        'h1_1_tbl8', 'h1_2_tbl8',
        'h2_1_tbl8', 'h2_2_tbl8',
        'h3_1_tbl8', 'h3_2_tbl8',
        'h4_1_tbl8', 'h4_2_tbl8',
        'h5_1_tbl8', 'h5_2_tbl8',
        'h6_1_tbl8', 'h6_2_tbl8',
        'h7_1_tbl8', 'h7_2_tbl8',
        'h8_1_tbl8', 'h8_2_tbl8',
        'h9_1_tbl8', 'h9_2_tbl8',     // <-- TAMBAHAN
        'h10_1_tbl8', 'h10_2_tbl8',   // <-- TAMBAHAN

        // ================= TBL9 (Group I) - 10 baris =================
        'a1_1_tbl9', 'a1_2_tbl9',
        'i1_1_tbl9', 'i1_2_tbl9',
        'i2_1_tbl9', 'i2_2_tbl9',
        'i3_1_tbl9', 'i3_2_tbl9',
        'i4_1_tbl9', 'i4_2_tbl9',
        'i5_1_tbl9', 'i5_2_tbl9',
        'i6_1_tbl9', 'i6_2_tbl9',
        'i7_1_tbl9', 'i7_2_tbl9',
        'i8_1_tbl9', 'i8_2_tbl9',
        'i9_1_tbl9', 'i9_2_tbl9',     // <-- TAMBAHAN
        'i10_1_tbl9', 'i10_2_tbl9',   // <-- TAMBAHAN

        // ================= TBL10 (Group J) - 10 baris =================
        'a1_1_tbl10', 'a1_2_tbl10',
        'j1_1_tbl10', 'j1_2_tbl10',
        'j2_1_tbl10', 'j2_2_tbl10',
        'j3_1_tbl10', 'j3_2_tbl10',
        'j4_1_tbl10', 'j4_2_tbl10',
        'j5_1_tbl10', 'j5_2_tbl10',
        'j6_1_tbl10', 'j6_2_tbl10',
        'j7_1_tbl10', 'j7_2_tbl10',
        'j8_1_tbl10', 'j8_2_tbl10',
        'j9_1_tbl10', 'j9_2_tbl10',   // <-- TAMBAHAN
        'j10_1_tbl10', 'j10_2_tbl10', // <-- TAMBAHAN
];
  

    // ✅ Relation langsung ke Calibration
    public function calibration()
    {
        return $this->belongsTo(Calibration::class);
    }

   
}