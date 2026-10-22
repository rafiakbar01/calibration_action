<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KompetensiTeknisiController extends Controller
{
    public function index()
    {
        if (view()->exists('kompetensi.index')) {
            return view('kompetensi.index');
        }
        
        return view('admin.kompetensi.index', [
            'technicians' => User::where('role', 'teknisi')->get()
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data kompetensi berhasil disimpan.'
        ]);
    }

    public function getTechnicianKompetensi($userId)
    {
        return response()->json([
            'success' => true,
            'user_id' => $userId,
            'data' => []
        ]);
    }
}
