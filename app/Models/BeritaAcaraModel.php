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
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_ba',
        'perusahaan',
        'tanggal',
        'alamat',
        'no_order',
        'kontak',
        'telp_fax',
        'nama_alat',
        'merek',
        'rentang_ukur',
        'no_seri',
        'keterangan',
        'catatan',
        'request_by',
        'approve_by',
        'created_by',
        'updated_by',
        'status',
         'calibration_id',
    ];
    
    public function calibration()
    {
        return $this->belongsTo(Calibration::class, 'calibration_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
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
     * Scope untuk status selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /**
     * Scope untuk status batal
     */
    public function scopeBatal($query)
    {
        return $query->where('status', 'batal');
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
     * Override method untuk mendapatkan nama kolom primary key
     */
    public function getKeyName()
    {
        return 'id_ba';
    }

    /**
     * Accessor untuk menampilkan status dengan badge
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'draft'   => '<span class="badge bg-secondary">Draft</span>',
            'selesai' => '<span class="badge bg-success">Selesai</span>',
            'batal'   => '<span class="badge bg-danger">Batal</span>',
            default   => '<span class="badge bg-info">' . $this->status . '</span>',
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
     * Generate nomor BA otomatis
     */
    public static function generateNoBa(): string
    {
        $tahun = date('Y');
        $bulan = date('m');
        
        // PASTIKAN MENGGUNAKAN id_ba
        $lastBa = self::whereYear('tanggal', $tahun)
                      ->whereMonth('tanggal', $bulan)
                      ->orderBy('id_ba', 'desc')
                      ->first();
        
        if ($lastBa && $lastBa->no_ba) {
            // Ambil 3 digit terakhir dari no_ba
            $lastNumber = (int) substr($lastBa->no_ba, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        
        return "BA/{$tahun}/{$bulan}/{$newNumber}";
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
                created_by
            ')
            ->groupBy('no_ba', 'perusahaan', 'tanggal', 'status', 'created_by')
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
}