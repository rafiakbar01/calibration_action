<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dashboard extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calibrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_calibration',           // Nomor kalibrasi (opsional)
        'instrument_name',          // Nama alat/instrumen
        'serial_number',            // Serial number alat
        'location',                 // Lokasi alat
        'calibration_date',         // Tanggal kalibrasi
        'due_date',                 // Tanggal jatuh tempo berikutnya
        'status',                   // waiting_verified | approved | rejected
        'notes',                    // Catatan tambahan
        'created_by',               // User ID yang membuat
        'verified_by',              // User ID yang verifikasi (nullable)
        'approved_by',              // User ID yang approve (nullable)
        // tambahkan kolom lain sesuai kebutuhan
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'calibration_date' => 'date',
        'due_date'         => 'date',
    ];

    /**
     * Relasi ke User yang membuat data
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke User yang memverifikasi
     */
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    /**
     * Relasi ke User yang menyetujui
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope untuk status waiting_verified
     */
    public function scopeWaitingVerified($query)
    {
        return $query->where('status', 'waiting_verified');
    }

    /**
     * Scope untuk status approved
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk status rejected
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope untuk data hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    /**
     * Accessor untuk menampilkan teks status yang lebih ramah
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'waiting_verified' => '<span class="badge badge-warning">Menunggu Verifikasi</span>',
            'approved'         => '<span class="badge badge-success">Disetujui</span>',
            'rejected'         => '<span class="badge badge-danger">Ditolak</span>',
            default            => '<span class="badge badge-secondary">Unknown</span>',
        };
    }
}