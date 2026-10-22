<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class BeritaAcara extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'berita_acara';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_ba';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'id_ba',
    'no_ba',
    'tanggal',
    'perusahaan',
    'alamat',
    'no_order',
    'kontak',
    'telp_fax',
    'nama_alat',
    'merek',
    'kapasitas',
    'no_seri',
    'keterangan',
    'type_alat',
    'no_label',
    'calibration_id',
    'request_by',
    'approve_by',
    'created_by',
    'updated_by',
    'status',
    'catatan',
    'approval_method',
    'client_phone',
    'approval_signature',
    'pdf_path', // <-- TAMBAHKAN INI
    'approved_at',
    'rejected_by',
    'rejected_at',
    'rejection_reason',
    'approval_token',
    'session_token'
];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User yang membuat data
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke User yang mengupdate data
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Relasi ke User yang menyetujui
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Relasi ke User yang menolak
     */
    public function rejector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
    
    
    public function alatList()
    {
        return $this->hasMany(BeritaAcara::class, 'no_ba', 'no_ba');
    }

    /**
     * Relasi ke model Calibration
     * Menghubungkan berita_acara dengan data calibration asal
     */
    public function calibration(): BelongsTo
    {
        return $this->belongsTo(Calibration::class, 'calibration_id', 'id');
    }

    /**
     * Scope untuk filter berdasarkan rentang tanggal
     */
    public function scopeTanggalBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    /**
     * Scope untuk filter berdasarkan perusahaan
     */
    public function scopePerusahaan($query, $perusahaan)
    {
        return $query->where('perusahaan', 'LIKE', "%{$perusahaan}%");
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk status draft
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope untuk status waiting_approve
     */
    public function scopeWaitingApprove($query)
    {
        return $query->where('status', 'waiting_approve');
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
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal', Carbon::today());
    }

    /**
     * Scope untuk data bulan ini
     */
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal', Carbon::now()->month)
                     ->whereYear('tanggal', Carbon::now()->year);
    }

    /**
     * Accessor untuk menampilkan status dengan badge
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'draft'           => '<span class="badge bg-secondary">Draft</span>',
            'waiting_approve' => '<span class="badge bg-warning text-dark">Menunggu Persetujuan</span>',
            'approved'        => '<span class="badge bg-success">Disetujui</span>',
            'rejected'        => '<span class="badge bg-danger">Ditolak</span>',
            'selesai'         => '<span class="badge bg-info">Selesai</span>',
            'batal'           => '<span class="badge bg-dark">Batal</span>',
            default           => '<span class="badge bg-secondary">' . $this->status . '</span>',
        };
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getTanggalFormattedAttribute(): string
    {
        return $this->tanggal ? $this->tanggal->format('d/m/Y') : '-';
    }

    /**
     * Accessor untuk format tanggal approval
     */
    public function getApprovedAtFormattedAttribute(): string
    {
        return $this->approved_at ? $this->approved_at->format('d/m/Y H:i') : '-';
    }

    /**
     * Accessor untuk format tanggal rejection
     */
    public function getRejectedAtFormattedAttribute(): string
    {
        return $this->rejected_at ? $this->rejected_at->format('d/m/Y H:i') : '-';
    }

    /**
     * Accessor untuk info lengkap alat
     */
    public function getInfoAlatAttribute(): string
    {
        $parts = [];
        if ($this->nama_alat) $parts[] = $this->nama_alat;
        if ($this->merek) $parts[] = $this->merek;
        if ($this->no_seri) $parts[] = 'SN: ' . $this->no_seri;
        
        return !empty($parts) ? implode(' - ', $parts) : '-';
    }

    /**
     * Accessor untuk mendapatkan data calibration asal
     * Mengembalikan data calibration jika ada
     */
    public function getDataCalibrationAttribute()
    {
        if ($this->calibration) {
            return [
                'nama_alat' => $this->calibration->namaAlat,
                'brand' => $this->calibration->brandAlat,
                'no_seri' => $this->calibration->NoSeri,
                'range_min' => $this->calibration->rangeMin,
                'range_max' => $this->calibration->rangeMax,
                'satuan' => $this->calibration->satuan ?? '',
                'pemilik' => $this->calibration->pemilikAlat,
            ];
        }
        return null;
    }

    /**
     * Accessor untuk mendapatkan rentang ukur dari calibration
     */
    public function getRentangUkurFromCalibrationAttribute(): string
    {
        if ($this->calibration && !empty($this->calibration->rangeMin) && !empty($this->calibration->rangeMax)) {
            $rentang = $this->calibration->rangeMin . ' - ' . $this->calibration->rangeMax;
            if (!empty($this->calibration->satuan)) {
                $rentang .= ' ' . $this->calibration->satuan;
            }
            return $rentang;
        }
        return $this->kapasitas ?? '-';
    }

    /**
     * Cek apakah status sedang waiting approve
     */
    public function isWaitingApprove(): bool
    {
        return $this->status === 'waiting_approve';
    }

    /**
     * Cek apakah status sudah approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Cek apakah status rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Cek apakah bisa diapprove
     */
    public function canBeApproved(): bool
    {
        return $this->status === 'waiting_approve';
    }

    /**
     * Cek apakah bisa direject
     */
    public function canBeRejected(): bool
    {
        return $this->status === 'waiting_approve';
    }

    /**
     * Generate nomor BA otomatis dengan format BA-ID-00000
     * Format: BA-ID-00001, BA-ID-00002, BA-ID-00003, dst
     */
    public static function generateNoBa(): string
    {
        // Cari angka nomor BA tertinggi yang ada di database secara numerik
        $maxNumber = self::where('no_ba', 'LIKE', 'BA-ID-%')
            ->selectRaw('MAX(CAST(SUBSTRING(no_ba, 7) AS UNSIGNED)) as max_no')
            ->value('max_no');

        $nextNumber = ($maxNumber ? (int)$maxNumber : 0) + 1;

        return 'BA-ID-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Get summary per nomor BA
     */
    public static function getSummary()
    {
        return self::selectRaw('
                no_ba,
                perusahaan,
                tanggal,
                COUNT(*) as jumlah_alat,
                GROUP_CONCAT(nama_alat SEPARATOR "; ") as daftar_alat,
                status,
                created_by,
                approved_by,
                approved_at
            ')
            ->groupBy('no_ba', 'perusahaan', 'tanggal', 'status', 'created_by', 'approved_by', 'approved_at')
            ->orderBy('tanggal', 'desc')
            ->orderBy('no_ba', 'desc')
            ->get();
    }

    /**
     * Get distinct perusahaan for dropdown
     */
    public static function getDistinctPerusahaan()
    {
        return self::whereNotNull('perusahaan')
                   ->where('perusahaan', '!=', '')
                   ->distinct()
                   ->orderBy('perusahaan')
                   ->pluck('perusahaan');
    }

    /**
     * Get count by status
     */
    public static function getStatusCounts()
    {
        return [
            'draft' => self::draft()->count(),
            'waiting_approve' => self::waitingApprove()->count(),
            'approved' => self::approved()->count(),
            'rejected' => self::rejected()->count(),
        ];
    }
}