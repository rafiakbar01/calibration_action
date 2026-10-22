<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // ← TAMBAHKAN INI! (use Facades, bukan class)

class PrinterController extends Controller
{
   public function testConnection(Request $request)
{
    try {
        $pythonPath = '/home/pascalib/virtualenv/paperless.pascalibration.com/3.11/bin/python';
        $scriptPath = base_path('scripts/test_printer.py');
        
        if (!file_exists($scriptPath)) {
            return response()->json([
                'success' => false,
                'message' => 'Script tidak ditemukan'
            ], 500);
        }
        
        // Jalankan dengan output lengkap
        $command = "$pythonPath $scriptPath --json 2>&1";
        $output = shell_exec($command);
        
        // Log raw output untuk debug
        \Illuminate\Support\Facades\Log::info('Raw output: ' . $output);
        
        // Coba parse JSON
        $result = json_decode($output, true);
        
        if ($result && isset($result['success'])) {
            return response()->json($result);
        } else {
            // Kalau bukan JSON, kembalikan raw output
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung',
                'raw_output' => $output
            ], 500);
        }
        
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Test printer error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
    
    public function printTest(Request $request)
    {
        try {
            $data = [
                'calibration_id' => 999,
                'no_label' => 'TEST-' . date('YmdHis'),
                'tanggal' => date('d/m/Y')
            ];
            
            $pythonPath = '/home/pascalib/virtualenv/paperless.pascalibration.com/3.11/bin/python';
            $scriptPath = base_path('scripts/print_label.py');
            $jsonData = json_encode($data);
            
            $command = "$pythonPath $scriptPath " . escapeshellarg($jsonData) . " 2>&1";
            $output = shell_exec($command);
            
            \Illuminate\Support\Facades\Log::info('Print test output: ' . $output);
            
            $result = json_decode($output, true);
            
            if ($result && isset($result['success']) && $result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Print test berhasil!',
                    'data' => $data
                ]);
            } else {
                $errorMsg = $result['message'] ?? 'Print gagal';
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 500);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function printViaNode(Request $request)
{
    try {
        $printerAddress = $request->input('printer_address');
        $text = $request->input('text');
        
        // ✅ PATH LENGKAP KE NODE.JS (PASTIKAN FILE INI ADA)
        $nodePath = '/home/pascalib/paperless.pascalibration.com/node/bin/node';
        
        // ✅ CEK APAKAH FILE NODE ADA
        if (!file_exists($nodePath)) {
            Log::error('Node binary tidak ditemukan di: ' . $nodePath);
            return response()->json([
                'success' => false,
                'message' => 'Node.js tidak ditemukan di server'
            ], 500);
        }
        
        $scriptPath = base_path('print_server/print_node.cjs');
        
        // ✅ CEK APAKAH SCRIPT ADA
        if (!file_exists($scriptPath)) {
            Log::error('Script tidak ditemukan di: ' . $scriptPath);
            return response()->json([
                'success' => false,
                'message' => 'Script print tidak ditemukan'
            ], 500);
        }
        
        $data = [
            'address' => $printerAddress,
            'printer_name' => $request->input('printer_name'),  // ← TAMBAHKAN INI
            'model' => 'B1',
            'text' => $text
        ];
        
        $jsonData = json_encode($data);
        
        // ✅ GUNAKAN PATH LENGKAP, BUKAN HANYA 'node'
        $command = "$nodePath $scriptPath " . escapeshellarg($jsonData) . " 2>&1";
        
        Log::info('Executing command: ' . $command);
        
        $output = shell_exec($command);
        
        Log::info('Raw output: ' . $output);
        
        $result = json_decode($output, true);
        
        if ($result && isset($result['success']) && $result['success']) {
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result['error'] ?? 'Print gagal',
                'raw_output' => $output
            ], 500);
        }
        
    } catch (\Exception $e) {
        Log::error('Print error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


}