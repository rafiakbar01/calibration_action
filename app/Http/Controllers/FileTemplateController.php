<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileTemplateController extends Controller
{
    /**
     * Tampilkan daftar file dari folder data_approved, data_verified, data_rejected
     */
    public function index(Request $request)
    {
        $search   = $request->get('search', '');
        $category = $request->get('category', 'all'); // all | verified | approved | rejected
        $date     = $request->get('date', ''); // YYYY-MM-DD

        $folders = [
            'verified' => [
                'path'  => public_path('data_verified'),
                'label' => 'Verified',
                'color' => 'primary',
                'icon'  => 'fas fa-check-circle',
                'badge' => 'badge-primary',
            ],
            'approved' => [
                'path'  => public_path('data_approved'),
                'label' => 'Approved',
                'color' => 'success',
                'icon'  => 'fas fa-stamp',
                'badge' => 'badge-success',
            ],
            'rejected' => [
                'path'  => public_path('data_rejected'),
                'label' => 'Rejected',
                'color' => 'danger',
                'icon'  => 'fas fa-times-circle',
                'badge' => 'badge-danger',
            ],
        ];

        $files = [];

        foreach ($folders as $type => $info) {
            if ($category !== 'all' && $category !== $type) {
                continue;
            }

            if (!File::exists($info['path'])) {
                continue;
            }

            $dirFiles = File::files($info['path']);

            foreach ($dirFiles as $file) {
                $filename  = $file->getFilename();
                $extension = strtolower($file->getExtension());

                // Filter hanya file Excel
                if (!in_array($extension, ['xlsx', 'xlsm', 'xls', 'csv'])) {
                    continue;
                }

                // Filter by search
                if ($search && stripos($filename, $search) === false) {
                    continue;
                }

                // Filter by date (YYYY-MM-DD)
                if ($date && date('Y-m-d', $file->getMTime()) !== $date) {
                    continue;
                }

                // Parse nama file: Calibrasi_Caliper_Digital_B21196607_20260521_132420_approved.xlsm
                $parsed = $this->parseFilename($filename, $type);

                $files[] = [
                    'type'          => $type,
                    'label'         => $info['label'],
                    'color'         => $info['color'],
                    'icon'          => $info['icon'],
                    'badge'         => $info['badge'],
                    'filename'      => $filename,
                    'extension'     => $extension,
                    'size'          => $file->getSize(),
                    'size_human'    => $this->formatBytes($file->getSize()),
                    'modified'      => $file->getMTime(),
                    'modified_date' => date('d M Y H:i', $file->getMTime()),
                    'download_url'  => asset($this->getFolderPublicPath($type) . '/' . $filename),
                    'nama_alat'     => $parsed['nama_alat'],
                    'no_seri'       => $parsed['no_seri'],
                    'tanggal'       => $parsed['tanggal'],
                ];
            }
        }

        // Sort by modified date descending (terbaru dulu)
        usort($files, fn($a, $b) => $b['modified'] - $a['modified']);

        // Hitung summary
        $summary = [
            'total'    => count($files),
            'verified' => count(array_filter($files, fn($f) => $f['type'] === 'verified')),
            'approved' => count(array_filter($files, fn($f) => $f['type'] === 'approved')),
            'rejected' => count(array_filter($files, fn($f) => $f['type'] === 'rejected')),
        ];

        return view('file-template.index', compact('files', 'summary', 'search', 'category', 'date'));
    }

    /**
     * Parse nama file untuk mengekstrak info alat
     * Contoh: Calibrasi_Caliper_Digital_B21196607_20260521_132420_approved.xlsm
     *         Calibrasi_Meteran_-_20260522_135125_approved.xlsm
     */
    private function parseFilename(string $filename, string $type): array
    {
        // Hapus ekstensi
        $base = pathinfo($filename, PATHINFO_FILENAME);

        // Hapus suffix _approved / _verified / _rejected di akhir
        $base = preg_replace('/_(approved|verified|rejected)$/i', '', $base);

        // Cari pola timestamp: _YYYYMMDD_HHMMSS
        if (preg_match('/^(.+?)_(\d{8})_(\d{6})$/', $base, $matches)) {
            $namePart  = $matches[1]; // Calibrasi_Caliper_Digital_B21196607 atau Calibrasi_Meteran_-
            $datePart  = $matches[2]; // 20260521
            $timePart  = $matches[3]; // 132420

            // Format tanggal
            $tanggal = date('d M Y H:i', strtotime(
                substr($datePart, 0, 4) . '-' .
                substr($datePart, 4, 2) . '-' .
                substr($datePart, 6, 2) . ' ' .
                substr($timePart, 0, 2) . ':' .
                substr($timePart, 2, 2) . ':' .
                substr($timePart, 4, 2)
            ));

            // Pisahkan nama alat dan no seri dari namePart
            // Contoh: Calibrasi_Caliper_Digital_B21196607
            // Hapus prefix "Calibrasi_"
            $cleanName = preg_replace('/^Calibrasi_/i', '', $namePart);

            // Cek apakah ada no seri (karakter alfanumerik panjang di akhir, seperti B21196607)
            if (preg_match('/^(.+?)_([A-Z0-9]{5,})$/', $cleanName, $nm)) {
                $namaAlat = str_replace('_', ' ', $nm[1]);
                $noSeri   = $nm[2];
            } else {
                // Tidak ada no seri (misal: Meteran_-)
                $namaAlat = str_replace(['_', ' - ', '-'], [' ', ' ', ''], $cleanName);
                $noSeri   = '-';
            }

            return [
                'nama_alat' => trim($namaAlat),
                'no_seri'   => $noSeri,
                'tanggal'   => $tanggal,
            ];
        }

        // Fallback: tampilkan nama file apa adanya
        return [
            'nama_alat' => str_replace('_', ' ', $base),
            'no_seri'   => '-',
            'tanggal'   => '-',
        ];
    }

    /**
     * Kembalikan path public relatif sesuai tipe
     */
    private function getFolderPublicPath(string $type): string
    {
        return match ($type) {
            'verified' => 'data_verified',
            'approved' => 'data_approved',
            'rejected' => 'data_rejected',
            default    => 'data_verified',
        };
    }

    /**
     * Format ukuran file ke KB/MB
     */
    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }
        return $bytes . ' B';
    }

    /**
     * Hapus file template kalibrasi individu
     */
    public function destroy(Request $request, $type, $filename)
    {
        // Cegah directory traversal
        $filename = basename($filename);
        $publicFolder = $this->getFolderPublicPath($type);
        $filePath = public_path($publicFolder . '/' . $filename);

        if (!File::exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan!');
        }

        try {
            File::delete($filePath);

            // Log aktivitas jika didukung
            if (class_exists(\App\Models\ActivityLog::class)) {
                try {
                    \App\Models\ActivityLog::create([
                        'user_id' => auth()->id(),
                        'activity' => 'Menghapus file template kalibrasi (' . ucfirst($type) . '): ' . $filename,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent()
                    ]);
                } catch (\Exception $e) {
                    \Log::warning('Gagal mencatat log aktivitas hapus template kalibrasi: ' . $e->getMessage());
                }
            }

            return back()->with('success', 'File template "' . $filename . '" berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting template kalibrasi: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }

    /**
     * Hapus semua file template kalibrasi berdasarkan kategori
     */
    public function destroyAll(Request $request, $category)
    {
        $folders = [
            'verified' => public_path('data_verified'),
            'approved' => public_path('data_approved'),
            'rejected' => public_path('data_rejected'),
        ];

        $deletedCount = 0;

        try {
            foreach ($folders as $type => $path) {
                if ($category !== 'all' && $category !== $type) {
                    continue;
                }

                if (!File::exists($path)) {
                    continue;
                }

                $dirFiles = File::files($path);
                foreach ($dirFiles as $file) {
                    $filename = $file->getFilename();
                    $extension = strtolower($file->getExtension());

                    // Hapus hanya berkas Excel/dokumen terkait
                    if (in_array($extension, ['xlsx', 'xlsm', 'xls', 'csv'])) {
                        File::delete($file->getRealPath());
                        $deletedCount++;
                    }
                }
            }

            if ($deletedCount === 0) {
                return back()->with('info', 'Tidak ada file untuk dihapus.');
            }

            // Log aktivitas jika didukung
            if (class_exists(\App\Models\ActivityLog::class)) {
                try {
                    \App\Models\ActivityLog::create([
                        'user_id' => auth()->id(),
                        'activity' => 'Menghapus semua (' . $deletedCount . ') file template kalibrasi kategori: ' . ucfirst($category),
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent()
                    ]);
                } catch (\Exception $e) {
                    \Log::warning('Gagal mencatat log aktivitas hapus semua template kalibrasi: ' . $e->getMessage());
                }
            }

            return back()->with('success', 'Berhasil menghapus ' . $deletedCount . ' file template kalibrasi!');
        } catch (\Exception $e) {
            \Log::error('Error deleting all template kalibrasi: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus semua file: ' . $e->getMessage());
        }
    }

    /**
     * Hapus beberapa file template kalibrasi berdasarkan pilihan
     */
    public function destroyMultiple(Request $request)
    {
        $files = $request->input('files'); // Array of 'type::filename'

        if (empty($files) || !is_array($files)) {
            return back()->with('error', 'Tidak ada file yang dipilih untuk dihapus.');
        }

        $deletedCount = 0;
        $failedCount = 0;

        foreach ($files as $fileData) {
            $parts = explode('::', $fileData);
            if (count($parts) !== 2) continue;

            $type = $parts[0];
            $filename = basename($parts[1]);
            
            $publicFolder = $this->getFolderPublicPath($type);
            $filePath = public_path($publicFolder . '/' . $filename);

            if (File::exists($filePath)) {
                try {
                    File::delete($filePath);
                    $deletedCount++;
                } catch (\Exception $e) {
                    $failedCount++;
                    \Log::error('Error deleting template kalibrasi in multiple: ' . $e->getMessage());
                }
            } else {
                $failedCount++;
            }
        }

        if ($deletedCount > 0) {
            // Log aktivitas
            if (class_exists(\App\Models\ActivityLog::class)) {
                try {
                    \App\Models\ActivityLog::create([
                        'user_id' => auth()->id(),
                        'activity' => 'Menghapus ' . $deletedCount . ' file template kalibrasi (Multiple)',
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent()
                    ]);
                } catch (\Exception $e) {
                    \Log::warning('Gagal mencatat log aktivitas hapus multiple template kalibrasi: ' . $e->getMessage());
                }
            }

            $message = 'Berhasil menghapus ' . $deletedCount . ' file template.';
            if ($failedCount > 0) {
                $message .= ' Gagal menghapus ' . $failedCount . ' file lainnya.';
            }
            return back()->with('success', $message);
        }

        return back()->with('error', 'Gagal menghapus file yang dipilih. File mungkin sudah tidak ada.');
    }

    /**
     * Unduh beberapa file template kalibrasi dalam bentuk ZIP
     */
    public function downloadMultiple(Request $request)
    {
        $files = $request->input('files'); // Array of 'type::filename'

        if (empty($files) || !is_array($files)) {
            return back()->with('error', 'Tidak ada file yang dipilih untuk diunduh.');
        }

        $zipFileName = 'Templates_Kalibrasi_' . date('Ymd_His') . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new \ZipArchive;
        if ($zip->open($zipFilePath, \ZipArchive::CREATE) === TRUE) {
            $hasFiles = false;
            foreach ($files as $fileData) {
                $parts = explode('::', $fileData);
                if (count($parts) !== 2) continue;

                $type = $parts[0];
                $filename = basename($parts[1]);
                
                $publicFolder = $this->getFolderPublicPath($type);
                $filePath = public_path($publicFolder . '/' . $filename);

                if (File::exists($filePath)) {
                    $zip->addFile($filePath, $filename);
                    $hasFiles = true;
                }
            }
            $zip->close();

            if ($hasFiles) {
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            } else {
                if (File::exists($zipFilePath)) File::delete($zipFilePath);
                return back()->with('error', 'File fisik tidak ditemukan untuk diunduh.');
            }
        }

        return back()->with('error', 'Gagal membuat file ZIP.');
    }
}
