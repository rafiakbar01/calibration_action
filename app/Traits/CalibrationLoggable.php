<?php

namespace App\Traits;

use App\Models\CalibrationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait CalibrationLoggable
{
    /**
     * Log aksi kalibrasi
     */
    public function logAksi(
        string $aksi,
        string $deskripsi,
        array $dataSebelum = null,
        array $dataSesudah = null,
        array $fieldBerubah = null,
        string $statusSebelum = null,
        string $statusSesudah = null,
        array $metadata = null
    ): CalibrationLog {
        $user = Auth::user();
        
        if (!$user) {
            $user = (object) [
                'nik' => 'SYS001',
                'name' => 'System',
                'role' => 'system',
            ];
        }
        
        // Ambil NIK dari user (sesuaikan dengan struktur database Anda)
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        // Ambil role dari user
        $userRole = $user->role ?? 'teknisi';
        
        return CalibrationLog::create([
            'calibration_id' => $this->id,
            'kode_alat' => $this->kodeAlat,
            'nama_alat' => $this->namaAlat,
            'aksi' => $aksi,
            'deskripsi' => $deskripsi,
            'user_nik' => $userNik,
            'user_nama' => $user->name,
            'user_role' => $userRole,
            'data_sebelum' => $dataSebelum,
            'data_sesudah' => $dataSesudah,
            'field_yang_berubah' => $fieldBerubah,
            'status_sebelum' => $statusSebelum,
            'status_sesudah' => $statusSesudah,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'metadata' => $metadata,
        ]);
    }

    /**
     * Log input data baru
     */
    public function logInput(): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        return $this->logAksi(
            'Input',
            "Data kalibrasi {$this->namaAlat} ({$this->kodeAlat}) berhasil diinput oleh {$user->name} (NIK: {$userNik})",
            null,
            $this->toArray(),
            null,
            null,
            $this->status
        );
    }

    /**
     * Log edit data
     */
    public function logEdit(array $oldData, array $changes, $oldStatus = null, $newStatus = null): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        $changedFields = array_keys($changes);
        
        $deskripsi = "Data {$this->namaAlat} ({$this->kodeAlat}) diedit oleh {$user->name} (NIK: {$userNik})";
        
        return $this->logAksi(
            'Edit',
            $deskripsi,
            $oldData,
            $this->toArray(),
            $changedFields,
            $oldStatus,
            $newStatus
        );
    }

    /**
     * Log submit untuk verifikasi
     */
    public function logSubmit(): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        return $this->logAksi(
            'Submit',
            "Data {$this->namaAlat} ({$this->kodeAlat}) dikirim untuk verifikasi oleh {$user->name} (NIK: {$userNik})",
            null, null, null,
            'draft',
            'waiting_verification'
        );
    }

    /**
     * Log verified
     */
    public function logVerified(string $catatan = null): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        $deskripsi = "Data {$this->namaAlat} ({$this->kodeAlat}) berhasil diverifikasi oleh {$user->name} (NIK: {$userNik})";
        
        if ($catatan) {
            $deskripsi .= " - Catatan: {$catatan}";
        }
        
        return $this->logAksi(
            'Verified',
            $deskripsi,
            null, null, null,
            'waiting_verification',
            'waiting_approval',
            ['catatan' => $catatan]
        );
    }

    /**
     * Log approved
     */
    public function logApproved(string $catatan = null): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        $deskripsi = "Data {$this->namaAlat} ({$this->kodeAlat}) disetujui oleh {$user->name} (NIK: {$userNik})";
        
        if ($catatan) {
            $deskripsi .= " - Catatan: {$catatan}";
        }
        
        return $this->logAksi(
            'Approved',
            $deskripsi,
            null, null, null,
            'waiting_approval',
            'approved',
            ['catatan' => $catatan]
        );
    }

    /**
     * Log rejected
     */
    public function logRejected(string $alasan): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        return $this->logAksi(
            'Rejected',
            "Data {$this->namaAlat} ({$this->kodeAlat}) ditolak oleh {$user->name} (NIK: {$userNik}) - Alasan: {$alasan}",
            null, null, null,
            $this->status,
            'rejected',
            ['alasan' => $alasan]
        );
    }

    /**
     * Log complete
     */
    public function logComplete(string $catatan = null): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        $deskripsi = "Proses kalibrasi {$this->namaAlat} ({$this->kodeAlat}) selesai oleh {$user->name} (NIK: {$userNik})";
        
        if ($catatan) {
            $deskripsi .= " - Catatan: {$catatan}";
        }
        
        return $this->logAksi(
            'Complete',
            $deskripsi,
            null, null, null,
            $this->status,
            'completed',
            ['catatan' => $catatan]
        );
    }

    /**
     * Log delete
     */
    public function logDelete(): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        return $this->logAksi(
            'Hapus',
            "Data {$this->namaAlat} ({$this->kodeAlat}) dihapus oleh {$user->name} (NIK: {$userNik})",
            $this->toArray(),
            null,
            null,
            $this->status,
            'deleted'
        );
    }

    /**
     * Log download
     */
    public function logDownload(string $jenisFile): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        return $this->logAksi(
            'Download',
            "{$user->name} (NIK: {$userNik}) mendownload {$jenisFile} untuk {$this->namaAlat}",
            null, null, null,
            null, null,
            ['jenis_file' => $jenisFile]
        );
    }

    /**
     * Log print
     */
    public function logPrint(): CalibrationLog
    {
        $user = Auth::user();
        $userNik = $user->nik ?? $user->NIK ?? 'N/A';
        
        return $this->logAksi(
            'Print',
            "{$user->name} (NIK: {$userNik}) mencetak data {$this->namaAlat}",
            null, null, null,
            null, null,
            ['printed_at' => now()]
        );
    }
}