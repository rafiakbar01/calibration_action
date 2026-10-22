<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabelDesignController extends Controller
{
    public function index()
    {
        return view('label-design');
    }
}