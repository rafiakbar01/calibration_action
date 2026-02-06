<?php

namespace App\Http\Controllers;

use App\Models\AlatStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlatStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alatStandards = AlatStandard::orderBy('created_at', 'desc')->get();
        return view('alat_standard.index', compact('alatStandards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaTabel' => 'required|string|max:255',
            'namaStandar' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('alat-standards.index')
                ->withErrors($validator)
                ->withInput();
        }

        AlatStandard::create($request->all());

        return redirect()->route('alat-standards.index')
            ->with('success', 'Alat Standard berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlatStandard $alatStandard)
    {
        $validator = Validator::make($request->all(), [
            'namaTabel' => 'required|string|max:255',
            'namaStandar' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('alat-standards.index')
                ->withErrors($validator)
                ->withInput();
        }

        $alatStandard->update($request->all());

        return redirect()->route('alat-standards.index')
            ->with('success', 'Alat Standard berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlatStandard $alatStandard)
    {
        $alatStandard->delete();

        return redirect()->route('alat-standards.index')
            ->with('success', 'Alat Standard berhasil dihapus.');
    }
}