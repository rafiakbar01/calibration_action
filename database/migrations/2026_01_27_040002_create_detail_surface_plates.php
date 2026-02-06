<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_surface_plates', function (Blueprint $table) {
            $table->id();
               // FK ke calibration_id di head (yang jadi PK)
            $table->foreignId('calibration_id')
                  ->constrained('calibrations')
                  ->onDelete('cascade');

            $table->decimal('a1_1', 8, 3)->nullable();
            $table->decimal('a1_2', 8, 3)->nullable();
            $table->decimal('a1_3', 8, 3)->nullable();
            $table->decimal('a1_4', 8, 3)->nullable();
            $table->decimal('a2_1', 8, 3)->nullable();
            $table->decimal('a2_2', 8, 3)->nullable();
            $table->decimal('a2_3', 8, 3)->nullable();
            $table->decimal('a2_4', 8, 3)->nullable();
            $table->decimal('a3_1', 8, 3)->nullable();
            $table->decimal('a3_2', 8, 3)->nullable();
            $table->decimal('a3_3', 8, 3)->nullable();
            $table->decimal('a3_4', 8, 3)->nullable();
            $table->decimal('a4_1', 8, 3)->nullable();
            $table->decimal('a4_2', 8, 3)->nullable();
            $table->decimal('a4_3', 8, 3)->nullable();
            $table->decimal('a4_4', 8, 3)->nullable();
            $table->decimal('a5_1', 8, 3)->nullable();
            $table->decimal('a5_2', 8, 3)->nullable();
            $table->decimal('a5_3', 8, 3)->nullable();
            $table->decimal('a5_4', 8, 3)->nullable();
            $table->decimal('a6_1', 8, 3)->nullable();
            $table->decimal('a6_2', 8, 3)->nullable();
            $table->decimal('a6_3', 8, 3)->nullable();
            $table->decimal('a6_4', 8, 3)->nullable();
            $table->decimal('a7_1', 8, 3)->nullable();
            $table->decimal('a7_2', 8, 3)->nullable();
            $table->decimal('a7_3', 8, 3)->nullable();
            $table->decimal('a7_4', 8, 3)->nullable();
            $table->decimal('a8_1', 8, 3)->nullable();
            $table->decimal('a8_2', 8, 3)->nullable();
            $table->decimal('a8_3', 8, 3)->nullable();
            $table->decimal('a8_4', 8, 3)->nullable();
            $table->decimal('a9_1', 8, 3)->nullable();
            $table->decimal('a9_2', 8, 3)->nullable();
            $table->decimal('a9_3', 8, 3)->nullable();
            $table->decimal('a9_4', 8, 3)->nullable();
            $table->decimal('a10_1', 8, 3)->nullable();
            $table->decimal('a10_2', 8, 3)->nullable();
            $table->decimal('a10_3', 8, 3)->nullable();
            $table->decimal('a10_4', 8, 3)->nullable();

            $table->decimal('a1_1_tbl1', 8, 3)->nullable();
            $table->decimal('a1_2_tbl1', 8, 3)->nullable();
            $table->decimal('a2_1_tbl1', 8, 3)->nullable();
            $table->decimal('a2_2_tbl1', 8, 3)->nullable();
            $table->decimal('a3_1_tbl1', 8, 3)->nullable();
            $table->decimal('a3_2_tbl1', 8, 3)->nullable();
            $table->decimal('a4_1_tbl1', 8, 3)->nullable();
            $table->decimal('a4_2_tbl1', 8, 3)->nullable();
            $table->decimal('a5_1_tbl1', 8, 3)->nullable();
            $table->decimal('a5_2_tbl1', 8, 3)->nullable();
            $table->decimal('a6_1_tbl1', 8, 3)->nullable();
            $table->decimal('a6_2_tbl1', 8, 3)->nullable();
            $table->decimal('a7_1_tbl1', 8, 3)->nullable();
            $table->decimal('a7_2_tbl1', 8, 3)->nullable();
            $table->decimal('a8_1_tbl1', 8, 3)->nullable();
            $table->decimal('a8_2_tbl1', 8, 3)->nullable();
            $table->decimal('a9_1_tbl1', 8, 3)->nullable();
            $table->decimal('a9_2_tbl1', 8, 3)->nullable();

            $table->decimal('a1_1_tbl2', 8, 3)->nullable();
            $table->decimal('a1_2_tbl2', 8, 3)->nullable();
            $table->decimal('b1_1_tbl2', 8, 3)->nullable();
            $table->decimal('b1_2_tbl2', 8, 3)->nullable();
            $table->decimal('b2_1_tbl2', 8, 3)->nullable();
            $table->decimal('b2_2_tbl2', 8, 3)->nullable();
            $table->decimal('b3_1_tbl2', 8, 3)->nullable();
            $table->decimal('b3_2_tbl2', 8, 3)->nullable();
            $table->decimal('b4_1_tbl2', 8, 3)->nullable();
            $table->decimal('b4_2_tbl2', 8, 3)->nullable();
            $table->decimal('b5_1_tbl2', 8, 3)->nullable();
            $table->decimal('b5_2_tbl2', 8, 3)->nullable();
            $table->decimal('b6_1_tbl2', 8, 3)->nullable();
            $table->decimal('b6_2_tbl2', 8, 3)->nullable();
            $table->decimal('b7_1_tbl2', 8, 3)->nullable();
            $table->decimal('b7_2_tbl2', 8, 3)->nullable();
            $table->decimal('b8_1_tbl2', 8, 3)->nullable();
            $table->decimal('b8_2_tbl2', 8, 3)->nullable();

            $table->decimal('a1_1_tbl3', 8, 3)->nullable();
            $table->decimal('a1_2_tbl3', 8, 3)->nullable();
            $table->decimal('c1_1_tbl3', 8, 3)->nullable();
            $table->decimal('c1_2_tbl3', 8, 3)->nullable();
            $table->decimal('c2_1_tbl3', 8, 3)->nullable();
            $table->decimal('c2_2_tbl3', 8, 3)->nullable();
            $table->decimal('c3_1_tbl3', 8, 3)->nullable();
            $table->decimal('c3_2_tbl3', 8, 3)->nullable();
            $table->decimal('c4_1_tbl3', 8, 3)->nullable();
            $table->decimal('c4_2_tbl3', 8, 3)->nullable();
            $table->decimal('c5_1_tbl3', 8, 3)->nullable();
            $table->decimal('c5_2_tbl3', 8, 3)->nullable();
            $table->decimal('c6_1_tbl3', 8, 3)->nullable();
            $table->decimal('c6_2_tbl3', 8, 3)->nullable();
            $table->decimal('c7_1_tbl3', 8, 3)->nullable();
            $table->decimal('c7_2_tbl3', 8, 3)->nullable();
            $table->decimal('c8_1_tbl3', 8, 3)->nullable();
            $table->decimal('c8_2_tbl3', 8, 3)->nullable();

            $table->decimal('a1_1_tbl4', 8, 3)->nullable();
            $table->decimal('a1_2_tbl4', 8, 3)->nullable();
            $table->decimal('d1_1_tbl4', 8, 3)->nullable();
            $table->decimal('d1_2_tbl4', 8, 3)->nullable();
            $table->decimal('d2_1_tbl4', 8, 3)->nullable();
            $table->decimal('d2_2_tbl4', 8, 3)->nullable();
            $table->decimal('d3_1_tbl4', 8, 3)->nullable();
            $table->decimal('d3_2_tbl4', 8, 3)->nullable();
            $table->decimal('d4_1_tbl4', 8, 3)->nullable();
            $table->decimal('d4_2_tbl4', 8, 3)->nullable();
            $table->decimal('d5_1_tbl4', 8, 3)->nullable();
            $table->decimal('d5_2_tbl4', 8, 3)->nullable();
            $table->decimal('d6_1_tbl4', 8, 3)->nullable();
            $table->decimal('d6_2_tbl4', 8, 3)->nullable();
            $table->decimal('d7_1_tbl4', 8, 3)->nullable();
            $table->decimal('d7_2_tbl4', 8, 3)->nullable();
            $table->decimal('d8_1_tbl4', 8, 3)->nullable();
            $table->decimal('d8_2_tbl4', 8, 3)->nullable();
        
            $table->decimal('a1_1_tbl5', 8, 3)->nullable();
            $table->decimal('a1_2_tbl5', 8, 3)->nullable();
            $table->decimal('e1_1_tbl5', 8, 3)->nullable();
            $table->decimal('e1_2_tbl5', 8, 3)->nullable();
            $table->decimal('e2_1_tbl5', 8, 3)->nullable();
            $table->decimal('e2_2_tbl5', 8, 3)->nullable();
            $table->decimal('e3_1_tbl5', 8, 3)->nullable();
            $table->decimal('e3_2_tbl5', 8, 3)->nullable();
            $table->decimal('e4_1_tbl5', 8, 3)->nullable();
            $table->decimal('e4_2_tbl5', 8, 3)->nullable();
            $table->decimal('e5_1_tbl5', 8, 3)->nullable();
            $table->decimal('e5_2_tbl5', 8, 3)->nullable();
            $table->decimal('e6_1_tbl5', 8, 3)->nullable();
            $table->decimal('e6_2_tbl5', 8, 3)->nullable();
            $table->decimal('e7_1_tbl5', 8, 3)->nullable();
            $table->decimal('e7_2_tbl5', 8, 3)->nullable();
            $table->decimal('e8_1_tbl5', 8, 3)->nullable();
            $table->decimal('e8_2_tbl5', 8, 3)->nullable();

            $table->decimal('a1_1_tbl6', 8, 3)->nullable();
            $table->decimal('a1_2_tbl6', 8, 3)->nullable();
            $table->decimal('f1_1_tbl6', 8, 3)->nullable();
            $table->decimal('f1_2_tbl6', 8, 3)->nullable();
            $table->decimal('f2_1_tbl6', 8, 3)->nullable();
            $table->decimal('f2_2_tbl6', 8, 3)->nullable();
            $table->decimal('f3_1_tbl6', 8, 3)->nullable();
            $table->decimal('f3_2_tbl6', 8, 3)->nullable();
            $table->decimal('f4_1_tbl6', 8, 3)->nullable();
            $table->decimal('f4_2_tbl6', 8, 3)->nullable();
            $table->decimal('f5_1_tbl6', 8, 3)->nullable();
            $table->decimal('f5_2_tbl6', 8, 3)->nullable();
            $table->decimal('f6_1_tbl6', 8, 3)->nullable();
            $table->decimal('f6_2_tbl6', 8, 3)->nullable();
            $table->decimal('f7_1_tbl6', 8, 3)->nullable();
            $table->decimal('f7_2_tbl6', 8, 3)->nullable();
            $table->decimal('f8_1_tbl6', 8, 3)->nullable();
            $table->decimal('f8_2_tbl6', 8, 3)->nullable();

            $table->decimal('a1_1_tbl7', 8, 3)->nullable();
            $table->decimal('a1_2_tbl7', 8, 3)->nullable();
            $table->decimal('g1_1_tbl7', 8, 3)->nullable();
            $table->decimal('g1_2_tbl7', 8, 3)->nullable();
            $table->decimal('g2_1_tbl7', 8, 3)->nullable();
            $table->decimal('g2_2_tbl7', 8, 3)->nullable();
            $table->decimal('g3_1_tbl7', 8, 3)->nullable();
            $table->decimal('g3_2_tbl7', 8, 3)->nullable();
            $table->decimal('g4_1_tbl7', 8, 3)->nullable();
            $table->decimal('g4_2_tbl7', 8, 3)->nullable();
            $table->decimal('g5_1_tbl7', 8, 3)->nullable();
            $table->decimal('g5_2_tbl7', 8, 3)->nullable();
            $table->decimal('g6_1_tbl7', 8, 3)->nullable();
            $table->decimal('g6_2_tbl7', 8, 3)->nullable();
            $table->decimal('g7_1_tbl7', 8, 3)->nullable();
            $table->decimal('g7_2_tbl7', 8, 3)->nullable();
            $table->decimal('g8_1_tbl7', 8, 3)->nullable();
            $table->decimal('g8_2_tbl7', 8, 3)->nullable();

            $table->decimal('a1_1_tbl8', 8, 3)->nullable();
            $table->decimal('a1_2_tbl8', 8, 3)->nullable();
            $table->decimal('h1_1_tbl8', 8, 3)->nullable();
            $table->decimal('h1_2_tbl8', 8, 3)->nullable();
            $table->decimal('h2_1_tbl8', 8, 3)->nullable();
            $table->decimal('h2_2_tbl8', 8, 3)->nullable();
            $table->decimal('h3_1_tbl8', 8, 3)->nullable();
            $table->decimal('h3_2_tbl8', 8, 3)->nullable();
            $table->decimal('h4_1_tbl8', 8, 3)->nullable();
            $table->decimal('h4_2_tbl8', 8, 3)->nullable();
            $table->decimal('h5_1_tbl8', 8, 3)->nullable();
            $table->decimal('h5_2_tbl8', 8, 3)->nullable();
            $table->decimal('h6_1_tbl8', 8, 3)->nullable();
            $table->decimal('h6_2_tbl8', 8, 3)->nullable();
            $table->decimal('h7_1_tbl8', 8, 3)->nullable();
            $table->decimal('h7_2_tbl8', 8, 3)->nullable();
            $table->decimal('h8_1_tbl8', 8, 3)->nullable();
            $table->decimal('h8_2_tbl8', 8, 3)->nullable();

            $table->decimal('a1_1_tbl9', 8, 3)->nullable();
            $table->decimal('a1_2_tbl9', 8, 3)->nullable();
            $table->decimal('i1_1_tbl9', 8, 3)->nullable();
            $table->decimal('i1_2_tbl9', 8, 3)->nullable();
            $table->decimal('i2_1_tbl9', 8, 3)->nullable();
            $table->decimal('i2_2_tbl9', 8, 3)->nullable();
            $table->decimal('i3_1_tbl9', 8, 3)->nullable();
            $table->decimal('i3_2_tbl9', 8, 3)->nullable();
            $table->decimal('i4_1_tbl9', 8, 3)->nullable();
            $table->decimal('i4_2_tbl9', 8, 3)->nullable();
            $table->decimal('i5_1_tbl9', 8, 3)->nullable();
            $table->decimal('i5_2_tbl9', 8, 3)->nullable();
            $table->decimal('i6_1_tbl9', 8, 3)->nullable();
            $table->decimal('i6_2_tbl9', 8, 3)->nullable();
            $table->decimal('i7_1_tbl9', 8, 3)->nullable();
            $table->decimal('i7_2_tbl9', 8, 3)->nullable();
            $table->decimal('i8_1_tbl9', 8, 3)->nullable();
            $table->decimal('i8_2_tbl9', 8, 3)->nullable();

            $table->decimal('a1_1_tbl10', 8, 3)->nullable();
            $table->decimal('a1_2_tbl10', 8, 3)->nullable();
            $table->decimal('j1_1_tbl10', 8, 3)->nullable();
            $table->decimal('j1_2_tbl10', 8, 3)->nullable();
            $table->decimal('j2_1_tbl10', 8, 3)->nullable();
            $table->decimal('j2_2_tbl10', 8, 3)->nullable();
            $table->decimal('j3_1_tbl10', 8, 3)->nullable();
            $table->decimal('j3_2_tbl10', 8, 3)->nullable();
            $table->decimal('j4_1_tbl10', 8, 3)->nullable();
            $table->decimal('j4_2_tbl10', 8, 3)->nullable();
            $table->decimal('j5_1_tbl10', 8, 3)->nullable();
            $table->decimal('j5_2_tbl10', 8, 3)->nullable();
            $table->decimal('j6_1_tbl10', 8, 3)->nullable();
            $table->decimal('j6_2_tbl10', 8, 3)->nullable();
            $table->decimal('j7_1_tbl10', 8, 3)->nullable();
            $table->decimal('j7_2_tbl10', 8, 3)->nullable();
            $table->decimal('j8_1_tbl10', 8, 3)->nullable();
            $table->decimal('j8_2_tbl10', 8, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surface_plates');
    }
};
