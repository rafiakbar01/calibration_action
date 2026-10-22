<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use App\Models\LogKalibrasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogHelper
{
    /**
     * Catat aktivitas umum (Login, Logout, Create, dll)
     */
    public static function log($type, $description, $model = null, $oldData = null, $newData = null, $metadata = [])
    {
        try {
            return ActivityLog::create([
                'activity_type' => $type,
                'description'   => $description,
                'logable_type'  => $model ? get_class($model) : null,
                'logable_id'    => $model ? $model->id : null,
                'old_data'      => $oldData,
                'new_data'      => $newData,
                'performed_by'  => Auth::id(),
                'ip_address'    => Request::ip(),
                'user_agent'    => Request::userAgent(),
                'method'        => Request::method(),
                'url'           => Request::fullUrl(),
                'metadata'      => $metadata,
                'batch_uuid'    => session()->get('activity_batch_id'),
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mencatat ActivityLog: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Log user memilih form alat ukur
     */
    public static function logSelectForm($formType, $formName, $tabId = null, $additionalData = [])
    {
        $description = "Memilih form alat ukur: {$formName}";
        if ($tabId) {
            $description .= " pada tab {$tabId}";
        }
        
        $metadata = array_merge([
            'form_type' => $formType,
            'form_name' => $formName,
            'tab_id' => $tabId,
            'alat_yang_dipilih' => $formName,
        ], $additionalData);
        
        return self::log('select_form', $description, null, null, null, $metadata);
    }

    /**
     * Log akses halaman (page_access)
     */
    public static function logPageAccess($pageName, $additionalData = [])
    {
        $metadata = array_merge(['page' => $pageName], $additionalData);

        return self::log(
            'page_access',
            "📄 Akses halaman: {$pageName}",
            null, null, null,
            $metadata
        );
    }

    /**
     * Log pencarian alat
     */
    public static function logSearchAlat($keyword, $resultCount = 0, $additionalData = [])
    {
        $metadata = array_merge([
            'keyword'      => $keyword,
            'result_count' => $resultCount,
        ], $additionalData);

        return self::log(
            'search_alat',
            "🔍 Pencarian alat: \"{$keyword}\" → {$resultCount} hasil",
            null, null, null,
            $metadata
        );
    }

    /**
     * Log user melakukan scan QR code
     */
    public static function logScanQR($qrCode, $tabId, $result = 'success', $message = null, $dataFound = null)
    {
        $metadata = [
            'qr_code' => $qrCode,
            'tab_id' => $tabId,
            'result' => $result,
            'data_found' => $dataFound,
        ];
        
        if ($message) {
            $metadata['message'] = $message;
        }
        
        $description = $result === 'success' 
            ? "Scan QR Code berhasil: {$qrCode} pada tab {$tabId}"
            : "Scan QR Code gagal: {$qrCode} pada tab {$tabId} - {$message}";
        
        return self::log(
            $result === 'success' ? 'scan_qr_success' : 'scan_qr_failed',
            $description,
            null,
            null,
            null,
            $metadata
        );
    }

    /**
     * Log data hasil scan QR (data alat yang ditemukan)
     */
    public static function logScanResult($data, $tabId)
    {
        $namaAlat = $data['namaAlat'] ?? $data['nama_alat'] ?? '-';
        $formType = $data['form_type'] ?? '-';
        
        $description = "Hasil scan QR - Alat: {$namaAlat} (Form: {$formType}) pada tab {$tabId}";
        
        $metadata = [
            'tab_id' => $tabId,
            'id_alat' => $data['id_alat'] ?? null,
            'nama_alat' => $namaAlat,
            'no_seri' => $data['NoSeri'] ?? null,
            'form_type' => $formType,
            'capacity' => $data['capacity'] ?? null,
            'resolusi' => $data['resolusi'] ?? null,
            'merek' => $data['brandAlat'] ?? null,
            'pemilik' => $data['pemilikAlat'] ?? null,
        ];
        
        return self::log(
            'scan_result',
            $description,
            null,
            null,
            null,
            $metadata
        );
    }

    /**
     * Log autofill form (pengisian otomatis dari scan)
     */
    public static function logAutoFillForm($tabId, $formType, $namaAlat, $filledFields = [], $status = 'success', $error = null)
    {
        $metadata = [
            'tab_id' => $tabId,
            'form_type' => $formType,
            'nama_alat' => $namaAlat,
            'alat_yang_diisi' => $namaAlat,
            'filled_fields_count' => count($filledFields),
            'filled_fields' => $filledFields,
            'status' => $status,
        ];
        
        if ($error) {
            $metadata['error'] = $error;
        }
        
        $description = $status === 'success'
            ? "Auto-fill form berhasil: {$namaAlat} ({$formType}) pada tab {$tabId}, " . count($filledFields) . " field terisi"
            : "Auto-fill form gagal: {$namaAlat} ({$formType}) pada tab {$tabId} - {$error}";
        
        return self::log(
            $status === 'success' ? 'auto_fill_success' : 'auto_fill_failed',
            $description,
            null,
            null,
            null,
            $metadata
        );
    }

    /**
     * Spesifik untuk log kalibrasi (Model LogKalibrasi lama)
     */
    public static function buat_log_kalibrasi($kalibrasi_id, $aksi, $deskripsi = null, $data_lama = null, $data_baru = null)
    {
        try {
            $user = Auth::user();
            return LogKalibrasi::create([
                'kalibrasi_id' => $kalibrasi_id,
                'aksi'         => $aksi,
                'deskripsi'    => $deskripsi,
                'data_lama'    => $data_lama,
                'data_baru'    => $data_baru,
                'alamat_ip'    => Request::ip(),
                'user_agent'   => Request::userAgent(),
                'user_id'      => $user ? $user->id : null,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mencatat LogKalibrasi: ' . $e->getMessage());
            return false;
        }
    }
}