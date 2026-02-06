<?php

namespace App\Http\Controllers;

use App\Models\CalibrationMethod;
use Illuminate\Http\Request;

class CalibrationMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $methods = CalibrationMethod::orderBy('nama_alat')->paginate(10);
        
        // Jika ada parameter action, tampilkan form
        if (request()->has('action')) {
            $action = request('action');
            $method = null;
            
            if (request()->has('id')) {
                $method = CalibrationMethod::find(request('id'));
            }
            
            return view('calibration-methods.index', compact('methods', 'action', 'method'));
        }
        
        return view('calibration-methods.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('calibration-methods.index', ['action' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'metode_kalibrasi' => 'required|string',
        ]);

        try {
            CalibrationMethod::create([
                'nama_alat' => $request->nama_alat,
                'metode_kalibrasi' => $request->metode_kalibrasi,
                'created_by' => auth()->user()->nama,
            ]);

            return redirect()->route('calibration-methods.index')
                ->with('success', 'Metode kalibrasi berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->route('calibration-methods.index', ['action' => 'create'])
                ->with('error', 'Gagal menambahkan metode kalibrasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return redirect()->route('calibration-methods.index', ['action' => 'show', 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return redirect()->route('calibration-methods.index', ['action' => 'edit', 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $method = CalibrationMethod::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'metode_kalibrasi' => 'required|string',
        ]);

        try {
            $method->update([
                'nama_alat' => $request->nama_alat,
                'metode_kalibrasi' => $request->metode_kalibrasi,
                'updated_by' => auth()->user()->nama,
            ]);

            return redirect()->route('calibration-methods.index')
                ->with('success', 'Metode kalibrasi berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->route('calibration-methods.index', ['action' => 'edit', 'id' => $id])
                ->with('error', 'Gagal memperbarui metode kalibrasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $method = CalibrationMethod::findOrFail($id);
            $method->delete();

            return redirect()->route('calibration-methods.index')
                ->with('success', 'Metode kalibrasi berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('calibration-methods.index')
                ->with('error', 'Gagal menghapus metode kalibrasi: ' . $e->getMessage());
        }
    }
}