<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Ambil daftar unique activity_type untuk filter
        $aksiList = ActivityLog::select('activity_type')
            ->distinct()
            ->orderBy('activity_type')
            ->pluck('activity_type')
            ->toArray();
        
        // Tambahkan tipe aktivitas baru jika belum ada
        $newActivityTypes = [
            'select_form', 'scan_qr_success', 'scan_qr_failed', 'scan_result',
            'auto_fill_success', 'auto_fill_failed', 'load_form', 'create_tab',
            'delete_tab', 'change_tab', 'search_alat', 'save_calibration',
            'save_calibration_failed', 'page_access', 'speed_test'
        ];
        
        foreach ($newActivityTypes as $type) {
            if (!in_array($type, $aksiList)) {
                $aksiList[] = $type;
            }
        }
        sort($aksiList);
        
        // Ambil daftar user untuk filter
        $userList = User::orderBy('nama')->get();
        
        return view('log-kalibrasi.index', compact('aksiList', 'userList'));
    }

    public function getData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'created_at',
            2 => 'activity_type',
            3 => 'description',
            4 => 'logable_type',
            5 => 'logable_id',
            6 => 'performed_by',
            7 => 'ip_address',
        ];

        $query = ActivityLog::with('performer');

        // Filter berdasarkan activity_type
        if ($request->has('activity_type') && $request->activity_type != '') {
            $query->where('activity_type', $request->activity_type);
        }
        
        // Filter berdasarkan user
        if ($request->has('performed_by') && $request->performed_by != '') {
            $query->where('performed_by', $request->performed_by);
        }
        
        // Filter berdasarkan ID Model (logable_id)
        if ($request->has('logable_id') && $request->logable_id != '') {
            $logableIdVal = ltrim(trim($request->logable_id), '#');
            $query->where('logable_id', 'like', '%' . $logableIdVal . '%');
        }
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal_dari') && $request->tanggal_dari != '') {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai') && $request->tanggal_sampai != '') {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        // Search
        $search = $request->input('search.value');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('activity_type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('logable_type', 'like', "%{$search}%")
                  ->orWhere('logable_id', 'like', "%{$search}%")
                  ->orWhere('metadata', 'like', "%{$search}%")
                  ->orWhereHas('performer', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Total records
        $totalData = $query->count();
        
        // Ordering
        $orderColumn = $columns[$request->input('order.0.column')] ?? 'created_at';
        $orderDir = $request->input('order.0.dir', 'desc');
        $query->orderBy($orderColumn, $orderDir);
        
        // Pagination
        $start = $request->input('start', 0);
        $length = $request->input('length', 15);
        
        $logs = $query->skip($start)->take($length)->get();
        
        $data = [];
        foreach ($logs as $log) {
            // Tentukan badge color berdasarkan activity_type
            $badgeColor = match($log->activity_type) {
                'create' => 'success',
                'update' => 'warning',
                'delete' => 'danger',
                'login' => 'info',
                'logout' => 'secondary',
                // Aktivitas baru
                'select_form' => 'primary',
                'scan_qr_success' => 'success',
                'scan_qr_failed' => 'danger',
                'scan_result' => 'info',
                'auto_fill_success' => 'success',
                'auto_fill_failed' => 'danger',
                'load_form' => 'primary',
                'create_tab' => 'success',
                'delete_tab' => 'danger',
                'change_tab' => 'warning',
                'search_alat' => 'info',
                'save_calibration' => 'success',
                'save_calibration_failed' => 'danger',
                'page_access' => 'secondary',
                'speed_test' => 'info',
                default => 'secondary'
            };
            
            // Format model name
            $modelName = class_basename($log->logable_type) ?: '-';
            
            // Format logable_id link jika terkait dengan kalibrasi
            $modelId = '-';
            if ($log->logable_id) {
                if ($log->logable_type === 'App\Models\Calibration') {
                    $modelId = '<a href="' . route('calibrations.show', $log->logable_id) . '" class="text-decoration-none">#' . $log->logable_id . '</a>';
                } else {
                    $modelId = '#' . $log->logable_id;
                }
            }
            
            // Format icon untuk activity_type
            $icon = $this->getActivityIcon($log->activity_type);
            
            $data[] = [
                'checkbox' => '<input type="checkbox" class="row-checkbox" data-id="' . $log->id . '">',
                'created_at' => $log->created_at->format('d/m/Y H:i:s'),
                'activity_type' => '<span class="badge bg-' . $badgeColor . '">' . $icon . ' ' . $this->formatActivityType($log->activity_type) . '</span>',
                'description' => e($log->description),
                'logable_type' => $modelName,
                'logable_id' => $modelId,
                'performer' => e($log->performer->nama ?? 'System'),
                'ip_address' => e($log->ip_address ?? '-'),
                'action' => '<a href="' . route('activity-logs.show', $log->id) . '" class="btn btn-info btn-sm" title="Detail Log"><i class="fas fa-eye"></i></a>'
            ];
        }
        
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data
        ]);
    }

    public function export(Request $request)
    {
        $query = ActivityLog::with('performer');

        // Filter berdasarkan activity_type
        if ($request->has('activity_type') && $request->activity_type != '') {
            $query->where('activity_type', $request->activity_type);
        }
        
        // Filter berdasarkan user
        if ($request->has('performed_by') && $request->performed_by != '') {
            $query->where('performed_by', $request->performed_by);
        }
        
        // Filter berdasarkan ID Model (logable_id)
        if ($request->has('logable_id') && $request->logable_id != '') {
            $logableIdVal = ltrim(trim($request->logable_id), '#');
            $query->where('logable_id', 'like', '%' . $logableIdVal . '%');
        }
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal_dari') && $request->tanggal_dari != '') {
            $query->whereDate('created_at', '>=', $request->tanggal_dari);
        }
        if ($request->has('tanggal_sampai') && $request->tanggal_sampai != '') {
            $query->whereDate('created_at', '<=', $request->tanggal_sampai);
        }

        // Search dari input DataTable
        $search = $request->input('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('activity_type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('logable_type', 'like', "%{$search}%")
                  ->orWhere('logable_id', 'like', "%{$search}%")
                  ->orWhere('metadata', 'like', "%{$search}%")
                  ->orWhereHas('performer', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting by newest
        $query->orderBy('created_at', 'desc');

        $logs = $query->get();

        // Create Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set document properties
        $spreadsheet->getProperties()->setCreator('PAS Calibration Paperless')
            ->setLastModifiedBy('PAS Calibration Paperless')
            ->setTitle('Export Log Aktivitas')
            ->setSubject('Log Aktivitas Kalibrasi')
            ->setDescription('Log Aktivitas Kalibrasi Sistem Paperless.');

        // Header style
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1D4ED8'], // Royal Blue
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '1E3A8A'],
                ],
            ],
        ];

        // Column headers
        $headers = ['Waktu', 'Aksi', 'Deskripsi', 'Tipe Model', 'ID Model', 'User', 'IP Address'];
        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $sheet->getColumnDimension($column)->setAutoSize(true);
            $column++;
        }
        $sheet->getRowDimension('1')->setRowHeight(28);
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // Content
        $rowNumber = 2;
        foreach ($logs as $log) {
            $modelName = class_basename($log->logable_type) ?: '-';
            $modelId = $log->logable_id ? '#' . $log->logable_id : '-';
            $performer = $log->performer->nama ?? 'System';
            $formattedType = $this->formatActivityType($log->activity_type);

            $sheet->setCellValue('A' . $rowNumber, $log->created_at->format('d/m/Y H:i:s'));
            $sheet->setCellValue('B' . $rowNumber, $formattedType);
            $sheet->setCellValue('C' . $rowNumber, $log->description);
            $sheet->setCellValue('D' . $rowNumber, $modelName);
            $sheet->setCellValue('E' . $rowNumber, $modelId);
            $sheet->setCellValue('F' . $rowNumber, $performer);
            $sheet->setCellValue('G' . $rowNumber, $log->ip_address ?? '-');

            // Zebra striping
            if ($rowNumber % 2 == 0) {
                $sheet->getStyle('A' . $rowNumber . ':G' . $rowNumber)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F8FAFC');
            }

            // Alignments
            $sheet->getStyle('A' . $rowNumber)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $rowNumber)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('E' . $rowNumber)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G' . $rowNumber)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $rowNumber++;
        }

        // Set borders for data rows
        $dataBorderStyle = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'E2E8F0'],
                ],
            ],
        ];
        if ($rowNumber > 2) {
            $sheet->getStyle('A2:G' . ($rowNumber - 1))->applyFromArray($dataBorderStyle);
        }

        $fileName = 'activity_logs_export_' . date('Ymd_His') . '.xlsx';

        // Redirect output to a client’s web browser (Xlsx)
        return response()->streamDownload(function() use ($spreadsheet) {
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function show($id)
    {
        $log = ActivityLog::with('performer')->findOrFail($id);
        
        // Decode metadata jika ada
        $metadata = $log->metadata ?? [];
        if (is_string($metadata)) {
            $metadata = json_decode($metadata, true);
        }
        
        return view('log-kalibrasi.show', compact('log', 'metadata'));
    }
    
    /**
     * API endpoint untuk menerima log dari client-side (JavaScript)
     */
    public function logActivity(Request $request)
    {
        $validated = $request->validate([
            'event' => 'required|string',
            'data' => 'nullable|array'
        ]);

        $event = $validated['event'];
        $data = $validated['data'] ?? [];
        $user = auth()->user();
        
        // Tambahkan user info ke metadata
        $data['user_id'] = $user->id ?? null;
        $data['user_name'] = $user->name ?? 'Guest';
        
        switch ($event) {
            case 'select_form':
                return $this->logSelectForm($data);
            case 'start_scan':
                return $this->logStartScan($data);
            case 'scan_success':
                return $this->logScanSuccess($data);
            case 'scan_failed':
                return $this->logScanFailed($data);
            case 'auto_fill_form':
                return $this->logAutoFill($data);
            case 'load_form':
                return $this->logLoadForm($data);
            case 'create_tab':
                return $this->logCreateTab($data);
            case 'delete_tab':
                return $this->logDeleteTab($data);
            case 'change_tab':
                return $this->logChangeTab($data);
            case 'save_calibration':
                return $this->logSaveCalibration($data);
            default:
                return $this->logGeneric($event, $data);
        }
    }
    
    /**
     * Log user memilih form
     */
    private function logSelectForm($data)
    {
        $tabId    = $data['tab_id'] ?? null;
        $formType = $data['form_type'] ?? '-';
        $formName = $data['form_name'] ?? '-';
        $metode   = $data['metode'] ?? 'manual';
        $namaAlat = $data['nama_alat'] ?? null;
        $noSeri   = $data['no_seri'] ?? null;
        $qrId     = $data['qr_code_id'] ?? null;

        // Bangun deskripsi yang informatif
        if ($metode === 'qrcode') {
            $desc = "📷 Scan QR Code → Form: {$formName} ({$formType})";
            if ($namaAlat) $desc .= " | Alat: {$namaAlat}";
            if ($noSeri)   $desc .= " | No. Seri: {$noSeri}";
            if ($qrId)     $desc .= " | QR ID: {$qrId}";
        } else {
            $desc = "🖱️ Pilih Manual → Form: {$formName} ({$formType})";
        }
        if ($tabId) $desc .= " | Tab: {$tabId}";

        ActivityLog::create([
            'activity_type' => 'select_form',
            'description'   => $desc,
            'logable_type'  => null,
            'logable_id'    => null,
            'old_data'      => null,
            'new_data'      => null,
            'performed_by'  => auth()->id(),
            'ip_address'    => request()->ip(),
            'user_agent'    => request()->userAgent(),
            'method'        => request()->method(),
            'url'           => request()->fullUrl(),
            'metadata'      => $data,
            'batch_uuid'    => session()->get('activity_batch_id'),
        ]);

        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log mulai scan
     */
    private function logStartScan($data)
    {
        ActivityLog::create([
            'activity_type' => 'start_scan',
            'description' => "Memulai scan QR pada tab {$data['tab_id']}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log scan berhasil
     */
    private function logScanSuccess($data)
    {
        ActivityLog::create([
            'activity_type' => 'scan_qr_success',
            'description' => "Scan QR Code berhasil: {$data['qr_code']} pada tab {$data['tab_id']}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log scan gagal
     */
    private function logScanFailed($data)
    {
        ActivityLog::create([
            'activity_type' => 'scan_qr_failed',
            'description' => "Scan QR Code gagal: {$data['qr_code']} pada tab {$data['tab_id']} - {$data['error']}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log autofill form
     */
    private function logAutoFill($data)
    {
        ActivityLog::create([
            'activity_type' => 'auto_fill_success',
            'description' => "Auto-fill form berhasil: {$data['nama_alat']} pada tab {$data['tab_id']}, {$data['filled_count']} field terisi",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log load form
     */
    private function logLoadForm($data)
    {
        ActivityLog::create([
            'activity_type' => 'load_form',
            'description' => "Load form {$data['form_type']} ke tab {$data['tab_id']}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log create tab
     */
    private function logCreateTab($data)
    {
        $description = "Membuat tab baru: {$data['tab_id']}";
        if (isset($data['form_type'])) {
            $description .= " dengan form {$data['form_type']}";
        }
        
        ActivityLog::create([
            'activity_type' => 'create_tab',
            'description' => $description,
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log delete tab
     */
    private function logDeleteTab($data)
    {
        ActivityLog::create([
            'activity_type' => 'delete_tab',
            'description' => "Menghapus tab: {$data['tab_id']}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log change tab
     */
    private function logChangeTab($data)
    {
        ActivityLog::create([
            'activity_type' => 'change_tab',
            'description' => "Pindah tab dari {$data['old_tab_id']} ke {$data['new_tab_id']}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log save calibration
     */
    private function logSaveCalibration($data)
    {
        ActivityLog::create([
            'activity_type' => 'save_calibration',
            'description' => "Menyimpan data kalibrasi: {$data['nama_alat']} (ID: {$data['calibration_id']}) dari tab {$data['tab_id']}",
            'logable_type' => 'App\Models\Calibration',
            'logable_id' => $data['calibration_id'] ?? null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Log generic untuk event lain
     */
    private function logGeneric($event, $data)
    {
        ActivityLog::create([
            'activity_type' => $event,
            'description' => "Event: {$event}",
            'logable_type' => null,
            'logable_id' => null,
            'old_data' => null,
            'new_data' => null,
            'performed_by' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'metadata' => $data,
            'batch_uuid' => session()->get('activity_batch_id'),
        ]);
        
        return response()->json(['status' => 'logged']);
    }
    
    /**
     * Get icon untuk activity type
     */
    private function getActivityIcon($type)
    {
        return match($type) {
            'create' => '<i class="fas fa-plus-circle"></i>',
            'update' => '<i class="fas fa-edit"></i>',
            'delete' => '<i class="fas fa-trash-alt"></i>',
            'login' => '<i class="fas fa-sign-in-alt"></i>',
            'logout' => '<i class="fas fa-sign-out-alt"></i>',
            'select_form' => '<i class="fas fa-hand-pointer"></i>',
            'scan_qr_success', 'scan_result' => '<i class="fas fa-qrcode"></i>',
            'scan_qr_failed' => '<i class="fas fa-exclamation-triangle"></i>',
            'auto_fill_success' => '<i class="fas fa-magic"></i>',
            'auto_fill_failed' => '<i class="fas fa-times-circle"></i>',
            'load_form' => '<i class="fas fa-file-alt"></i>',
            'create_tab' => '<i class="fas fa-plus-square"></i>',
            'delete_tab' => '<i class="fas fa-minus-square"></i>',
            'change_tab' => '<i class="fas fa-exchange-alt"></i>',
            'search_alat' => '<i class="fas fa-search"></i>',
            'save_calibration' => '<i class="fas fa-save"></i>',
            'page_access' => '<i class="fas fa-globe"></i>',
            'speed_test' => '<i class="fas fa-tachometer-alt"></i>',
            default => '<i class="fas fa-info-circle"></i>'
        };
    }
    
    /**
     * Format activity type untuk display
     */
    private function formatActivityType($type)
    {
        $formats = [
            'select_form' => 'Pilih Form',
            'scan_qr_success' => 'Scan QR Sukses',
            'scan_qr_failed' => 'Scan QR Gagal',
            'scan_result' => 'Hasil Scan',
            'auto_fill_success' => 'Auto Fill Sukses',
            'auto_fill_failed' => 'Auto Fill Gagal',
            'load_form' => 'Load Form',
            'create_tab' => 'Buat Tab',
            'delete_tab' => 'Hapus Tab',
            'change_tab' => 'Ganti Tab',
            'search_alat' => 'Cari Alat',
            'save_calibration' => 'Simpan Kalibrasi',
            'save_calibration_failed' => 'Gagal Simpan',
            'page_access' => 'Akses Halaman',
            'speed_test' => 'Speed Test Internet',
        ];
        
        return $formats[$type] ?? ucfirst(str_replace('_', ' ', $type));
    }
    
    /**
     * Hapus multiple activity logs
     */
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:activity_logs,id'
        ]);
        
        try {
            $ids = $request->ids;
            $deletedCount = ActivityLog::whereIn('id', $ids)->delete();
            
            return response()->json([
                'success' => true,
                'message' => "Berhasil menghapus {$deletedCount} log aktivitas.",
                'deleted_count' => $deletedCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}