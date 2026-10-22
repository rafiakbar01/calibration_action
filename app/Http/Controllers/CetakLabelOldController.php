<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakLabelOldController extends Controller
{
    public function index()
    {
        return view('cetak-label-old.index');
    }
}
