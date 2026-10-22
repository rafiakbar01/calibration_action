<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SertifikatKalibrasiController extends Controller
{
    /**
     * Dapatkan path root untuk penyimpanan sertifikat di public/sertifikat_kalibrasi_digital
     */
    private function basePath(): string
    {
        $path = public_path('sertifikat_kalibrasi_digital');
        if (!file_exists($path)) {
            @mkdir($path, 0775, true);
        }
        return $path;
    }

    /**
     * Dapatkan path absolut yang aman dari traversal directory
     */
    private function safePath(?string $folder = ''): string
    {
        $folder = $folder ?? '';
        $base = rtrim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $this->basePath()), '/\\');
        if ($folder === '') {
            return $base;
        }

        // Bersihkan path traversal (..)
        $folder = str_replace(['..', './', '.\\'], '', $folder);
        $folder = trim(str_replace('\\', '/', $folder), '/');

        $parts = array_filter(explode('/', $folder), fn($p) => $p !== '');
        $subPath = implode(DIRECTORY_SEPARATOR, $parts);

        $fullPath = $subPath ? $base . DIRECTORY_SEPARATOR . $subPath : $base;

        // Normalisasi separator
        $normFullPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullPath);
        $normBase = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $base);

        // Validasi double check path tetap di dalam base directory (case-insensitive di Windows)
        if (DIRECTORY_SEPARATOR === '\\') {
            if (stripos($normFullPath, $normBase) !== 0) {
                abort(403, 'Akses ditolak (di luar direktori yang diizinkan).');
            }
        } else {
            if (strpos($normFullPath, $normBase) !== 0) {
                abort(403, 'Akses ditolak (di luar direktori yang diizinkan).');
            }
        }

        return $fullPath;
    }

    // ─── Controller Actions ──────────────────────────────────────────────────

    /**
     * Tampilkan daftar file & folder lokal
     */
    public function index(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $folder = $request->get('folder', '') ?? '';
        $search = $request->get('search', '') ?? '';

        $folders = [];
        $files   = [];
        $error   = null;

        try {
            $path = $this->safePath($folder);

            // Auto-create folder jika belum ada
            if (!file_exists($path)) {
                @mkdir($path, 0775, true);
            }

            if (!is_dir($path)) {
                $error = 'Folder tidak ditemukan.';
            } else {
                $items = @scandir($path);
                if ($items === false) {
                    $error = 'Gagal membaca isi folder.';
                } else {
                    foreach ($items as $item) {
                        if ($item === '.' || $item === '..') continue;

                        $fullPath = $path . DIRECTORY_SEPARATOR . $item;

                        if (is_dir($fullPath)) {
                            if ($search && stripos($item, $search) === false) continue;
                            
                            // Hitung file PDF di dalam subfolder
                            $subItems = @scandir($fullPath);
                            $fileCount = 0;
                            if ($subItems !== false) {
                                foreach ($subItems as $subItem) {
                                    if ($subItem === '.' || $subItem === '..') continue;
                                    $subItemPath = $fullPath . DIRECTORY_SEPARATOR . $subItem;
                                    if (is_file($subItemPath) && strtolower(pathinfo($subItem, PATHINFO_EXTENSION)) === 'pdf') {
                                        $fileCount++;
                                    }
                                }
                            }
                            
                            $folders[] = [
                                'name'          => $item,
                                'folder_path'   => trim(($folder ? $folder . '/' : '') . $item, '/'),
                                'modified'      => @filemtime($fullPath),
                                'modified_date' => @filemtime($fullPath) ? date('d M Y H:i', @filemtime($fullPath)) : '-',
                                'file_count'    => $fileCount,
                            ];
                        } elseif (is_file($fullPath) && strtolower(pathinfo($item, PATHINFO_EXTENSION)) === 'pdf') {
                            if ($search && stripos($item, $search) === false) continue;

                            $size = @filesize($fullPath) ?: 0;
                            $files[] = [
                                'name'          => $item,
                                'folder'        => $folder,
                                'size'          => $size,
                                'size_human'    => $this->formatBytes($size),
                                'modified'      => @filemtime($fullPath),
                                'modified_date' => @filemtime($fullPath) ? date('d M Y H:i', @filemtime($fullPath)) : '-',
                            ];
                        }
                    }

                    // Urutkan folder abjad, file berdasarkan modifikasi terbaru
                    usort($folders, fn($a, $b) => strcmp($a['name'], $b['name']));
                    usort($files,   fn($a, $b) => $b['modified'] - $a['modified']);
                }
            }
        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi index error: ' . $e->getMessage());
            $error = 'Terjadi kesalahan: ' . $e->getMessage();
        }

        $breadcrumbs = $this->buildBreadcrumbs($folder);
        
        // Diagnostic data agar tidak memicu error di view blade (Direct Mode)
        $diagnostic = [
            'bridge_url'  => 'Direct Storage (public/sertifikat_kalibrasi_digital)',
            'configured'  => true,
            'bridge_info' => [
                'success' => true,
                'bridge' => 'Direct cPanel Storage',
                'base_path' => $this->basePath(),
                'accessible' => is_writable($this->basePath()),
                'php_user' => get_current_user(),
                'os' => PHP_OS,
            ],
        ];

        return view('sertifikat-kalibrasi.index', compact(
            'folders', 'files', 'folder', 'search', 'breadcrumbs', 'error', 'diagnostic'
        ));
    }

    /**
     * Download file PDF langsung dari server
     */
    public function download(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $folder   = $request->get('folder', '');
        $filename = $request->get('file', '');

        if (!$filename || strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'pdf') {
            abort(400, 'Hanya file PDF yang dapat didownload.');
        }

        try {
            $path = $this->safePath($folder);
            $filePath = $path . DIRECTORY_SEPARATOR . basename($filename);

            if (!is_file($filePath)) {
                abort(404, 'File tidak ditemukan.');
            }

            if ($request->get('inline') == 1) {
                $this->logActivity('Lihat sertifikat: ' . ($folder ? $folder . '/' : '') . $filename, $request);
                return response()->file($filePath, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($filename) . '"'
                ]);
            }

            $this->logActivity('Download sertifikat: ' . ($folder ? $folder . '/' : '') . $filename, $request);

            return response()->download($filePath, $filename, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . basename($filename) . '"'
            ]);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi download error: ' . $e->getMessage());
            abort(500, 'Gagal mendownload file: ' . $e->getMessage());
        }
    }

    /**
     * Handle Upload File PDF ke folder aktif
     */
    public function upload(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $request->validate([
            'folder' => 'nullable|string',
            'file'   => 'required|file|mimes:pdf|max:20480', // Maksimal 20MB
        ]);

        try {
            $folder = $request->get('folder', '');
            $path = $this->safePath($folder);

            if (!is_dir($path)) {
                return response()->json(['success' => false, 'message' => 'Folder tujuan tidak ditemukan.'], 404);
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            
            // Sanitasi nama file
            $filename = preg_replace('/[<>:"\/\\\\|?*]/', '', $originalName);
            if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'pdf') {
                $filename .= '.pdf';
            }

            $destPath = $path . DIRECTORY_SEPARATOR . $filename;
            
            // Jika file dengan nama yang sama sudah ada, tambahkan suffix angka
            if (file_exists($destPath)) {
                $nameOnly = pathinfo($filename, PATHINFO_FILENAME);
                $counter = 1;
                while (file_exists($path . DIRECTORY_SEPARATOR . $nameOnly . '_' . $counter . '.pdf')) {
                    $counter++;
                }
                $filename = $nameOnly . '_' . $counter . '.pdf';
            }

            $file->move($path, $filename);

            $this->logActivity('Upload sertifikat: ' . ($folder ? $folder . '/' : '') . $filename, $request);

            return response()->json([
                'success' => true,
                'message' => "File '{$filename}' berhasil di-upload."
            ]);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus file PDF dari server
     */
    public function destroyFile(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $folder   = $request->get('folder', '');
        $filename = $request->get('file', '');

        if (!$filename || strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'pdf') {
            return response()->json(['success' => false, 'message' => 'Hanya file PDF yang dapat dihapus.'], 400);
        }

        try {
            $path = $this->safePath($folder);
            $filePath = $path . DIRECTORY_SEPARATOR . basename($filename);

            if (!is_file($filePath)) {
                return response()->json(['success' => false, 'message' => 'File tidak ditemukan.'], 404);
            }

            if (@unlink($filePath)) {
                $this->logActivity('Hapus sertifikat: ' . $filename, $request);
                return response()->json(['success' => true, 'message' => "File '{$filename}' berhasil dihapus."]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal menghapus file dari storage.'], 500);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi destroyFile error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Rename file PDF
     */
    public function renameFile(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $request->validate([
            'folder'   => 'nullable|string',
            'old_name' => 'required|string',
            'new_name' => 'required|string|max:255',
        ]);

        try {
            $folder = $request->get('folder', '');
            $path = $this->safePath($folder);
            
            $oldName = basename($request->get('old_name'));
            $newName = basename($request->get('new_name'));

            // Sanitasi nama baru
            $newName = preg_replace('/[<>:"\/\\\\|?*]/', '', $newName);
            if (strtolower(pathinfo($newName, PATHINFO_EXTENSION)) !== 'pdf') {
                $newName .= '.pdf';
            }

            $oldPath = $path . DIRECTORY_SEPARATOR . $oldName;
            $newPath = $path . DIRECTORY_SEPARATOR . $newName;

            if (!file_exists($oldPath)) {
                return response()->json(['success' => false, 'message' => 'File lama tidak ditemukan.'], 404);
            }
            if (file_exists($newPath)) {
                return response()->json(['success' => false, 'message' => 'Nama file tersebut sudah digunakan.'], 409);
            }

            if (@rename($oldPath, $newPath)) {
                $this->logActivity('Rename file sertifikat: ' . $oldName . ' → ' . $newName, $request);
                return response()->json(['success' => true, 'message' => "Ubah nama berhasil: '{$oldName}' → '{$newName}'", 'new_name' => $newName]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal mengubah nama file.'], 500);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi renameFile error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Pindahkan file PDF ke folder target (Drag & Drop)
     */
    public function moveFile(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $request->validate([
            'file'           => 'required|string',
            'current_folder' => 'nullable|string',
            'target_folder'  => 'nullable|string',
        ]);

        try {
            $filename = basename($request->get('file'));
            if (strtolower(pathinfo($filename, PATHINFO_EXTENSION)) !== 'pdf') {
                return response()->json(['success' => false, 'message' => 'Hanya file PDF yang dapat dipindahkan.'], 400);
            }

            $currentFolder = $request->get('current_folder', '') ?? '';
            $targetFolder  = $request->get('target_folder');

            $sourcePath = $this->safePath($currentFolder) . DIRECTORY_SEPARATOR . $filename;
            $targetDir  = $this->safePath($targetFolder);
            $targetPath = $targetDir . DIRECTORY_SEPARATOR . $filename;

            if (!is_file($sourcePath)) {
                return response()->json(['success' => false, 'message' => 'File sumber tidak ditemukan.'], 404);
            }
            if (!is_dir($targetDir)) {
                return response()->json(['success' => false, 'message' => 'Folder tujuan tidak ditemukan.'], 404);
            }

            // Jika folder asal dan tujuan sama
            if ($sourcePath === $targetPath) {
                return response()->json(['success' => false, 'message' => 'Folder asal dan tujuan sama.'], 400);
            }

            // Jika di folder tujuan sudah ada file dengan nama yang sama, tambahkan suffix angka
            if (file_exists($targetPath)) {
                $nameOnly = pathinfo($filename, PATHINFO_FILENAME);
                $counter = 1;
                while (file_exists($targetDir . DIRECTORY_SEPARATOR . $nameOnly . '_' . $counter . '.pdf')) {
                    $counter++;
                }
                $filename = $nameOnly . '_' . $counter . '.pdf';
                $targetPath = $targetDir . DIRECTORY_SEPARATOR . $filename;
            }

            if (@rename($sourcePath, $targetPath)) {
                $this->logActivity("Pindahkan sertifikat: {$filename} ke folder {$targetFolder}", $request);
                return response()->json([
                    'success' => true, 
                    'message' => "Berhasil memindahkan file ke folder '{$targetFolder}'."
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal memindahkan file.'], 500);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi moveFile error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Rename folder
     */
    public function renameFolder(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $request->validate([
            'parent_folder' => 'nullable|string',
            'old_name'      => 'required|string',
            'new_name'      => 'required|string|max:100',
        ]);

        try {
            $parent = $request->get('parent_folder', '');
            $path = $this->safePath($parent);
            
            $oldName = basename($request->get('old_name'));
            $newName = basename($request->get('new_name'));

            $newName = preg_replace('/[<>:"\/\\\\|?*]/', '', $newName);
            $newName = trim($newName);

            if (empty($newName)) {
                return response()->json(['success' => false, 'message' => 'Nama folder baru tidak valid.'], 400);
            }

            $oldPath = $path . DIRECTORY_SEPARATOR . $oldName;
            $newPath = $path . DIRECTORY_SEPARATOR . $newName;

            if (!is_dir($oldPath)) {
                return response()->json(['success' => false, 'message' => 'Folder asal tidak ditemukan.'], 404);
            }
            if (file_exists($newPath)) {
                return response()->json(['success' => false, 'message' => 'Nama folder sudah digunakan.'], 409);
            }

            if (@rename($oldPath, $newPath)) {
                $this->logActivity('Rename folder sertifikat: ' . $oldName . ' → ' . $newName, $request);
                return response()->json(['success' => true, 'message' => "Ubah nama folder berhasil: '{$oldName}' → '{$newName}'"]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal mengubah nama folder.'], 500);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi renameFolder error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Hapus folder (hanya jika folder kosong)
     */
    public function destroyFolder(Request $request)
    {
        canOrFail('super admin,checker,approver');

        try {
            $parent = $request->get('parent_folder', '');
            $folderName = basename($request->get('folder_name', ''));
            
            $path = $this->safePath($parent);
            $folderPath = $path . DIRECTORY_SEPARATOR . $folderName;

            if (!is_dir($folderPath)) {
                return response()->json(['success' => false, 'message' => 'Folder tidak ditemukan.'], 404);
            }

            // Folder harus kosong
            $files = @scandir($folderPath);
            if ($files === false) {
                return response()->json(['success' => false, 'message' => 'Gagal membaca folder.'], 500);
            }

            if (count($files) > 2) { // lebih dari . dan ..
                return response()->json(['success' => false, 'message' => 'Folder tidak dapat dihapus karena tidak kosong.'], 400);
            }

            if (@rmdir($folderPath)) {
                $this->logActivity('Hapus folder sertifikat: ' . $folderName, $request);
                return response()->json(['success' => true, 'message' => "Folder '{$folderName}' berhasil dihapus."]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal menghapus folder.'], 500);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi destroyFolder error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Buat folder baru
     */
    public function createFolder(Request $request)
    {
        canOrFail('super admin,checker,approver');

        $request->validate([
            'parent_folder' => 'nullable|string',
            'folder_name'   => 'required|string|max:100',
        ]);

        try {
            $parent = $request->get('parent_folder', '');
            $path = $this->safePath($parent);
            
            $folderName = preg_replace('/[<>:"\/\\\\|?*]/', '', $request->get('folder_name'));
            $folderName = trim($folderName);

            if (empty($folderName)) {
                return response()->json(['success' => false, 'message' => 'Nama folder tidak valid.'], 400);
            }

            $newPath = $path . DIRECTORY_SEPARATOR . $folderName;

            if (file_exists($newPath)) {
                return response()->json(['success' => false, 'message' => 'Folder dengan nama tersebut sudah ada.'], 409);
            }

            if (@mkdir($newPath, 0775, true)) {
                $this->logActivity('Buat folder sertifikat: ' . $folderName, $request);
                return response()->json(['success' => true, 'message' => "Folder '{$folderName}' berhasil dibuat."]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal membuat folder.'], 500);

        } catch (\Exception $e) {
            Log::error('Sertifikat Kalibrasi createFolder error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 1)    . ' KB';
        return $bytes . ' B';
    }

    private function buildBreadcrumbs(?string $folder): array
    {
        $folder = $folder ?? '';
        $crumbs = [['label' => 'Sertifikat Digital', 'folder' => '']];
        if ($folder === '') return $crumbs;

        $parts = array_filter(explode('/', $folder), fn($p) => $p !== '');
        $acc   = '';
        foreach ($parts as $part) {
            $acc      = trim($acc . '/' . $part, '/');
            $crumbs[] = ['label' => $part, 'folder' => $acc];
        }
        return $crumbs;
    }

    private function logActivity(string $message, Request $request): void
    {
        if (class_exists(\App\Models\ActivityLog::class)) {
            try {
                \App\Models\ActivityLog::create([
                    'user_id'    => auth()->id(),
                    'activity'   => $message,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } catch (\Exception $e) {
                Log::warning('Log aktivitas gagal: ' . $e->getMessage());
            }
        }
    }

    /**
     * Public QR Code Viewer (tanpa login)
     */
    public function publicQrView(Request $request, $slug)
    {
        // Decode URL slug
        $decodedSlug = rawurldecode($slug);

        // Split by '|' to get status (e.g., Signed and Approved by Super Admin)
        $parts = explode('|', $decodedSlug);
        $certificateInfo = trim($parts[0]);
        $status = isset($parts[1]) ? trim($parts[1]) : '';

        // Extract certificate number (e.g., PAS-00116 from PAS-00116-K26-...)
        // Try to match PAS-XXXXX pattern
        $certCode = null;
        if (preg_match('/(PAS-[\w\d]+)/i', $certificateInfo, $matches)) {
            $certCode = $matches[1];
        }

        $basePath = $this->basePath();
        $filePath = null;

        // 1. Search by extracted certificate code (e.g., PAS-00116)
        if ($certCode) {
            $filePath = $this->findPdfFile($basePath, $certCode);
        }

        // 2. Fallback: Search by full certificate info string
        if (!$filePath) {
            $filePath = $this->findPdfFile($basePath, $certificateInfo);
        }

        if (!$filePath || !is_file($filePath)) {
            // Render an elegant 404 page
            return view('sertifikat-kalibrasi.public-view', [
                'error' => 'Sertifikat tidak ditemukan di dalam sistem.',
                'slug' => $decodedSlug,
                'certificateInfo' => $certificateInfo,
                'status' => $status
            ]);
        }

        // Get relative path of the file from public folder
        $publicPath = public_path();
        $relativeDir = str_replace($publicPath, '', dirname($filePath));
        $relativeDir = str_replace('\\', '/', $relativeDir);
        $relativeDir = trim($relativeDir, '/');
        
        $filename = basename($filePath);
        // Use rawurlencode for each segment to preserve space and special chars in url
        $pathSegments = array_map('rawurlencode', explode('/', $relativeDir));
        $relativeUrlPath = implode('/', $pathSegments);
        $fileUrl = asset($relativeUrlPath . '/' . rawurlencode($filename));

        // Gather metadata if possible from filename
        // Example: PAS-00116-K26-Dial Indicator-PT CIKARANG PERKASA
        $noSertifikat = 'N/A';
        $perusahaan = 'N/A';
        $namaAlat = 'N/A';

        if ($certificateInfo) {
            $lastDashPos = strrpos($certificateInfo, '-');
            if ($lastDashPos !== false) {
                $noSertifikat = substr($certificateInfo, 0, $lastDashPos);
                $perusahaan = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', substr($certificateInfo, $lastDashPos + 1))));
                
                $parts = explode('-', $noSertifikat);
                if (count($parts) >= 5 && is_numeric($parts[3])) {
                    $namaAlat = implode('-', array_slice($parts, 4));
                } elseif (count($parts) >= 4) {
                    $namaAlat = implode('-', array_slice($parts, 3));
                } else {
                    $namaAlat = end($parts);
                }
                $namaAlat = preg_replace('/^\d+[\s\-_]+/', '', $namaAlat);
                $namaAlat = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $namaAlat)));
            } else {
                $noSertifikat = $certificateInfo;
            }
        }

        // Extract approver name from status
        // E.g., "Signed and Approved by Super Admin" or "Approved by Nazar Kurniawan"
        $approverName = 'Super Admin';
        if ($status && preg_match('/by\s+(.+)$/i', $status, $matches)) {
            $approverName = trim($matches[1]);
        } elseif ($status) {
            $approverName = $status;
        }

        // Inline helper to resolve user profile details by name
        $resolveUser = function($name) {
            if (!$name) return null;
            $user = \App\Models\User::where('nama', $name)
                ->orWhere('nama', 'like', '%' . $name . '%')
                ->first();
            if ($user) {
                return [
                    'name' => $user->nama,
                    'photo' => $user->foto_url
                ];
            }
            return [
                'name' => $name,
                'photo' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=4e73df&color=fff&size=128'
            ];
        };

        // Query calibrations table using the certificate ID (certCode)
        $calibrator = null;
        $verifier = null;
        $calibration = null;
        
        \Log::info('publicQrView Debug:', [
            'decodedSlug' => $decodedSlug,
            'certificateInfo' => $certificateInfo,
            'certCode' => $certCode,
            'noSertifikat' => $noSertifikat,
            'namaAlat' => $namaAlat
        ]);
        
        // 1. Try to find Calibration directly if certCode matches calibration ID (legacy behavior)
        if ($certCode) {
            $calibration = \App\Models\Calibration::where('id', $certCode)
                ->orWhere('id', 'like', '%' . $certCode . '%')
                ->first();
        }
        
        // 2. If not found, try to resolve using the certificate_id from the instrument head tables
        if (!$calibration && $noSertifikat) {
            // Predict head model class based on instrument name (namaAlat)
            $predictedClass = 'App\\Models\\Head' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $namaAlat)));
            
            // Handle some common spelling variations
            $mappings = [
                'App\\Models\\HeadDialTestIndicator' => ['App\\Models\\HeadDialTestIndicator'],
                'App\\Models\\HeadMikropipetDispenset' => ['App\\Models\\HeadMikropipetDispenset', 'App\\Models\\HeadMicropipetDispenset'],
                'App\\Models\\HeadIrThermometer' => ['App\\Models\\HeadIrThermometer', 'App\\Models\\HeadInfraredThermometer', 'App\\Models\\HeadThermometerInfrared'],
                'App\\Models\\HeadThermometer' => ['App\\Models\\HeadThermometer', 'App\\Models\\HeadIrThermometer'],
                'App\\Models\\HeadAbrationTester' => ['App\\Models\\HeadAbrationTester', 'App\\Models\\HeadAbrasionTester'],
            ];
            
            $classesToCheck = [$predictedClass];
            if (isset($mappings[$predictedClass])) {
                $classesToCheck = array_merge($classesToCheck, $mappings[$predictedClass]);
            }
            
            foreach ($classesToCheck as $class) {
                if (class_exists($class)) {
                    $head = $class::where('certificate_id', $noSertifikat)
                        ->orWhere('certificate_id', 'like', '%' . $certCode . '%')
                        ->first();
                    if ($head && $head->calibration_id) {
                        $calibration = \App\Models\Calibration::find($head->calibration_id);
                        if ($calibration) {
                            \Log::info("Resolved calibration {$calibration->id} via head table {$class}");
                            break;
                        }
                    }
                }
            }
            
            // 3. Absolute Fallback: scan all head classes if still not found
            if (!$calibration) {
                $allHeadClasses = $this->getAllHeadClasses();
                
                foreach ($allHeadClasses as $shortClass) {
                    $fullClass = 'App\\Models\\' . $shortClass;
                    if (class_exists($fullClass)) {
                        $head = $fullClass::where('certificate_id', $noSertifikat)
                            ->orWhere('certificate_id', 'like', '%' . $certCode . '%')
                            ->first();
                        if ($head && $head->calibration_id) {
                            $calibration = \App\Models\Calibration::find($head->calibration_id);
                            if ($calibration) {
                                \Log::info("Resolved calibration {$calibration->id} via scan of {$fullClass}");
                                break;
                            }
                        }
                    }
                }
            }
        }

        if ($calibration) {
            \Log::info('publicQrView Calibration Found:', [
                'id' => $calibration->id,
                'calibratedBy' => $calibration->calibratedBy,
                'verifiedBy' => $calibration->verifiedBy,
                'pemilikAlat' => $calibration->pemilikAlat
            ]);
            if ($calibration->calibratedBy) {
                $calibrator = $resolveUser($calibration->calibratedBy);
            }
            if ($calibration->verifiedBy) {
                $verifier = $resolveUser($calibration->verifiedBy);
            }
            if ($calibration->approvedBy) {
                $approverName = $calibration->approvedBy;
            }
            if ($calibration->pemilikAlat) {
                $perusahaan = $calibration->pemilikAlat;
            }
        } else {
            \Log::info('publicQrView Calibration NOT Found for certCode: ' . $certCode);
        }

        // Resolve approver details
        $resolvedApprover = $resolveUser($approverName);

        return view('sertifikat-kalibrasi.public-view', [
            'fileUrl' => $fileUrl,
            'filename' => $filename,
            'noSertifikat' => $noSertifikat,
            'namaAlat' => $namaAlat,
            'perusahaan' => $perusahaan,
            'status' => $status,
            'slug' => $decodedSlug,
            'calibrator' => $calibrator,
            'verifier' => $verifier,
            'approverName' => $resolvedApprover['name'],
            'approverPhoto' => $resolvedApprover['photo']
        ]);
    }

    /**
     * Public Google Drive 2-Frame Certificate Viewer (Security Hardened)
     */
    public function gdrivePublicView(Request $request)
    {
        $fileId = trim($request->query('file_id') ?? '');
        $certId = trim($request->query('cert_id') ?? '');
        $sig    = trim($request->query('sig') ?? '');

        // 1. Validasi Keberadaan file_id
        if (empty($fileId)) {
            return view('sertifikat-kalibrasi.public-view', [
                'error'   => 'Parameter berkas tidak valid atau tidak ditemukan.',
                'status'  => null,
                'fileUrl' => null
            ]);
        }

        // Normalisasi certId
        $normalizedCertId = '';
        if (preg_match('/(PAS-\d+)/i', $certId, $cm)) {
            $normalizedCertId = strtoupper($cm[1]);
        } elseif (preg_match('/^\d+$/', $certId)) {
            $normalizedCertId = 'PAS-' . str_pad($certId, 5, '0', STR_PAD_LEFT);
        } else {
            $normalizedCertId = strtoupper($certId);
        }

        $secretKey = 'PAS_CALIBRATION_SECURE_GDRIVE_KEY_2026';

        // 2. LAYER 1 (Utama): Validasi Tanda Tangan HMAC (&sig=...)
        // Mencegah manipulasi URL cert_id secara matematis tanpa dependensi API pihak ketiga
        if (!empty($sig)) {
            $expectedSig = substr(hash_hmac('sha256', $fileId . '|' . $normalizedCertId, $secretKey), 0, 16);
            if (!hash_equals($expectedSig, $sig)) {
                return view('sertifikat-kalibrasi.public-view', [
                    'error'   => 'Akses ditolak: Parameter URL telah dimanipulasi atau tidak sah.',
                    'status'  => null,
                    'fileUrl' => null
                ]);
            }
        } else {
            // 3. LAYER 2: Jika tanpa tanda tangan (akses langsung/legacy), cek berkas asli Google Drive jika memungkinkan
            $fileInfo = $this->getGDriveFileInfo($fileId);
            if ($fileInfo && !empty($fileInfo['name'])) {
                if (preg_match('/(PAS-\d+)/i', $fileInfo['name'], $m)) {
                    $realCertId = strtoupper($m[1]);
                    // Manipulasi URL terdeteksi lewat nama berkas asli Google Drive
                    if (!empty($normalizedCertId) && $normalizedCertId !== $realCertId) {
                        return view('sertifikat-kalibrasi.public-view', [
                            'error'   => 'Akses ditolak: Parameter ID sertifikat tidak cocok dengan berkas yang dibuka.',
                            'status'  => null,
                            'fileUrl' => null
                        ]);
                    }
                    $normalizedCertId = $realCertId;
                } else {
                    // Bukan sertifikat digital PAS: langsung preview PDF
                    return redirect("https://drive.google.com/file/d/{$fileId}/preview");
                }
            }
        }

        // Cek apakah merupakan format sertifikat digital PAS
        $isDigitalCert = !empty($normalizedCertId) && preg_match('/PAS-\d+/i', $normalizedCertId);
        if (!$isDigitalCert && !empty($fileId)) {
            return redirect("https://drive.google.com/file/d/{$fileId}/preview");
        }

        $certId = $normalizedCertId;

        // URL Google Drive Preview untuk Frame 2 (Right Container)
        $fileUrl = "https://drive.google.com/file/d/{$fileId}/preview";

        $fullCertificateId = $certId ?? 'N/A';
        $namaAlat = 'N/A';
        $perusahaan = 'N/A';
        $status = 'Approved';
        $calibrator = null;
        $verifier = null;
        $approverName = 'Super Admin';
        $approverPhoto = 'https://ui-avatars.com/api/?name=Super+Admin&background=4e73df&color=fff&size=128';

        // 1. Ekstrak metadata awal dari nama berkas (jika tersedia lewat query parameter atau cache/Google Drive API)
        $fileName = trim($request->query('file_name') ?? $request->query('filename') ?? $request->query('name') ?? '');
        if (empty($fileName)) {
            $gdriveInfo = $this->getGDriveFileInfo($fileId);
            if (!empty($gdriveInfo['name'])) {
                $fileName = $gdriveInfo['name'];
            }
        }

        $fileMeta = $this->parseCertificateMetadataFromString($fileName);
        if (!empty($fileMeta['nama_alat'])) {
            $namaAlat = $fileMeta['nama_alat'];
        }
        if (!empty($fileMeta['perusahaan'])) {
            $perusahaan = $fileMeta['perusahaan'];
        }
        if (!empty($fileMeta['full_cert_id']) && $fileMeta['full_cert_id'] !== $certId) {
            $fullCertificateId = $fileMeta['full_cert_id'];
        }

        $numPart = '';
        if (preg_match('/\d+/', $certId, $numMatches)) {
            $numPart = $numMatches[0];
        }
        $numTrim = !empty($numPart) ? ltrim($numPart, '0') : '';

        $headRecord = null;
        $calibration = null;

        // Hanya cari ke database jika merupakan sertifikat digital PAS
        if ($certId && $isDigitalCert) {
            // 1. CARI LANGSUNG KE TABEL CALIBRATIONS TERLEBIH DAHULU (Paling akurat)
            try {
                $calQuery = \App\Models\Calibration::query();
                $calQuery->where(function($q) use ($certId, $numPart, $numTrim, $fullCertificateId) {
                    $q->where('id', $certId)
                      ->orWhere('id', 'like', '%' . $certId . '%')
                      ->orWhere('id_alat', 'like', '%' . $certId . '%')
                      ->orWhere('LK', 'like', '%' . $certId . '%');

                    if (!empty($numPart)) {
                        $q->orWhere('id', 'like', '%' . $numPart . '%')
                          ->orWhere('id_alat', 'like', '%' . $numPart . '%');
                    }
                    if (!empty($numTrim) && strlen($numTrim) >= 3) {
                        $q->orWhere('id', 'like', '%' . $numTrim . '%')
                          ->orWhere('id_alat', 'like', '%' . $numTrim . '%');
                    }
                    if (!empty($fullCertificateId) && $fullCertificateId !== $certId) {
                        $q->orWhere('id', 'like', '%' . $fullCertificateId . '%')
                          ->orWhere('id_alat', 'like', '%' . $fullCertificateId . '%');
                    }
                });
                $calibration = $calQuery->latest()->first();
            } catch (\Throwable $e) {
                \Log::warning('gdrivePublicView: Calibration query error: ' . $e->getMessage());
            }

            // 2. JIKA BELUM KETEMU, CARI DI HEAD MODELS
            $allHeadClasses = $this->getAllHeadClasses();

            // Jika ada prediksi nama alat, prioritaskan model yang cocok
            if ($namaAlat !== 'N/A') {
                $predictedShort = 'Head' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $namaAlat)));
                if (in_array($predictedShort, $allHeadClasses)) {
                    $allHeadClasses = array_diff($allHeadClasses, [$predictedShort]);
                    array_unshift($allHeadClasses, $predictedShort);
                }
            }

            foreach ($allHeadClasses as $shortClass) {
                $fullClass = 'App\\Models\\' . $shortClass;
                if (class_exists($fullClass)) {
                    try {
                        $head = $fullClass::where(function($q) use ($certId, $numPart, $fullCertificateId) {
                            $q->where('certificate_id', $certId)
                              ->orWhere('certificate_id', 'like', '%' . $certId . '%');
                            if (!empty($numPart)) {
                                $q->orWhere('certificate_id', 'like', '%' . $numPart . '%');
                            }
                            if (!empty($fullCertificateId) && $fullCertificateId !== $certId) {
                                $q->orWhere('certificate_id', 'like', '%' . $fullCertificateId . '%');
                            }
                        })->first();

                        if ($head) {
                            $headRecord = $head;
                            $foundCertId = $head->certificate_id ?? $head->no_sertifikat ?? $head->no_certificate ?? null;
                            if (!empty($foundCertId)) {
                                $fullCertificateId = $foundCertId;
                            }
                            if (!$calibration && !empty($head->calibration_id)) {
                                $calibration = \App\Models\Calibration::where('id', $head->calibration_id)
                                    ->orWhere('id', 'like', '%' . $head->calibration_id . '%')
                                    ->first();
                            }
                            break;
                        }
                    } catch (\Throwable $e) {}
                }
            }

            // 3. JIKA CALIBRATION DITEMUKAN, AMBIL DATA LENGKAPNYA
            if ($calibration) {
                if (empty($fullCertificateId) || $fullCertificateId === $certId) {
                    $fullCertificateId = $calibration->certificate_id ?? $calibration->id_alat ?? $calibration->id ?? $certId;
                }
                if ($namaAlat === 'N/A' && !empty($calibration->namaAlat)) {
                    $namaAlat = $calibration->namaAlat;
                }
                if ($perusahaan === 'N/A' || $perusahaan === $numPart || $perusahaan === $certId || preg_match('/^\d+$/', $perusahaan)) {
                    $perusahaan = $calibration->pemilikAlat ?? $calibration->nama_pelanggan ?? $calibration->customer_name ?? $calibration->perusahaan ?? 'N/A';
                }

                $resolveUser = function($name) {
                    if (!$name) return null;
                    $user = null;
                    try {
                        $user = \App\Models\User::where('nama', $name)
                            ->orWhere('nama', 'like', '%' . $name . '%')
                            ->orWhere('nik', $name)
                            ->first();
                    } catch (\Throwable $e) {}

                    if ($user) {
                        return [
                            'name'  => $user->nama,
                            'photo' => $user->foto_url
                        ];
                    }
                    return [
                        'name'  => $name,
                        'photo' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=4e73df&color=fff&size=128'
                    ];
                };

                if ($calibration->calibratedBy) {
                    $calibrator = $resolveUser($calibration->calibratedBy);
                }
                if ($calibration->verifiedBy) {
                    $verifier = $resolveUser($calibration->verifiedBy);
                }
                if ($calibration->approvedBy) {
                    $resolved = $resolveUser($calibration->approvedBy);
                    $approverName = $resolved['name'];
                    $approverPhoto = $resolved['photo'];
                }
            } elseif ($headRecord) {
                if ($namaAlat === 'N/A' && !empty($headRecord->nama_alat)) {
                    $namaAlat = $headRecord->nama_alat;
                }
                if (($perusahaan === 'N/A' || $perusahaan === $numPart || $perusahaan === $certId || preg_match('/^\d+$/', $perusahaan)) && !empty($headRecord->nama_pelanggan)) {
                    $perusahaan = $headRecord->nama_pelanggan;
                }
            }

            // 4. Fallback ekstraksi dari string fullCertificateId HANYA jika valid format (memiliki min 3 strip)
            if (($namaAlat === 'N/A' || $perusahaan === 'N/A' || preg_match('/^\d+$/', $perusahaan)) && !empty($fullCertificateId) && substr_count($fullCertificateId, '-') >= 3) {
                $lastDashPos = strrpos($fullCertificateId, '-');
                if ($lastDashPos !== false) {
                    if ($perusahaan === 'N/A' || preg_match('/^\d+$/', $perusahaan)) {
                        $extractedComp = trim(substr($fullCertificateId, $lastDashPos + 1));
                        if (!empty($extractedComp) && !preg_match('/^\d+$/', $extractedComp)) {
                            $perusahaan = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $extractedComp)));
                        }
                    }
                    $noPrefix = substr($fullCertificateId, 0, $lastDashPos);
                    $parts = explode('-', $noPrefix);
                    if (count($parts) >= 5 && is_numeric($parts[3]) && $namaAlat === 'N/A') {
                        $namaAlat = implode('-', array_slice($parts, 4));
                    } elseif (count($parts) >= 4 && $namaAlat === 'N/A') {
                        $namaAlat = implode('-', array_slice($parts, 3));
                    }
                }
            }

            // Bersihkan jika perusahaan ternyata masih hanya nomor certId (misal "000584")
            if ($perusahaan === $numPart || $perusahaan === $certId || preg_match('/^\d+$/', $perusahaan)) {
                $perusahaan = 'N/A';
            }

            // Pembersihan final nama alat & perusahaan (hapus prefix nomor urut seperti '1-' dan underscore)
            if (!empty($namaAlat) && $namaAlat !== 'N/A') {
                $namaAlat = preg_replace('/^\d+[\s\-_]+/', '', $namaAlat);
                $namaAlat = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $namaAlat)));
            }
            if (!empty($perusahaan) && $perusahaan !== 'N/A') {
                $perusahaan = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $perusahaan)));
            }
        }

        return view('sertifikat-kalibrasi.public-view', [
            'fileUrl'       => $fileUrl,
            'filename'      => $fullCertificateId . '.pdf',
            'noSertifikat'  => $fullCertificateId,
            'namaAlat'      => $namaAlat,
            'perusahaan'    => $perusahaan,
            'status'        => $status,
            'slug'          => $certId,
            'calibrator'    => $calibrator,
            'verifier'      => $verifier,
            'approverName'  => $approverName,
            'approverPhoto' => $approverPhoto
        ]);
    }

    /**
     * Helper to search for PDF file recursively
     */
    private function findPdfFile($basePath, $searchPattern)
    {
        if (!file_exists($basePath) || !is_dir($basePath)) {
            return null;
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($basePath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && strtolower($file->getExtension()) === 'pdf') {
                $filename = $file->getFilename();
                // Case-insensitive check
                if (stripos($filename, $searchPattern) !== false) {
                    return $file->getPathname();
                }
            }
        }

        return null;
    }

    /**
     * Dapatkan metadata berkas Google Drive dengan Cache
     */
    private function getGDriveFileInfo($fileId)
    {
        if (empty($fileId)) return null;

        try {
            $cached = \Illuminate\Support\Facades\Cache::store('file')->get('gdrive_file_meta_' . $fileId);
            if ($cached && is_array($cached) && !empty($cached['id'])) {
                return $cached;
            }
        } catch (\Throwable $e) {}

        $fetchMetadata = function() use ($fileId) {
            $candidatePaths = [
                base_path('credentials.json'),
                public_path('credentials.json'),
                dirname(base_path()) . '/credentials.json',
                dirname(__DIR__, 3) . '/credentials.json',
                dirname(__DIR__, 3) . '/public_html/credentials.json',
                dirname(__DIR__, 3) . '/public/credentials.json',
                ($_SERVER['DOCUMENT_ROOT'] ?? '') . '/credentials.json',
                dirname($_SERVER['DOCUMENT_ROOT'] ?? '') . '/credentials.json',
            ];
            $credentialsPath = null;
            foreach ($candidatePaths as $p) {
                if (!empty($p) && file_exists($p)) {
                    $credentialsPath = $p;
                    break;
                }
            }
            if (!$credentialsPath) {
                return null;
            }

            $sa = json_decode(file_get_contents($credentialsPath), true);
            if (!$sa || empty($sa['private_key']) || empty($sa['client_email'])) {
                return null;
            }

            $now = time();
            $b64 = fn($d) => str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($d));
            $header  = $b64(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
            $payload = $b64(json_encode([
                'iss'   => $sa['client_email'],
                'scope' => 'https://www.googleapis.com/auth/drive.readonly',
                'aud'   => 'https://oauth2.googleapis.com/token',
                'exp'   => $now + 3600,
                'iat'   => $now
            ]));

            $jwt = $header . '.' . $payload;
            if (!openssl_sign($jwt, $sig, $sa['private_key'], 'SHA256')) {
                return null;
            }
            $jwt .= '.' . $b64($sig);

            $ch = curl_init('https://oauth2.googleapis.com/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion'  => $jwt
            ]));
            curl_setopt($ch, CURLOPT_TIMEOUT, 12);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'PASCalibration/1.0');
            $tokenRes = curl_exec($ch);
            curl_close($ch);

            $tokenData = json_decode($tokenRes, true);
            $accessToken = $tokenData['access_token'] ?? null;
            if (!$accessToken) return null;

            $ch2 = curl_init("https://www.googleapis.com/drive/v3/files/{$fileId}?fields=id,name,mimeType,trashed&supportsAllDrives=true");
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
                'Accept: application/json'
            ]);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch2, CURLOPT_USERAGENT, 'PASCalibration/1.0');
            $fileRes = curl_exec($ch2);
            curl_close($ch2);

            $fileData = json_decode($fileRes, true);
            return (!empty($fileData['id'])) ? $fileData : null;
        };

        $result = $fetchMetadata();
        if ($result && !empty($result['id'])) {
            try {
                \Illuminate\Support\Facades\Cache::store('file')->put('gdrive_file_meta_' . $fileId, $result, 3600);
            } catch (\Throwable $e) {}
        }
        return $result;
    }

    /**
     * Dapatkan daftar seluruh model Head alat kalibrasi secara dinamis
     */
    private function getAllHeadClasses()
    {
        $classes = [];
        $modelsPath = app_path('Models');
        if (is_dir($modelsPath)) {
            $headFiles = glob($modelsPath . '/Head*.php');
            if (!empty($headFiles)) {
                foreach ($headFiles as $file) {
                    $classes[] = basename($file, '.php');
                }
            }
        }

        if (empty($classes)) {
            $classes = [
                'HeadAbrationTester', 'HeadAnakTimbangan', 'HeadBoreGauge', 'HeadCaliper',
                'HeadCentrifuge', 'HeadChamber', 'HeadClampMeterAc', 'HeadCoatingThickness',
                'HeadConductivityMeter', 'HeadDepthCaliper', 'HeadDepthMicrometer',
                'HeadDialIndicator', 'HeadDialTestIndicator', 'HeadDifferentialPressureGauge',
                'HeadDurometer', 'HeadEnclosure', 'HeadFeelerGauge', 'HeadGaugeBlock',
                'HeadHoletest', 'HeadInsideMicrometer', 'HeadIrThermometer', 'HeadMicroscope',
                'HeadMikropipetDispenset', 'HeadMultimeterDc', 'HeadOhmMeter',
                'HeadOutsideMicrometer', 'HeadPenggaris', 'HeadPhMeter', 'HeadPinGauge',
                'HeadPlainLimitGauge', 'HeadPlasticShim', 'HeadPressureGauge',
                'HeadPressureTransmitter', 'HeadProfilProjector', 'HeadPushPull',
                'HeadStopwatch', 'HeadSurfacePlate', 'HeadSurfaceRoughnessTester',
                'HeadTachometer', 'HeadTaperGauge', 'HeadTempHumidTransmitter',
                'HeadTempTransmitter', 'HeadThermoIndicator', 'HeadThermohygrometer',
                'HeadThermometer', 'HeadThicknessGauge', 'HeadThreadGauge', 'HeadTimbangan',
                'HeadTimbanganBias', 'HeadTimbanganMoisture', 'HeadTorqueMeter',
                'HeadTorqueWrench', 'HeadUltrasonicThicknessGauge', 'HeadUtm',
                'HeadViscoCup', 'HeadViscometer', 'HeadVolumetrik'
            ];
        }

        return array_values(array_unique($classes));
    }

    /**
     * Ekstrak metadata (no sertifikat, nama alat, perusahaan) dari nama berkas PDF
     */
    private function parseCertificateMetadataFromString($str)
    {
        $meta = [
            'full_cert_id' => null,
            'cert_code'    => null,
            'nama_alat'    => null,
            'perusahaan'   => null,
        ];
        if (empty($str)) return $meta;

        $clean = pathinfo($str, PATHINFO_FILENAME);
        $clean = trim(preg_replace('/\.pdf$/i', '', $clean));
        $meta['full_cert_id'] = $clean;

        // Ambil kode PAS (misal PAS-000584)
        if (preg_match('/(PAS-\d+)/i', $clean, $m)) {
            $meta['cert_code'] = strtoupper($m[1]);
        }

        // Cek pola dengan pemisah ' - ' (space-dash-space)
        if (strpos($clean, ' - ') !== false) {
            $parts = array_values(array_filter(array_map('trim', explode(' - ', $clean))));
            if (count($parts) >= 2) {
                if (count($parts) == 2) {
                    if (preg_match('/\b(PT|CV|UD|TOKO|CORP|INC|LTD|YAYASAN)\b/i', $parts[1])) {
                        $meta['perusahaan'] = $parts[1];
                    } else {
                        $meta['nama_alat'] = $parts[1];
                    }
                } elseif (count($parts) >= 3) {
                    if (preg_match('/\b(PT|CV|UD|TOKO|CORP|INC|LTD|YAYASAN)\b/i', $parts[1])) {
                        $meta['perusahaan'] = $parts[1];
                        $meta['nama_alat']   = $parts[2];
                    } else {
                        $meta['nama_alat']   = $parts[1];
                        $meta['perusahaan'] = $parts[2];
                    }
                }
            }
            return $meta;
        }

        // Cek pola standar: PAS-XXXXX-KYY-Nama Alat-Perusahaan atau PAS-XXXXX-KYY-1-Nama Alat-Perusahaan
        if (substr_count($clean, '-') >= 3) {
            $lastDash = strrpos($clean, '-');
            $rawCompany = trim(substr($clean, $lastDash + 1));
            $meta['perusahaan'] = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $rawCompany)));
            
            $noPrefix = substr($clean, 0, $lastDash);
            $parts = explode('-', $noPrefix);
            
            // Cek jika $parts[3] adalah urutan kalibrasi / nomor (misal '1' di PAS-000132-K26-1-Thermohygrometer)
            if (count($parts) >= 5 && is_numeric($parts[3])) {
                $meta['nama_alat'] = trim(implode('-', array_slice($parts, 4)));
            } elseif (count($parts) >= 4) {
                $meta['nama_alat'] = trim(implode('-', array_slice($parts, 3)));
            } elseif (count($parts) >= 3) {
                $meta['nama_alat'] = trim($parts[2]);
            }
        }

        // Pembersihan tambahan nama alat dan perusahaan
        if (!empty($meta['nama_alat'])) {
            // Hapus nomor urut di awal nama alat (misal "1-Thermohygrometer" -> "Thermohygrometer")
            $meta['nama_alat'] = preg_replace('/^\d+[\s\-_]+/', '', $meta['nama_alat']);
            $meta['nama_alat'] = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $meta['nama_alat'])));
        }
        if (!empty($meta['perusahaan'])) {
            $meta['perusahaan'] = trim(preg_replace('/\s+/', ' ', str_replace('_', ' ', $meta['perusahaan'])));
        }

        return $meta;
    }
}
