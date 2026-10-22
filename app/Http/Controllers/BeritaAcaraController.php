<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\User;
use App\Models\Calibration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use App\Helpers\LogHelper;

class BeritaAcaraController extends Controller
{
    /**
     * Display a listing of calibration data.
     */
    public function index(Request $request)
    {
        // Query data calibration
        $query = Calibration::query();



        // Filter by date range (tanggalMasuk)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggalMasuk', [$request->start_date, $request->end_date]);
        }

        // Filter by pemilikAlat (perusahaan)
        if ($request->filled('perusahaan')) {
            $query->where('pemilikAlat', 'LIKE', "%{$request->perusahaan}%");
        }

        // Filter by status_transaction
        if ($request->filled('status')) {
            $query->where('status_transaction', $request->status);
        }

        // Filter by search (nama alat, serial number, brand)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('namaAlat', 'LIKE', "%{$request->search}%")
                    ->orWhere('NoSeri', 'LIKE', "%{$request->search}%")
                    ->orWhere('brandAlat', 'LIKE', "%{$request->search}%")
                    ->orWhere('pemilikAlat', 'LIKE', "%{$request->search}%")
                    ->orWhere('no_label', 'LIKE', "%{$request->search}%");
            });
        }

        // Ambil data calibration
        $calibrations = $query->orderBy('tanggalMasuk', 'desc')
            ->orderBy('pemilikAlat', 'asc')
            ->get();

        // Group by tanggalMasuk dan pemilikAlat
        $groupedCalibrations = $calibrations->groupBy(function ($item) {
            return $item->tanggalMasuk . '|' . $item->pemilikAlat . '|' . ($item->no_po ?? '');
        })->map(function ($group, $key) {
            $first = $group->first();

            // Ambil nama yang melakukan kalibrasi dari data pertama
            $calibratedBy = $first->calibrated_by ?? '-';

            return [
                'key' => $key,
                'tanggalMasuk' => $first->tanggalMasuk,
                'pemilikAlat' => $first->pemilikAlat,
                'lokasiPT' => $first->lokasiPT,
                'no_po' => $first->no_po,
                'jumlah_alat' => $group->count(),
                'alat_list' => $group,
                'calibrated_by' => $calibratedBy, // Tambahkan ini
                'has_ba' => $group->contains(function ($item) {
                    return \App\Models\BeritaAcara::where('calibration_id', $item->id)->exists();
                }),
                'ba_status' => $group->map(function ($item) {
                    $ba = \App\Models\BeritaAcara::where('calibration_id', $item->id)->first();
                    return $ba ? $ba->status : null;
                })->filter()->unique()->first(),
                'ba_no' => $group->map(function ($item) {
                    $ba = \App\Models\BeritaAcara::where('calibration_id', $item->id)->first();
                    return $ba ? $ba->no_ba : null;
                })->filter()->unique()->first(),
            ];
        })->values();

        // Filter berdasarkan status BA (has_ba / no_ba)
        if ($request->filled('status_ba')) {
            if ($request->status_ba === 'has_ba') {
                $groupedCalibrations = $groupedCalibrations->filter(function ($group) {
                    return $group['has_ba'] === true;
                });
            } elseif ($request->status_ba === 'no_ba') {
                $groupedCalibrations = $groupedCalibrations->filter(function ($group) {
                    return $group['has_ba'] === false;
                });
            }
        }

        // Pagination manual untuk grouped data
        $perPage = 20;
        $currentPage = $request->get('page', 1);
        $pagedData = $groupedCalibrations->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $calibrations = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $groupedCalibrations->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Get distinct perusahaan for filter dropdown
        $perusahaanList = Calibration::whereNotNull('pemilikAlat')
            ->where('pemilikAlat', '!=', '')
            ->distinct()
            ->orderBy('pemilikAlat')
            ->pluck('pemilikAlat');

        // Status list for filter
        $statusList = ['waiting_verified', 'approved', 'rejected', 'draft'];

        // Ambil nama teknisi untuk ditampilkan di view
        $user = Auth::user();
        $teknisiName = null;
        if ($user && $user->role === 'teknisi') {
            $teknisiName = $user->name ?? $user->nama;
        }

        return view('berita_acara.index', compact('calibrations', 'perusahaanList', 'statusList', 'teknisiName'));
    }


    /**
     * Show the form for creating a new Berita Acara.
     * Bisa dari single calibration atau dari group calibration
     */
    public function create(Request $request)
    {
        // Generate nomor BA dengan format BA-ID-00000
        $newNoBa = BeritaAcara::generateNoBa();

        $calibrations = collect();
        $perusahaan = '';
        $alamat = '';
        $groupInfo = [];

        // Log request untuk debugging
        \Log::info('========== BERITA ACARA CREATE ==========');
        \Log::info('Request parameters:', $request->all());

        // Jika dari group (multiple IDs)
        if ($request->has('ids') && !empty($request->ids)) {
            $ids = explode(',', $request->ids);
            \Log::info('IDs dari request:', ['ids' => $ids, 'count' => count($ids)]);

            $calibrations = Calibration::whereIn('id', $ids)->get();
            \Log::info('Data calibration ditemukan:', ['count' => $calibrations->count()]);

            // 🛡️ PENGAMANAN: Filter ketat agar hanya mengambil alat yang benar-benar satu nama perusahaan & No. PO yang sesuai (jika ada request perusahaan/no_po)
            if ($request->filled('perusahaan')) {
                $targetPt = strtolower(trim($request->perusahaan));
                $calibrations = $calibrations->filter(function ($item) use ($targetPt) {
                    return strtolower(trim($item->pemilikAlat ?? '')) === $targetPt;
                });
            }

            \Log::info('Data calibration setelah difilter:', ['count' => $calibrations->count()]);

            if ($calibrations->isNotEmpty()) {
                $first = $calibrations->first();
                $perusahaan = $first->pemilikAlat ?? $request->perusahaan ?? '';
                $alamat = $first->lokasiPT ?? $request->lokasi ?? '';

                $groupInfo = [
                    'tanggal' => $request->tanggal,
                    'perusahaan' => $perusahaan,
                    'lokasi' => $alamat,
                    'jumlah' => $calibrations->count()
                ];

                \Log::info('Group info:', $groupInfo);
            } else {
                \Log::warning('Tidak ada data calibration ditemukan untuk IDs: ' . $request->ids);
            }
        }
        // Jika dari single calibration
        elseif ($request->has('calibration_id')) {
            $calibration = Calibration::find($request->calibration_id);
            if ($calibration) {
                $calibrations = collect([$calibration]);
                $perusahaan = $calibration->pemilikAlat ?? '';
                $alamat = $calibration->lokasiPT ?? '';
            }
        }

        \Log::info('Data yang dikirim ke view:', [
            'calibrations_count' => $calibrations->count(),
            'perusahaan' => $perusahaan,
            'alamat' => $alamat,
            'groupInfo' => $groupInfo
        ]);
        \Log::info('========================================');

        return view('berita_acara.create', compact('newNoBa', 'calibrations', 'perusahaan', 'alamat', 'groupInfo'));
    }

    /**
     * Store a newly created Berita Acara in storage.
     */
    //   public function store(Request $request)
    // {
    //     // Validasi data utama dan array alat
    //     $validated = $request->validate([
    //         'no_ba'       => 'nullable|string|max:20',
    //         'tanggal'     => 'required|date',
    //         'perusahaan'  => 'required|string|max:255',
    //         'alamat'      => 'required|string|max:500',
    //         'no_order'    => 'nullable|string|max:100',
    //         'kontak'      => 'nullable|string|max:100',
    //         'telp_fax'    => 'nullable|string|max:100',
    //         'request_by'  => 'nullable|string|max:150',
    //         'approve_by'  => 'nullable|string|max:150',
    //         'catatan'     => 'nullable|string',
    //         'alat'        => 'required|array|min:1',
    //         'alat.*.nama_alat'      => 'required|string|max:255',
    //         'alat.*.calibration_id' => 'nullable|string|exists:calibrations,id',
    //         'alat.*.merek'          => 'nullable|string|max:150',
    //         'alat.*.kapasitas'      => 'nullable|string|max:150',
    //         'alat.*.no_seri'        => 'nullable|string|max:100',
    //         'alat.*.keterangan'     => 'nullable|string',
    //         'alat.*.type_alat'      => 'nullable|string|max:150',
    //         'alat.*.no_label'       => 'nullable|string|max:100',
    //     ], [
    //         'alat.required'              => 'Harus ada minimal satu alat yang diinput.',
    //         'alat.min'                   => 'Harus ada minimal satu alat yang diinput.',
    //         'alat.*.nama_alat.required'  => 'Nama alat wajib diisi untuk setiap baris.',
    //     ]);
    
    //     try {
    //         DB::beginTransaction();
    
    //         // ðŸ”¥ CEK APAKAH SUDAH ADA BERITA ACARA DENGAN PT DAN TANGGAL YANG SAMA DAN STATUS APPROVED
    //         $existingApproved = BeritaAcara::where('perusahaan', $validated['perusahaan'])
    //             ->where('tanggal', $validated['tanggal'])
    //             ->where('status', 'approved')
    //             ->exists();
    
    //         if ($existingApproved) {
    //             return redirect()
    //                 ->back()
    //                 ->withInput()
    //                 ->with('error', 'Tidak dapat membuat Berita Acara baru karena sudah ada Berita Acara dengan perusahaan "' . $validated['perusahaan'] . '" dan tanggal "' . $validated['tanggal'] . '" yang sudah DISETUJUI (APPROVED). Silakan buat dengan tanggal berbeda.');
    //         }
    
    //         // Tentukan nomor BA
    //         $no_ba = $request->no_ba;
    //         if (!$no_ba || !preg_match('/^BA-ID-\d{5}$/', $no_ba)) {
    //             $no_ba = BeritaAcara::generateNoBa();
    //         }
    
    //         // Info user
    //         $user = Auth::user();
    //         $createdBy = $user ? $user->name : 'System';
    //         $requestBy = $request->request_by ?: $createdBy;
    
    //         $savedCount = 0;
    //         $alatData = $request->alat;
    
    //         \Log::info('Menyimpan Berita Acara', [
    //             'no_ba'       => $no_ba,
    //             'jumlah_alat' => count($alatData),
    //             'perusahaan'  => $validated['perusahaan'],
    //         ]);
    
    //         foreach ($alatData as $index => $alat) {
    //             // Skip jika nama_alat kosong
    //             if (empty(trim($alat['nama_alat'] ?? ''))) {
    //                 \Log::warning("Baris alat ke-$index dilewati: nama_alat kosong");
    //                 continue;
    //             }
    
    //             BeritaAcara::create([
    //                 'no_ba'          => $no_ba,
    //                 'tanggal'        => $validated['tanggal'],
    //                 'perusahaan'     => $validated['perusahaan'],
    //                 'alamat'         => $validated['alamat'],
    //                 'no_order'       => $validated['no_order'] ?? null,
    //                 'kontak'         => $validated['kontak'] ?? null,
    //                 'telp_fax'       => $validated['telp_fax'] ?? null,
    //                 'catatan'        => $validated['catatan'] ?? null,
    
    //                 // Data per alat
    //                 'nama_alat'      => $alat['nama_alat'],
    //                 'merek'          => $alat['merek']       ?? null,
    //                 'kapasitas'      => $alat['kapasitas'] ?? null,
    //                 'no_seri'        => $alat['no_seri']     ?? null,
    //                 'keterangan'     => $alat['keterangan']  ?? null,
    //                 'type_alat'      => $alat['type_alat']   ?? null,
    //                 'no_label'       => $alat['no_label']    ?? null,
    
    //                 // Relasi ke calibration (jika ada)
    //                 'calibration_id' => $alat['calibration_id'] ?? null,
    
    //                 // Info pembuat & status
    //                 'request_by'     => $requestBy,
    //                 'approve_by'     => $request->approve_by ?? null,
    //                 'created_by'     => $createdBy,
    //                 'status'         => 'waiting_approve',
    //             ]);
    
    //             $savedCount++;
    //         }
    
    //         DB::commit();
    
    //         if ($savedCount === 0) {
    //             return redirect()
    //                 ->back()
    //                 ->withInput()
    //                 ->with('error', 'Tidak ada alat yang valid untuk disimpan. Periksa kembali data alat.');
    //         }
    
    //         LogHelper::log('create_ba', "Membuat Berita Acara baru dengan nomor {$no_ba} ({$savedCount} alat)");
            
    //         return redirect()
    //             ->route('berita-acara.list')
    //             ->with('success', "Berita Acara berhasil disimpan dengan nomor {$no_ba}, Menunggu persetujuan.");
    
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    
    //         \Log::error('Gagal menyimpan Berita Acara', [
    //             'error'   => $e->getMessage(),
    //             'trace'   => $e->getTraceAsString(),
    //             'request' => $request->except(['_token']),
    //         ]);
    
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'Gagal menyimpan Berita Acara: ' . $e->getMessage());
    //     }
    // }

    /**
     * Store a newly created Berita Acara in storage.
     */
    public function store(Request $request)
    {
        // Validasi data utama dan array alat
        $validated = $request->validate([
            'no_ba'       => 'nullable|string|max:20',
            'tanggal'     => 'required|date',
            'perusahaan'  => 'required|string|max:255',
            'alamat'      => 'required|string|max:500',
            'no_order'    => 'nullable|string|max:100',
            'kontak'      => 'required|string|max:100',
            'telp_fax'    => 'nullable|string|max:100',
            'request_by'  => 'nullable|string|max:150',
            'approve_by'  => 'required|string|max:150',
            'catatan'     => 'nullable|string',
            'alat'        => 'required|array|min:1',
            'alat.*.nama_alat'      => 'required|string|max:255',
            'alat.*.calibration_id' => 'nullable|string|exists:calibrations,id',
            'alat.*.merek'          => 'nullable|string|max:150',
            'alat.*.kapasitas'      => 'nullable|string|max:150',
            'alat.*.no_seri'        => 'nullable|string|max:100',
            'alat.*.keterangan'     => 'nullable|string', // ✅ KETERANGAN DIISI MANUAL
            'alat.*.type_alat'      => 'nullable|string|max:150',
            'alat.*.no_label'       => 'nullable|string|max:100',
        ], [
            'alat.required'              => 'Harus ada minimal satu alat yang diinput.',
            'alat.min'                   => 'Harus ada minimal satu alat yang diinput.',
            'alat.*.nama_alat.required'  => 'Nama alat wajib diisi untuk setiap baris.',
            'kontak.required'            => 'Kontak Person wajib diisi.',
            'approve_by.required'        => 'Approve By wajib diisi.',
        ]);

        try {
            DB::beginTransaction();

            // 🔥 CEK APAKAH SUDAH ADA BERITA ACARA DENGAN PT, TANGGAL, DAN NO PO/ORDER YANG SAMA DAN STATUS APPROVED
            $poToCheck = trim($validated['no_order'] ?? '');
            $approvedQuery = BeritaAcara::where('perusahaan', $validated['perusahaan'])
                ->where('tanggal', $validated['tanggal'])
                ->where('status', 'approved');

            if ($poToCheck !== '') {
                $approvedQuery->whereRaw('TRIM(no_order) = ?', [$poToCheck]);
            } else {
                $approvedQuery->where(function ($q) {
                    $q->whereNull('no_order')->orWhereRaw("TRIM(no_order) = ''");
                });
            }

            $existingApproved = $approvedQuery->exists();

            if ($existingApproved) {
                $poMsg = !empty($poToCheck) ? ' dan No. PO/Order "' . $poToCheck . '"' : '';
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Tidak dapat membuat Berita Acara baru karena sudah ada Berita Acara dengan perusahaan "' . $validated['perusahaan'] . '", tanggal "' . $validated['tanggal'] . '"' . $poMsg . ' yang sudah DISETUJUI (APPROVED). Silakan gunakan No. PO/Order berbeda jika ini order terpisah.');
            }

            // Tentukan nomor BA
            // 🛡️ PENGAMAN: Jika nomor BA kosong, format salah, ATAU SUDAH ADA di database,
            // wajib generate nomor baru agar TIDAK MENYATU dengan Berita Acara yang sudah ada!
            $no_ba = $request->no_ba;
            if (!$no_ba || !preg_match('/^BA-ID-\d{5}$/', $no_ba) || BeritaAcara::where('no_ba', $no_ba)->exists()) {
                $no_ba = BeritaAcara::generateNoBa();
            }

            // Info user
            $user = Auth::user();
            $createdBy = $user ? $user->name : 'System';
            $requestBy = $request->request_by ?: $createdBy;

            $savedCount = 0;
            $alatData = $request->alat;

            // 🛡️ Definisikan targetPerusahaan untuk validasi per-alat di bawah
            $targetPerusahaan = strtolower(trim($validated['perusahaan']));

            \Log::info('Menyimpan Berita Acara', [
                'no_ba'       => $no_ba,
                'jumlah_alat' => count($alatData),
                'perusahaan'  => $validated['perusahaan'],
            ]);

            foreach ($alatData as $index => $alat) {
                // Skip jika nama_alat kosong
                if (empty(trim($alat['nama_alat'] ?? ''))) {
                    \Log::warning("Baris alat ke-$index dilewati: nama_alat kosong");
                    continue;
                }

                // 🛡️ PENGAMANAN TAMBAHAN: Pastikan calibration_id yang dikirim benar-benar milik perusahaan yang sesuai
                if (!empty($alat['calibration_id'])) {
                    $calCheck = Calibration::find($alat['calibration_id']);
                    if ($calCheck && strtolower(trim($calCheck->pemilikAlat ?? '')) !== $targetPerusahaan) {
                        \Log::warning("Alat ID {$alat['calibration_id']} (PT: {$calCheck->pemilikAlat}) ditolak masuk ke Berita Acara PT {$validated['perusahaan']}");
                        continue; // Lewati alat yang salah perusahaan
                    }
                }

                BeritaAcara::create([
                    'no_ba'          => $no_ba,
                    'tanggal'        => $validated['tanggal'],
                    'perusahaan'     => $validated['perusahaan'],
                    'alamat'         => $validated['alamat'],
                    'no_order'       => $validated['no_order'] ?? null,
                    'kontak'         => $validated['kontak'] ?? null,
                    'telp_fax'       => $validated['telp_fax'] ?? null,
                    'catatan'        => $validated['catatan'] ?? null,

                    // Data per alat
                    'nama_alat'      => $alat['nama_alat'],
                    'merek'          => $alat['merek']       ?? null,
                    'kapasitas'      => $alat['kapasitas'] ?? null,
                    'no_seri'        => $alat['no_seri']     ?? null,
                    'keterangan'     => $alat['keterangan']  ?? null, // ✅ DARI INPUT MANUAL
                    'type_alat'      => $alat['type_alat']   ?? null,
                    'no_label'       => $alat['no_label']    ?? null,

                    // Relasi ke calibration (jika ada)
                    'calibration_id' => $alat['calibration_id'] ?? null,

                    // Info pembuat & status
                    'request_by'     => $requestBy,
                    'approve_by'     => $request->approve_by ?? null,
                    'created_by'     => $createdBy,
                    'status'         => 'waiting_approve',
                ]);

                $savedCount++;
            }

            DB::commit();

            if ($savedCount === 0) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Tidak ada alat yang valid untuk disimpan. Periksa kembali data alat.');
            }

            LogHelper::log('create_ba', "Membuat Berita Acara baru dengan nomor {$no_ba} ({$savedCount} alat)");

            return redirect()
                ->route('berita-acara.list')
                ->with('success', "Berita Acara berhasil disimpan dengan nomor {$no_ba}, Menunggu persetujuan.");
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Gagal menyimpan Berita Acara', [
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
                'request' => $request->except(['_token']),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan Berita Acara: ' . $e->getMessage());
        }
    }

    public function list(Request $request)
    {
        \Log::info('========== LIST BERITA ACARA ==========');

        $query = BeritaAcara::query()
            ->selectRaw('
            no_ba,
            MIN(tanggal) as tanggal,
            MIN(perusahaan) as perusahaan,
            MIN(alamat) as alamat,
            COUNT(*) as jumlah_alat,
            GROUP_CONCAT(nama_alat SEPARATOR ", ") as nama_alat_list,
            MIN(kapasitas) as kapasitas,
            MIN(status) as status,
            MIN(catatan) as catatan
        ')
            ->groupBy('no_ba')
            ->orderByRaw('MAX(created_at) DESC');

        // ================ FILTER BERDASARKAN ROLE ================
        $user = Auth::user();

        // Jika role adalah teknisi, hanya tampilkan data BA yang terkait dengan calibration yang calibrated_by-nya sama dengan nama user
        if ($user && $user->role === 'teknisi') {
            $userName = $user->nama;
            \Log::info('Filter untuk teknisi: ' . $userName);

            $query->whereIn('no_ba', function ($subQuery) use ($userName) {
                $subQuery->select('no_ba')
                    ->from('berita_acara')
                    ->whereIn('calibration_id', function ($calSubQuery) use ($userName) {
                        $calSubQuery->select('id')
                            ->from('calibrations')
                            ->where('calibratedBy', $userName);
                    });
            });
        }
        // =========================================================

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        // Filter by perusahaan
        if ($request->filled('perusahaan')) {
            $query->where('perusahaan', 'LIKE', "%{$request->perusahaan}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by search (nama alat atau no_ba)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('no_ba', 'LIKE', "%{$request->search}%")
                    ->orWhere('nama_alat_list', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan', 'LIKE', "%{$request->search}%");
            });
        }

        $beritaAcara = $query->get();

        \Log::info('Jumlah data BA ditemukan: ' . $beritaAcara->count());

        // 🔥 AMBIL DATA calibratedBy DARI TABEL CALIBRATION UNTUK SETIAP NO_BA
        foreach ($beritaAcara as $ba) {
            \Log::info('Processing BA: ' . $ba->no_ba);

            // Cari calibration_id dari salah satu record dengan no_ba yang sama
            $firstRecord = BeritaAcara::where('no_ba', $ba->no_ba)->first();
            \Log::info('First record calibration_id: ' . ($firstRecord ? $firstRecord->calibration_id : 'null'));

            if ($firstRecord && $firstRecord->calibration_id) {
                $calibration = Calibration::find($firstRecord->calibration_id);
                if ($calibration) {
                    $ba->calibratedBy = $calibration->calibratedBy ?? '-';
                    \Log::info('calibratedBy ditemukan: ' . $ba->calibratedBy);
                } else {
                    $ba->calibratedBy = '-';
                    \Log::warning('Calibration tidak ditemukan untuk ID: ' . $firstRecord->calibration_id);
                }
            } else {
                $ba->calibratedBy = '-';
                \Log::info('Tidak ada calibration_id untuk BA: ' . $ba->no_ba);
            }
        }

        // Log semua data untuk debugging
        \Log::info('Data BA setelah diproses:');
        foreach ($beritaAcara as $ba) {
            \Log::info('  - ' . $ba->no_ba . ' | calibratedBy: ' . ($ba->calibratedBy ?? 'NULL'));
        }
        \Log::info('========================================');

        // Get distinct perusahaan for filter dropdown
        $perusahaanList = BeritaAcara::distinct('perusahaan')
            ->whereNotNull('perusahaan')
            ->orderBy('perusahaan')
            ->pluck('perusahaan');

        // Ambil nama teknisi untuk ditampilkan di view
        $teknisiName = null;
        if ($user && $user->role === 'teknisi') {
            $teknisiName = $user->nama;
        }

        return view('berita_acara.list', compact('beritaAcara', 'perusahaanList', 'teknisiName'));
    }
    // public function editModal($id)
    // {
    //     $beritaAcara = BeritaAcara::find($id);

    //     if (!$beritaAcara) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Data Berita Acara tidak ditemukan'
    //         ], 404);
    //     }

    //     // Format tanggal untuk input type="date"
    //     $tanggalFormatted = $beritaAcara->tanggal ? Carbon::parse($beritaAcara->tanggal)->format('Y-m-d') : null;

    //     return response()->json([
    //         'success'     => true,
    //         'id'          => $beritaAcara->id_ba,
    //         'id_ba'       => $beritaAcara->id_ba,
    //         'no_ba'       => $beritaAcara->no_ba,
    //         'tanggal'     => $tanggalFormatted,
    //         'perusahaan'  => $beritaAcara->perusahaan,
    //         'alamat'      => $beritaAcara->alamat,
    //         'no_order'    => $beritaAcara->no_order,
    //         'kontak'      => $beritaAcara->kontak,
    //         'telp_fax'    => $beritaAcara->telp_fax,
    //         'request_by'  => $beritaAcara->request_by,
    //         'approve_by'  => $beritaAcara->approve_by,
    //         'nama_alat'   => $beritaAcara->nama_alat,
    //         'merek'       => $beritaAcara->merek,
    //         'kapasitas'=> $beritaAcara->kapasitas,
    //         'no_seri'     => $beritaAcara->no_seri,
    //         'keterangan'  => $beritaAcara->keterangan,
    //         'catatan'     => $beritaAcara->catatan,
    //         'status'      => $beritaAcara->status,
    //         'calibration' => $beritaAcara->calibration ? true : false,
    //     ]);
    // }

    public function editModal($id)
    {
        $beritaAcara = BeritaAcara::find($id);

        if (!$beritaAcara) {
            return response()->json([
                'success' => false,
                'message' => 'Data Berita Acara tidak ditemukan'
            ], 404);
        }

        // Format tanggal untuk input type="date"
        $tanggalFormatted = $beritaAcara->tanggal ? Carbon::parse($beritaAcara->tanggal)->format('Y-m-d') : null;

        return response()->json([
            'success'     => true,
            'id'          => $beritaAcara->id_ba,
            'id_ba'       => $beritaAcara->id_ba,
            'no_ba'       => $beritaAcara->no_ba,
            'tanggal'     => $tanggalFormatted,
            'perusahaan'  => $beritaAcara->perusahaan,
            'alamat'      => $beritaAcara->alamat,
            'no_order'    => $beritaAcara->no_order,
            'kontak'      => $beritaAcara->kontak,
            'telp_fax'    => $beritaAcara->telp_fax,
            'request_by'  => $beritaAcara->request_by,
            'approve_by'  => $beritaAcara->approve_by,
            'nama_alat'   => $beritaAcara->nama_alat,
            'merek'       => $beritaAcara->merek,
            'kapasitas'   => $beritaAcara->kapasitas,
            'no_seri'     => $beritaAcara->no_seri,
            'keterangan'  => $beritaAcara->keterangan ?? '', // ✅ AMBIL DARI BERITA ACARA
            'catatan'     => $beritaAcara->catatan,
            'status'      => $beritaAcara->status,
            'calibration' => $beritaAcara->calibration ? true : false,
        ]);
    }

    //   public function updateModal(Request $request, $id)
    // {
    //     $beritaAcara = BeritaAcara::find($id);

    //     if (!$beritaAcara) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Data Berita Acara tidak ditemukan'
    //         ], 404);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'tanggal'      => 'required|date',
    //         'nama_alat'    => 'required|string|max:255',
    //         'perusahaan'   => 'nullable|string|max:255',
    //         'alamat'       => 'nullable|string',
    //         'no_order'     => 'nullable|string|max:100',
    //         'kontak'       => 'nullable|string|max:100',
    //         'telp_fax'     => 'nullable|string|max:100',
    //         'request_by'   => 'nullable|string|max:100',
    //         'approve_by'   => 'nullable|string|max:100',
    //         'merek'        => 'nullable|string|max:100',
    //         'kapasitas' => 'nullable|string|max:100',
    //         'no_seri'      => 'nullable|string|max:100',
    //         'keterangan'   => 'nullable|string',
    //         'catatan'      => 'nullable|string',
    //         'status'       => 'sometimes|in:draft,waiting_approve,approved,rejected,selesai,batal',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validasi gagal',
    //             'errors'  => $validator->errors()
    //         ], 422);
    //     }

    //     try {
    //         $currentUser = Auth::user();
    //         $updatedByName = $currentUser ? $currentUser->name : 'System';

    //         $updateData = [
    //             'tanggal'      => $request->tanggal,
    //             'perusahaan'   => $request->perusahaan,
    //             'alamat'       => $request->alamat,
    //             'no_order'     => $request->no_order,
    //             'kontak'       => $request->kontak,
    //             'telp_fax'     => $request->telp_fax,
    //             'request_by'   => $request->request_by,
    //             'approve_by'   => $request->approve_by,
    //             'nama_alat'    => $request->nama_alat,
    //             'merek'        => $request->merek,
    //             'kapasitas' => $request->kapasitas,
    //             'no_seri'      => $request->no_seri,
    //             'keterangan'   => $request->keterangan,
    //             'catatan'      => $request->catatan,
    //             'updated_by'   => $updatedByName,
    //         ];

    //         // Update status hanya jika dikirim
    //         if ($request->has('status')) {
    //             $updateData['status'] = $request->status;
    //         }

    //         $beritaAcara->update($updateData);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Berita Acara berhasil diperbarui',
    //             'no_ba'   => $beritaAcara->no_ba
    //         ]);

    //     } catch (\Exception $e) {
    //         \Log::error('ERROR updateModal: ' . $e->getMessage(), [
    //             'id'    => $id,
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengupdate: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function updateModal(Request $request, $id)
    {
        $beritaAcara = BeritaAcara::find($id);

        if (!$beritaAcara) {
            return response()->json([
                'success' => false,
                'message' => 'Data Berita Acara tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tanggal'      => 'required|date',
            'nama_alat'    => 'required|string|max:255',
            'perusahaan'   => 'nullable|string|max:255',
            'alamat'       => 'nullable|string',
            'no_order'     => 'nullable|string|max:100',
            'kontak'       => 'nullable|string|max:100',
            'telp_fax'     => 'nullable|string|max:100',
            'request_by'   => 'nullable|string|max:100',
            'approve_by'   => 'nullable|string|max:100',
            'merek'        => 'nullable|string|max:100',
            'kapasitas'    => 'nullable|string|max:100',
            'no_seri'      => 'nullable|string|max:100',
            'keterangan'   => 'nullable|string', // ✅ BISA DIISI MANUAL
            'catatan'      => 'nullable|string',
            'status'       => 'sometimes|in:draft,waiting_approve,approved,rejected,selesai,batal',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $currentUser = Auth::user();
            $updatedByName = $currentUser ? $currentUser->name : 'System';

            $updateData = [
                'tanggal'      => $request->tanggal,
                'perusahaan'   => $request->perusahaan,
                'alamat'       => $request->alamat,
                'no_order'     => $request->no_order,
                'kontak'       => $request->kontak,
                'telp_fax'     => $request->telp_fax,
                'request_by'   => $request->request_by,
                'approve_by'   => $request->approve_by,
                'nama_alat'    => $request->nama_alat,
                'merek'        => $request->merek,
                'kapasitas'    => $request->kapasitas,
                'no_seri'      => $request->no_seri,
                'keterangan'   => $request->keterangan, // ✅ DIISI DARI INPUT
                'catatan'      => $request->catatan,
                'updated_by'   => $updatedByName,
            ];

            // Update status hanya jika dikirim
            if ($request->has('status')) {
                $updateData['status'] = $request->status;
            }

            $beritaAcara->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Berita Acara berhasil diperbarui',
                'no_ba'   => $beritaAcara->no_ba
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR updateModal: ' . $e->getMessage(), [
                'id'    => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified Berita Acara.
     */
    public function show($no_ba)
    {
        // Ambil semua alat dengan no_ba yang sama
        $beritaAcara = BeritaAcara::where('no_ba', $no_ba)
            ->with('calibration')
            ->orderBy('id_ba', 'asc')
            ->get();

        if ($beritaAcara->isEmpty()) {
            return redirect()
                ->route('berita-acara.list')
                ->with('error', 'Data tidak ditemukan.');
        }

        $header = $beritaAcara->first(); // Data header (sama untuk semua)
        $alatList = $beritaAcara; // Koleksi semua alat

        return view('berita_acara.show', compact('header', 'alatList'));
    }

    /**
     * Show the form for editing the specified Berita Acara.
     */
    public function edit($id)
    {
        $beritaAcara = BeritaAcara::findOrFail($id);

        return view('berita_acara.edit', compact('beritaAcara'));
    }

    /**
     * Update the specified Berita Acara in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'tanggal' => 'required|date',
    //         'nama_alat' => 'required|string',
    //     ], [
    //         'tanggal.required' => 'Tanggal harus diisi',
    //         'nama_alat.required' => 'Nama alat harus diisi',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()
    //             ->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         $beritaAcara = BeritaAcara::findOrFail($id);

    //         // Ambil nama user yang login untuk updated_by
    //         $currentUser = Auth::user();
    //         $updatedByName = $currentUser ? $currentUser->name : 'System';

    //         \Log::info('========== UPDATE BERITA ACARA ==========');
    //         \Log::info('ID: ' . $id);
    //         \Log::info('User: ' . $updatedByName);
    //         \Log::info('Data Update:', $request->all());

    //         $beritaAcara->update([
    //             'perusahaan' => $request->perusahaan,
    //             'tanggal' => $request->tanggal,
    //             'alamat' => $request->alamat,
    //             'no_order' => $request->no_order,
    //             'kontak' => $request->kontak,
    //             'telp_fax' => $request->telp_fax,
    //             'nama_alat' => $request->nama_alat,
    //             'merek' => $request->merek,
    //             'kapasitas' => $request->kapasitas,
    //             'no_seri' => $request->no_seri,
    //             'keterangan' => $request->keterangan,
    //             'catatan' => $request->catatan,
    //             'request_by' => $request->request_by,
    //             'approve_by' => $request->approve_by,
    //             'updated_by' => $updatedByName,
    //             'status' => $request->status ?? 'waiting_approve',
    //         ]);

    //         \Log::info('Update berhasil');
    //         \Log::info('========================================');

    //         LogHelper::log('update_ba', "Mengupdate item Berita Acara {$beritaAcara->no_ba} - ID: {$beritaAcara->id}", $beritaAcara);

    //         return redirect()
    //             ->route('berita-acara.show', $beritaAcara->no_ba)
    //             ->with('success', 'Data berita acara berhasil diupdate.');

    //     } catch (\Exception $e) {
    //         \Log::error('ERROR update: ' . $e->getMessage());

    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
    //     }
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'nama_alat' => 'required|string',
            'keterangan' => 'nullable|string', // ✅ TAMBAHKAN VALIDASI
        ], [
            'tanggal.required' => 'Tanggal harus diisi',
            'nama_alat.required' => 'Nama alat harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $beritaAcara = BeritaAcara::findOrFail($id);

            $currentUser = Auth::user();
            $updatedByName = $currentUser ? $currentUser->name : 'System';

            \Log::info('========== UPDATE BERITA ACARA ==========');
            \Log::info('ID: ' . $id);
            \Log::info('User: ' . $updatedByName);
            \Log::info('Data Update:', $request->all());

            $beritaAcara->update([
                'perusahaan' => $request->perusahaan,
                'tanggal' => $request->tanggal,
                'alamat' => $request->alamat,
                'no_order' => $request->no_order,
                'kontak' => $request->kontak,
                'telp_fax' => $request->telp_fax,
                'nama_alat' => $request->nama_alat,
                'merek' => $request->merek,
                'kapasitas' => $request->kapasitas,
                'no_seri' => $request->no_seri,
                'keterangan' => $request->keterangan, // ✅ DIISI DARI INPUT
                'catatan' => $request->catatan,
                'request_by' => $request->request_by,
                'approve_by' => $request->approve_by,
                'updated_by' => $updatedByName,
                'status' => $request->status ?? 'waiting_approve',
            ]);

            \Log::info('Update berhasil');
            \Log::info('========================================');

            LogHelper::log('update_ba', "Mengupdate item Berita Acara {$beritaAcara->no_ba} - ID: {$beritaAcara->id}", $beritaAcara);

            return redirect()
                ->route('berita-acara.show', $beritaAcara->no_ba)
                ->with('success', 'Data berita acara berhasil diupdate.');
        } catch (\Exception $e) {
            \Log::error('ERROR update: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified Berita Acara from storage.
     */
    public function destroy($id)
    {
        try {
            $beritaAcara = BeritaAcara::findOrFail($id);
            $noBa = $beritaAcara->no_ba;

            \Log::info('========== DELETE BERITA ACARA ==========');
            \Log::info('ID: ' . $id);
            \Log::info('No BA: ' . $noBa);

            $beritaAcara->delete();

            $remaining = BeritaAcara::where('no_ba', $noBa)->count();

            \Log::info('Sisa data dengan No BA ' . $noBa . ': ' . $remaining);
            \Log::info('========================================');

            LogHelper::log('delete_ba_item', "Menghapus item alat dari Berita Acara {$noBa} - ID: {$id}");

            if ($remaining > 0) {
                return redirect()
                    ->route('berita-acara.show', $noBa)
                    ->with('success', 'Data alat berhasil dihapus.');
            }

            return redirect()
                ->route('berita-acara.list')
                ->with('success', 'Semua data berita acara berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error('ERROR delete: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Remove all items with same no_ba.
     */
    public function destroyAll($no_ba)
    {
        try {
            \Log::info('========== DELETE ALL BERITA ACARA ==========');
            \Log::info('No BA: ' . $no_ba);

            // Hapus semua record dengan no_ba yang sama
            BeritaAcara::where('no_ba', $no_ba)->delete();

            \Log::info('Delete all berhasil');
            \Log::info('========================================');

            return redirect()
                ->route('berita-acara.list')
                ->with('success', 'Berita Acara berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error('ERROR deleteAll: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Approve Berita Acara - Menampilkan halaman approval
     */
    public function approval($no_ba)
    {
        // \Log::info('Accessing approval page for BA: ' . $no_ba);

        $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->get();

        if ($beritaAcara->isEmpty()) {
            \Log::error('Berita Acara not found: ' . $no_ba);
            return redirect()->back()->with('error', 'Berita Acara tidak ditemukan.');
        }

        $header = $beritaAcara->first();
        $alatList = $beritaAcara;

        // Format tanggal jika perlu
        if ($header->tanggal) {
            $header->tanggal_formatted = Carbon::parse($header->tanggal)->format('d/m/Y');
        }

        // GENERATE TOKEN UNTUK PUBLIC APPROVAL LINK
        if (!$header->approval_token) {
            $token = bin2hex(random_bytes(32)); // 64 karakter hex
            $expiresAt = now()->addDays(7); // Berlaku 7 hari

            BeritaAcara::where('no_ba', $no_ba)->update([
                'approval_token' => $token,
                'token_expires_at' => $expiresAt
            ]);

            $header->approval_token = $token;
        }

        return view('berita_acara.approval', compact('header', 'alatList', 'no_ba'));
    }
    /**
     * Menolak Berita Acara
     */
    public function reject(Request $request, $no_ba)
    {
        try {
            DB::beginTransaction();

            $currentUser = Auth::user();
            $rejectedByName = $currentUser ? $currentUser->name : 'System';

            // Update semua record dengan no_ba yang sama
            $updated = BeritaAcara::where('no_ba', $no_ba)
                ->update([
                    'status' => 'rejected',
                    'rejected_by' => $rejectedByName,
                    'rejected_at' => now(),
                    'rejection_reason' => $request->rejection_reason,
                ]);

            DB::commit();

            \Log::info('Berita Acara rejected', ['no_ba' => $no_ba, 'updated' => $updated]);

            return redirect()
                ->route('berita-acara.show', $no_ba)
                ->with('success', 'Berita Acara ditolak. (' . $updated . ' alat)');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error rejecting BA: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menolak Berita Acara: ' . $e->getMessage());
        }
    }

    /**
     * API: Menyimpan approval dari client
     */
    public function approve(Request $request)
    {
        \Log::info('========== APPROVE REQUEST RECEIVED ==========');
        \Log::info('Request data:', $request->all());

        try {
            DB::beginTransaction();

            // Validasi input
            $validator = Validator::make($request->all(), [
                'no_ba' => 'required|string',
                'approval_method' => 'required|in:whatsapp,signature',
                'client_phone' => 'nullable|string|max:20',
                'signature' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();
            $no_ba = $validated['no_ba'];
            $method = $validated['approval_method'];
            $clientPhone = $validated['client_phone'] ?? null;
            $signature = $validated['signature'] ?? null;

            \Log::info('Processing approval:', [
                'no_ba' => $no_ba,
                'method' => $method,
                'clientPhone' => $clientPhone,
                'hasSignature' => !empty($signature)
            ]);

            // Cek apakah nomor BA ada di database
            $baExists = BeritaAcara::where('no_ba', $no_ba)->exists();

            if (!$baExists) {
                \Log::error('BA not found in database: ' . $no_ba);
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara dengan nomor ' . $no_ba . ' tidak ditemukan'
                ], 404);
            }

            // Cek apakah sudah pernah di-approve
            $existingApproval = BeritaAcara::where('no_ba', $no_ba)
                ->where('status', 'approved')
                ->exists();

            if ($existingApproval) {
                \Log::warning('BA already approved: ' . $no_ba);
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara sudah disetujui sebelumnya'
                ], 400);
            }

            // Get current user
            $user = Auth::user();
            $approvedBy = $user ? $user->name : 'Client';

            // Variabel untuk menyimpan URL signature
            $signatureUrl = null;

            // Jika method signature dan ada signature, simpan file
            if ($method === 'signature' && $signature) {
                try {
                    \Log::info('Attempting to save signature image for BA: ' . $no_ba);
                    $signatureUrl = $this->saveSignatureImage($signature, $no_ba);
                    \Log::info('Signature saved successfully', ['url' => $signatureUrl]);
                } catch (\Exception $e) {
                    \Log::error('Failed to save signature:', ['error' => $e->getMessage()]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal menyimpan tanda tangan: ' . $e->getMessage()
                    ], 500);
                }
            } else {
                \Log::info('No signature to save for method: ' . $method);
            }

            // Update status approved
            $updateData = [
                'status' => 'approved',
                'approve_by' => $approvedBy,
                'approval_method' => $method,
                'client_phone' => $clientPhone,
                'approval_signature' => $signatureUrl,
                'approved_at' => now(),
                'updated_at' => now()
            ];

            \Log::info('Updating database with:', $updateData);

            $updated = BeritaAcara::where('no_ba', $no_ba)
                ->update($updateData);

            \Log::info('Database update result:', ['rows_affected' => $updated]);

            if ($updated === 0) {
                throw new \Exception('Tidak ada data yang diupdate - possible database error');
            }

            // Ambil data yang sudah diupdate untuk dipastikan
            $updatedData = BeritaAcara::where('no_ba', $no_ba)->first();
            \Log::info('Updated record:', [
                'no_ba' => $updatedData->no_ba,
                'status' => $updatedData->status,
                'approval_method' => $updatedData->approval_method,
                'approval_signature' => $updatedData->approval_signature,
                'client_phone' => $updatedData->client_phone
            ]);

            DB::commit();
            \Log::info('Approval completed successfully for BA: ' . $no_ba);

            // Generate PDF setelah approve (di luar transaction)
            $pdfResult = null;
            try {
                // Panggil fungsi export PDF
                $pdfResult = $this->generateAndSavePdf($no_ba);
                \Log::info('PDF generated after approval', $pdfResult);
            } catch (\Exception $e) {
                \Log::warning('Failed to generate PDF after approval: ' . $e->getMessage());
                // Jangan gagalkan proses jika PDF gagal
            }

            // Kirim notifikasi ke nomor admin
            if ($clientPhone) {
                try {
                    $this->sendWhatsAppNotification($no_ba, $clientPhone, $method);
                } catch (\Exception $e) {
                    \Log::warning('Failed to send WA notification:', ['error' => $e->getMessage()]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berita Acara berhasil disetujui',
                'data' => [
                    'no_ba' => $no_ba,
                    'status' => 'approved',
                    'method' => $method,
                    'client_phone' => $clientPhone,
                    'signature_url' => $signatureUrl,
                    'approved_at' => now()->toDateTimeString(),
                    'pdf' => $pdfResult
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error approving Berita Acara', [
                'no_ba' => $request->no_ba ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyetujui Berita Acara: ' . $e->getMessage()
            ], 500);
        } finally {
            \Log::info('========== APPROVE REQUEST END ==========');
        }
    }
    private function generateAndSavePdf($no_ba)
    {
        try {
            // Ambil data berita acara
            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->get();
            $header = $beritaAcara->first();
            $alatList = $beritaAcara;

            // Format tanggal
            if ($header->tanggal) {
                $header->tanggal_formatted = Carbon::parse($header->tanggal)->format('d/m/Y');
            }

            // Generate PDF dengan ukuran yang lebih kecil
            $pdf = Pdf::loadView('berita_acara.pdf', compact('header', 'alatList', 'no_ba'));

            // Set ukuran kertas dan orientasi LANDSCAPE
            $pdf->setPaper('A4', 'landscape');

            // Perkecil margin agar muat 1 halaman
            $pdf->setOptions([
                'margin-left' => 10,
                'margin-right' => 10,
                'margin-top' => 10,
                'margin-bottom' => 10,
            ]);

            // Tentukan folder penyimpanan di PUBLIC path
            $folderPath = public_path('pdf_berita_acara');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            // NAMA FILE ASLI - TANPA ENKRIPSI
            // Format: berita_acara_BA-ID-00004.pdf
            $fileName = 'berita_acara_' . $no_ba . '.pdf';
            $filePath = $folderPath . '/' . $fileName;

            // HAPUS PDF LAMA jika ada
            if ($header->pdf_path) {
                $oldFilePath = public_path('pdf_berita_acara/' . $header->pdf_path);
                if (file_exists($oldFilePath) && is_file($oldFilePath)) {
                    unlink($oldFilePath);
                    \Log::info('Old PDF deleted', ['file' => $header->pdf_path]);
                }
            }

            // Simpan PDF ke file dengan nama asli
            $pdf->save($filePath);

            // Cek apakah file berhasil dibuat
            if (!file_exists($filePath)) {
                throw new \Exception('File PDF gagal dibuat');
            }

            // Simpan ke database (nama file sama)
            BeritaAcara::where('no_ba', $no_ba)->update([
                'pdf_path' => $fileName,              // Nama file asli
                'pdf_original_name' => $fileName,      // Nama asli (sama)
                'pdf_generated_at' => now()
            ]);

            // URL untuk akses publik (dengan nama asli)
            $url = asset('pdf_berita_acara/' . $fileName);

            \Log::info('PDF generated with readable filename', [
                'no_ba' => $no_ba,
                'file_name' => $fileName,
                'url' => $url
            ]);

            return [
                'success' => true,
                'file_name' => $fileName,
                'url' => $url
            ];
        } catch (\Exception $e) {
            \Log::error('Failed to generate PDF: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }



    /**
     * Fungsi untuk mengirim notifikasi WhatsApp ke admin
     * Mengirim dari nomor client ke nomor admin 08889150150
     */
    private function sendWhatsAppNotification($no_ba, $clientPhone, $method)
    {
        try {
            $adminPhone = '08889150150'; // 08889150150 dalam format internasional

            // Bersihkan nomor client (ambil angka saja)
            $cleanClientPhone = preg_replace('/[^0-9]/', '', $clientPhone);
            if (substr($cleanClientPhone, 0, 1) === '0') {
                $cleanClientPhone = '62' . substr($cleanClientPhone, 1);
            }

            // Ambil data berita acara
            $ba = BeritaAcara::where('no_ba', $no_ba)->first();

            // Format pesan yang akan dikirim
            $message = "âœ… *APPROVAL BERITA ACARA*\n\n";
            $message .= "Nomor BA: {$no_ba}\n";
            $message .= "Perusahaan: " . ($ba->perusahaan ?? '-') . "\n";
            $message .= "Client: " . ($ba->kontak ?? '-') . "\n";
            $message .= "Metode Approval: " . ($method === 'signature' ? 'Tanda Tangan Langsung' : 'Scan QR Code') . "\n";
            $message .= "Nomor WA Client: {$cleanClientPhone}\n";
            $message .= "Waktu: " . now()->format('d/m/Y H:i:s') . "\n\n";
            $message .= "Status: âœ“ DISETUJUI";

            // URL WhatsApp (client ke admin)
            $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

            // Log untuk tracking
            \Log::info('WhatsApp notification prepared', [
                'from' => $cleanClientPhone,
                'to' => $adminPhone,
                'url' => $waUrl
            ]);

            // TODO: Implementasikan pengiriman WhatsApp menggunakan:
            // 1. WhatsApp Business API
            // 2. atau layanan pihak ketiga seperti Fonnte, Wablas, dll

            return $waUrl;
        } catch (\Exception $e) {
            \Log::error('Gagal kirim notifikasi WA', [
                'error' => $e->getMessage(),
                'no_ba' => $no_ba
            ]);

            return null;
        }
    }

    /**
     * Fungsi untuk menyimpan signature base64 sebagai file PNG
     */
    private function saveSignatureImage($base64Signature, $no_ba)
    {
        try {
            \Log::info('Starting to save signature for BA: ' . $no_ba);

            // Cek apakah base64 valid
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Signature, $type)) {
                \Log::info('Base64 format valid, type: ' . $type[1]);

                $base64Signature = substr($base64Signature, strpos($base64Signature, ',') + 1);
                $type = strtolower($type[1]);

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                    throw new \Exception('Tipe gambar tidak didukung: ' . $type);
                }

                $base64Signature = str_replace(' ', '+', $base64Signature);
                $imageData = base64_decode($base64Signature);

                if ($imageData === false) {
                    throw new \Exception('Base64 decode gagal');
                }

                \Log::info('Base64 decoded successfully, size: ' . strlen($imageData) . ' bytes');
            } else {
                throw new \Exception('Format base64 tidak valid');
            }

            // Buat folder jika belum ada
            $folderPath = public_path('img_ttd');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
                \Log::info('Created folder: ' . $folderPath);
            } else {
                \Log::info('Folder already exists: ' . $folderPath);
            }

            // Cek permission folder
            if (!is_writable($folderPath)) {
                throw new \Exception('Folder tidak dapat ditulis: ' . $folderPath);
            }

            // Generate nama file unik
            $timestamp = now()->format('Ymd_His');
            $randomString = substr(md5(uniqid()), 0, 8);
            $fileName = "ttd_{$no_ba}_{$timestamp}_{$randomString}.png";

            $filePath = $folderPath . '/' . $fileName;

            // Simpan file
            $bytesWritten = file_put_contents($filePath, $imageData);

            if ($bytesWritten === false) {
                throw new \Exception('Gagal menulis file');
            }

            \Log::info('File written successfully', [
                'path' => $filePath,
                'bytes' => $bytesWritten
            ]);

            // URL untuk diakses dari web
            $url = asset('img_ttd/' . $fileName);

            \Log::info('Signature saved successfully', [
                'no_ba' => $no_ba,
                'file' => $fileName,
                'bytes' => $bytesWritten,
                'url' => $url
            ]);

            return $url;
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan signature', [
                'no_ba' => $no_ba,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new \Exception('Gagal menyimpan file tanda tangan: ' . $e->getMessage());
        }
    }

    /**
     * API: Cek status approval
     */
    public function checkApprovalStatus($no_ba)
    {
        try {


            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->first();

            if (!$beritaAcara) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara tidak ditemukan'
                ], 404);
            }

            $isApproved = $beritaAcara->status === 'approved';

            $approvalData = null;
            if ($isApproved) {
                $approvalData = [
                    'method' => $beritaAcara->approval_method,
                    'client_phone' => $beritaAcara->client_phone,
                    'signature_url' => $beritaAcara->approval_signature,
                    'approved_at' => $beritaAcara->approved_at ?
                        Carbon::parse($beritaAcara->approved_at)->format('Y-m-d H:i:s') : null,
                    'approved_by' => $beritaAcara->approve_by
                ];
            }

            return response()->json([
                'success' => true,
                'approved' => $isApproved,
                'no_ba' => $no_ba,
                'status' => $beritaAcara->status,
                'approval_data' => $approvalData
            ]);
        } catch (\Exception $e) {
            \Log::error('Error checking approval status', [
                'no_ba' => $no_ba,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal cek status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate QR Code data dengan nomor client
     */
    public function generateQRData($no_ba)
    {
        try {
            \Log::info('Generating QR data for BA: ' . $no_ba);

            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->first();

            if (!$beritaAcara) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara tidak ditemukan'
                ], 404);
            }

            // Data yang akan dimasukkan ke QR code
            $qrData = [
                'no_ba' => $no_ba,
                'method' => 'whatsapp',
                'timestamp' => now()->timestamp
            ];

            return response()->json([
                'success' => true,
                'data' => $qrData
            ]);
        } catch (\Exception $e) {
            \Log::error('Error generating QR data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal generate QR data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Generate token untuk QR code approval
     */
    public function generateApprovalToken($no_ba)
    {
        try {
            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->first();

            if (!$beritaAcara) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara tidak ditemukan'
                ], 404);
            }

            // Generate unique token
            $token = md5($no_ba . time() . uniqid());

            // Simpan token ke database
            BeritaAcara::where('no_ba', $no_ba)
                ->update(['approval_token' => $token]);

            return response()->json([
                'success' => true,
                'token' => $token,
                'approval_url' => url("/berita-acara/approval/{$no_ba}?token={$token}")
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal generate token: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get detail approval untuk halaman approval
     */
    public function getApprovalDetail($no_ba)
    {
        try {
            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->get();

            if ($beritaAcara->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara tidak ditemukan'
                ], 404);
            }

            $header = $beritaAcara->first();

            // Format data
            $data = [
                'no_ba' => $header->no_ba,
                'tanggal' => $header->tanggal ? $header->tanggal->format('Y-m-d') : null,
                'tanggal_formatted' => $header->tanggal ? $header->tanggal->format('d/m/Y') : null,
                'perusahaan' => $header->perusahaan,
                'alamat' => $header->alamat,
                'no_order' => $header->no_order,
                'kontak' => $header->kontak,
                'telp_fax' => $header->telp_fax,
                'request_by' => $header->request_by,
                'catatan' => $header->catatan,
                'status' => $header->status,
                'is_approved' => $header->status === 'approved',
                'approval_data' => null,
                'alat_list' => []
            ];

            // Data approval jika sudah approved
            if ($header->status === 'approved') {
                $data['approval_data'] = [
                    'method' => $header->approval_method,
                    'client_phone' => $header->client_phone,
                    'signature_url' => $header->approval_signature,
                    'approved_at' => $header->approved_at ?
                        $header->approved_at->format('Y-m-d H:i:s') : null,
                    'approved_by' => $header->approve_by
                ];
            }

            // Data alat
            foreach ($beritaAcara as $alat) {
                $data['alat_list'][] = [
                    'nama_alat' => $alat->nama_alat,
                    'merek' => $alat->merek,
                    'kapasitas' => $alat->kapasitas,
                    'no_seri' => $alat->no_seri,
                    'keterangan' => $alat->keterangan
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal ambil data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format rentang ukur dari data calibration.
     */
    private function formatRentangUkur($calibration)
    {
        $parts = [];

        // Ambil rangeMin dan rangeMax dari database
        if (!empty($calibration->rangeMin) && !empty($calibration->rangeMax)) {
            $rangeText = $calibration->rangeMin . ' - ' . $calibration->rangeMax;

            // Tambahkan satuan jika ada
            if (!empty($calibration->satuan)) {
                $rangeText .= ' ' . $calibration->satuan;
            }

            $parts[] = $rangeText;
        }

        // Tambahkan informasi kapasitas jika ada
        if (!empty($calibration->kapasitas)) {
            $parts[] = 'Kap: ' . $calibration->kapasitas;
        }

        // Tambahkan informasi resolusi jika ada
        if (!empty($calibration->resolusi)) {
            $parts[] = 'Res: ' . $calibration->resolusi;
        }

        return !empty($parts) ? implode(' | ', $parts) : '-';
    }

    /**
     * API: Get detail Berita Acara
     */
    /**
     * API: Get detail Berita Acara
     */
// public function detail($no_ba)
// {
//     // Ambil semua alat yang memiliki nomor BA yang sama
//     $beritaAcara = BeritaAcara::where('no_ba', $no_ba)
//                                 ->with('calibration')
//                                 ->get();

//     if ($beritaAcara->isEmpty()) {
//         return response()->json(['message' => 'Data tidak ditemukan'], 404);
//     }

//     $first = $beritaAcara->first();

//     // Susun data untuk dikirim ke JS
//     return response()->json([
//         'header' => [
//             'no_ba'             => $first->no_ba,
//             'tanggal_formatted' => $first->tanggal ? Carbon::parse($first->tanggal)->format('d/m/Y') : '-',
//             'perusahaan'        => $first->perusahaan,
//             'alamat'            => $first->alamat,
//             'no_order'          => $first->no_order,
//             'kontak'            => $first->kontak,
//             'telp_fax'          => $first->telp_fax,
//             'request_by'        => $first->request_by,
//             'approve_by'        => $first->approve_by,
//             'status_badge'      => $first->status_badge,
//             'catatan'           => $first->catatan,
//             'calibration'       => $first->calibration_id ? true : false,
//         ],
//         'alatList' => $beritaAcara->map(function($item) {
//             return [
//                 'id' => $item->id_ba,
//                 'nama_alat' => $item->nama_alat,
//                 'merek' => $item->merek,
//                  'type_alat' => $item->type_alat,
//                 'kapasitas' => $item->kapasitas ?? '-', // 🔥 LANGSUNG PAKAI KAPASITAS
//                 'no_seri' => $item->no_seri,
//                 'keterangan' => $item->keterangan,
//                 'no_label' => $item->no_label,
//             ];
//         })
//     ]);
// }

    /**
     * API: Get detail Berita Acara
     */
    public function detail($no_ba)
    {
        // Ambil semua alat yang memiliki nomor BA yang sama
        $beritaAcara = BeritaAcara::where('no_ba', $no_ba)
            ->with('calibration')
            ->get();

        if ($beritaAcara->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $first = $beritaAcara->first();

        // Susun data untuk dikirim ke JS
        return response()->json([
            'header' => [
                'no_ba'             => $first->no_ba,
                'tanggal_formatted' => $first->tanggal ? Carbon::parse($first->tanggal)->format('d/m/Y') : '-',
                'perusahaan'        => $first->perusahaan,
                'alamat'            => $first->alamat,
                'no_order'          => $first->no_order,
                'kontak'            => $first->kontak,
                'telp_fax'          => $first->telp_fax,
                'request_by'        => $first->request_by,
                'approve_by'        => $first->approve_by,
                'status_badge'      => $first->status_badge,
                'catatan'           => $first->catatan,
                'calibration'       => $first->calibration_id ? true : false,
            ],
            'alatList' => $beritaAcara->map(function ($item) {
                return [
                    'id' => $item->id_ba,
                    'nama_alat' => $item->nama_alat,
                    'merek' => $item->merek,
                    'type_alat' => $item->type_alat,
                    'kapasitas' => $item->kapasitas ?? '-',
                    'no_seri' => $item->no_seri,
                    'keterangan' => $item->keterangan ?? '', // ✅ AMBIL DARI BERITA ACARA, BUKAN DARI CALIBRATION
                    'no_label' => $item->no_label,
                ];
            })
        ]);
    }
    /**
     * Export Berita Acara ke PDF (TANPA ENKRIPSI)
     */
    public function exportPdf($no_ba)
    {
        try {
            // Ambil data berita acara
            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->get();

            if ($beritaAcara->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $header = $beritaAcara->first();
            $alatList = $beritaAcara;

            // Format tanggal
            if ($header->tanggal) {
                $header->tanggal_formatted = Carbon::parse($header->tanggal)->format('d/m/Y');
            }

            // Generate PDF
            $pdf = Pdf::loadView('berita_acara.pdf', compact('header', 'alatList', 'no_ba'));
            $pdf->setPaper('A4', 'landscape');
            $pdf->setOptions([
                'margin-left' => 10,
                'margin-right' => 10,
                'margin-top' => 10,
                'margin-bottom' => 10,
            ]);

            // Tentukan folder penyimpanan di PUBLIC path
            $folderPath = public_path('pdf_berita_acara');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            // NAMA FILE ASLI - TANPA ENKRIPSI
            $fileName = 'berita_acara_' . $no_ba . '.pdf';
            $filePath = $folderPath . '/' . $fileName;

            // HAPUS PDF LAMA jika ada
            if ($header->pdf_path) {
                $oldFilePath = public_path('pdf_berita_acara/' . $header->pdf_path);
                if (file_exists($oldFilePath) && is_file($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Simpan PDF dengan nama asli
            $pdf->save($filePath);

            // Simpan ke database
            BeritaAcara::where('no_ba', $no_ba)->update([
                'pdf_path' => $fileName,
                'pdf_original_name' => $fileName,
                'pdf_generated_at' => now()
            ]);

            LogHelper::log('export_ba_pdf', "Mengekspor Berita Acara {$no_ba} ke PDF");

            $url = asset('pdf_berita_acara/' . $fileName);

            return response()->json([
                'success' => true,
                'message' => 'PDF berhasil disimpan',
                'data' => [
                    'no_ba' => $no_ba,
                    'file_name' => $fileName,
                    'url' => $url
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error exporting PDF: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal export PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan halaman approval public (tanpa login)
     * Menggunakan view: berita-acara.V_approval_client
     */
    public function publicApproval($token)
    {
        // \Log::info('Accessing public approval page with token: ' . $token);

        // Cari berita acara berdasarkan token
        $beritaAcara = BeritaAcara::where('approval_token', $token)->first();

        if (!$beritaAcara) {
            return view('berita_acara.V_approval_client_error', [
                'message' => 'Link approval tidak valid atau sudah kadaluarsa.'
            ]);
        }

        // Cek apakah token sudah kadaluarsa (jika ada fitur expiry)
        if (property_exists($beritaAcara, 'token_expires_at') && $beritaAcara->token_expires_at && Carbon::now()->gt($beritaAcara->token_expires_at)) {
            return view('berita_acara.V_approval_client_error', [
                'message' => 'Link approval sudah kadaluarsa. Silakan minta link baru.'
            ]);
        }

        // Cek apakah sudah di-approve
        if ($beritaAcara->status === 'approved') {
            return view('berita_acara.V_approval_client_already', [
                'no_ba' => $beritaAcara->no_ba,
                'approved_at' => $beritaAcara->approved_at
            ]);
        }

        // Ambil semua alat dengan no_ba yang sama
        $alatList = BeritaAcara::where('no_ba', $beritaAcara->no_ba)->get();
        $header = $beritaAcara;

        // Format tanggal
        if ($header->tanggal) {
            $header->tanggal_formatted = Carbon::parse($header->tanggal)->format('d/m/Y');
        }

        // Buat URL untuk halaman view PDF (V_view_pdf)
        $viewUrl = url('/berita-acara/view-pdf-direct/' . $token); // Gunakan route view-pdf-direct

        // KIRIM VARIABEL YANG DIBUTUHKAN KE VIEW
        return view('berita_acara.V_approval_client', [
            'header' => $header,
            'alatList' => $alatList,
            'token' => $token,
            'no_ba' => $beritaAcara->no_ba,
            'viewUrl' => $viewUrl // URL lengkap ke halaman view PDF
        ]);
    }

    public function publicApprove(Request $request, $token)
    {
        // \Log::info('Public approve request received', ['token' => $token]);

        try {
            DB::beginTransaction();

            $beritaAcara = BeritaAcara::where('approval_token', $token)->first();

            if (!$beritaAcara) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak valid'
                ], 404);
            }

            if ($beritaAcara->status === 'approved') {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara sudah disetujui sebelumnya'
                ], 400);
            }

            $no_ba = $beritaAcara->no_ba;
            $kontak = $beritaAcara->kontak ?? 'Client';
            $clientPhone = $request->client_phone ?? $beritaAcara->client_phone ?? '';

            // Ambil data signature dari request
            $signature = $request->signature ?? null;
            $signatureUrl = null;
            $approvalMethod = 'whatsapp'; // Default untuk QR code

            // Jika ada signature, berarti ini approval via TTD
            if ($signature) {
                $approvalMethod = 'signature';
                try {
                    \Log::info('Attempting to save signature for BA: ' . $no_ba);
                    $signatureUrl = $this->saveSignatureImage($signature, $no_ba);
                    \Log::info('Signature saved successfully', ['url' => $signatureUrl]);
                } catch (\Exception $e) {
                    \Log::error('Failed to save signature:', ['error' => $e->getMessage()]);
                    // Jangan gagalkan proses, tetap lanjutkan dengan signature null
                }
            } else {
                \Log::info('No signature provided - this is QR code approval for BA: ' . $no_ba);
            }

            // Update status approved dengan method yang sesuai (hanya signature atau whatsapp)
            BeritaAcara::where('no_ba', $no_ba)
                ->update([
                    'status' => 'approved',
                    'approve_by' => $kontak,
                    'approval_method' => $approvalMethod, // 'signature' atau 'whatsapp'
                    'approval_signature' => $signatureUrl, // null untuk whatsapp
                    'client_phone' => $clientPhone,
                    'approved_at' => now(),
                    'updated_at' => now()
                ]);

            DB::commit();

            // Generate PDF
            $pdfUrl = null;
            try {
                $pdfResult = $this->generateAndSavePdf($no_ba);
                if ($pdfResult && isset($pdfResult['url'])) {
                    $pdfUrl = $pdfResult['url'];
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to generate PDF: ' . $e->getMessage());
            }

            // BUAT URL UNTUK LANGSUNG MENAMPILKAN PDF
            $viewUrl = url('/berita-acara/view-pdf-direct/' . $token);

            return response()->json([
                'success' => true,
                'message' => 'Berita Acara berhasil disetujui',
                'data' => [
                    'no_ba' => $no_ba,
                    'approved_by' => $kontak,
                    'client_phone' => $clientPhone,
                    'signature_url' => $signatureUrl,
                    'approval_method' => $approvalMethod, // 'signature' atau 'whatsapp'
                    'pdf_url' => $pdfUrl,
                    'view_url' => $viewUrl,
                    'approved_at' => now()->toDateTimeString()
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error in public approve: ' . $e->getMessage(), [
                'token' => $token,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyetujui Berita Acara: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Kirim notifikasi WhatsApp untuk approval public
     */
    private function sendPublicApprovalNotification($no_ba, $clientPhone)
    {
        try {
            $adminPhone = '628889150150'; // Nomor admin

            // Bersihkan nomor client
            $cleanClientPhone = $clientPhone ? preg_replace('/[^0-9]/', '', $clientPhone) : '-';
            if ($cleanClientPhone && substr($cleanClientPhone, 0, 1) === '0') {
                $cleanClientPhone = '62' . substr($cleanClientPhone, 1);
            }

            // Ambil data berita acara
            $ba = BeritaAcara::where('no_ba', $no_ba)->first();

            // Format pesan
            $message = "âœ… *APPROVAL BERITA ACARA (PUBLIC LINK)*\n\n";
            $message .= "Nomor BA: {$no_ba}\n";
            $message .= "Perusahaan: " . ($ba->perusahaan ?? '-') . "\n";
            $message .= "Client: " . ($ba->kontak ?? '-') . "\n";
            $message .= "Metode: Public Approval Link\n";
            $message .= "Nomor WA Client: {$cleanClientPhone}\n";
            $message .= "Waktu: " . now()->format('d/m/Y H:i:s') . "\n\n";
            $message .= "Status: âœ“ DISETUJUI";

            $waUrl = "https://wa.me/{$adminPhone}?text=" . urlencode($message);

            \Log::info('Public approval WhatsApp notification prepared', [
                'no_ba' => $no_ba,
                'wa_url' => $waUrl
            ]);

            return $waUrl;
        } catch (\Exception $e) {
            \Log::error('Gagal kirim notifikasi WA public', [
                'error' => $e->getMessage(),
                'no_ba' => $no_ba
            ]);

            return null;
        }
    }

    /**
     * Generate token untuk public approval link
     */
    public function generatePublicToken($no_ba)
    {
        try {
            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->first();

            if (!$beritaAcara) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita Acara tidak ditemukan'
                ], 404);
            }

            // Generate token unik
            $token = bin2hex(random_bytes(32)); // 64 karakter hex
            $expiresAt = now()->addDays(7); // Berlaku 7 hari

            // Simpan token ke database
            BeritaAcara::where('no_ba', $no_ba)
                ->update([
                    'approval_token' => $token,
                    'token_expires_at' => $expiresAt
                ]);

            $publicUrl = url("/public/approve/{$token}");

            return response()->json([
                'success' => true,
                'token' => $token,
                'public_url' => $publicUrl,
                'expires_at' => $expiresAt->format('d/m/Y H:i:s')
            ]);
        } catch (\Exception $e) {
            \Log::error('Error generating public token: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal generate token: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Langsung tampilkan PDF di browser (tanpa data tabel)
     */
    public function publicViewPdfDirect($token)
    {
        \Log::info('Direct PDF view with token: ' . $token);

        // Cari berita acara berdasarkan token
        $beritaAcara = BeritaAcara::where('approval_token', $token)->first();

        if (!$beritaAcara) {
            abort(404, 'Berita Acara tidak ditemukan');
        }

        $no_ba = $beritaAcara->no_ba;
        $pdfPath = public_path('pdf_berita_acara/berita_acara_' . $no_ba . '.pdf');

        if (!file_exists($pdfPath)) {
            abort(404, 'File PDF tidak ditemukan');
        }

        // Langsung tampilkan PDF di browser
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="berita_acara_' . $no_ba . '.pdf"'
        ]);
    }
    /**
     * Update all items with the same no_ba
     */
    public function updateByNo(Request $request, $no_ba)
    {
        try {
            DB::beginTransaction();

            $beritaAcara = BeritaAcara::where('no_ba', $no_ba)->get();

            if ($beritaAcara->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Berita Acara tidak ditemukan'
                ], 404);
            }

            // Validasi
            $validator = Validator::make($request->all(), [
                'tanggal' => 'required|date',
                'perusahaan' => 'nullable|string|max:255',
                'alamat' => 'nullable|string',
                'no_order' => 'nullable|string|max:100',
                'kontak' => 'nullable|string|max:100',
                'telp_fax' => 'nullable|string|max:100',
                'request_by' => 'nullable|string|max:100',
                'approve_by' => 'nullable|string|max:100',
                'catatan' => 'nullable|string',

                'alat' => 'required|array',
                'alat.*.nama_alat' => 'required|string|max:255',
                'alat.*.merek' => 'nullable|string|max:100',
                'alat.*.kapasitas' => 'nullable|string|max:100',
                'alat.*.no_seri' => 'nullable|string|max:100',
                'alat.*.keterangan' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $currentUser = Auth::user();
            $updatedByName = $currentUser ? $currentUser->name : 'System';

            // Ambil semua id_ba yang dikirimkan (yang sudah ada sebelumnya)
            $submittedIds = [];
            $firstItem = $beritaAcara->first();

            // Loop pertama: Kumpulkan ID yang valid
            foreach ($request->alat as $index => $alatData) {
                if (!isset($alatData['nama_alat']) || trim($alatData['nama_alat']) === '') {
                    continue;
                }
                if (!empty($alatData['id_ba'])) {
                    $submittedIds[] = $alatData['id_ba'];
                }
            }

            // Hapus data alat yang tidak ada dalam daftar ID yang dikirim
            BeritaAcara::where('no_ba', $no_ba)
                ->when(!empty($submittedIds), function ($query) use ($submittedIds) {
                    return $query->whereNotIn('id_ba', $submittedIds);
                })->delete();

            // Update atau buat setiap alat
            foreach ($request->alat as $index => $alatData) {
                if (!isset($alatData['nama_alat']) || trim($alatData['nama_alat']) === '') {
                    continue;
                }

                if (!empty($alatData['id_ba'])) {
                    // Update alat yang ada
                    $item = BeritaAcara::where('id_ba', $alatData['id_ba'])->first();
                    if ($item) {
                        $item->update([
                            'tanggal' => $request->tanggal,
                            'perusahaan' => $request->perusahaan,
                            'alamat' => $request->alamat,
                            'no_order' => $request->no_order,
                            'kontak' => $request->kontak,
                            'telp_fax' => $request->telp_fax,
                            'request_by' => $request->request_by,
                            'approve_by' => $request->approve_by,
                            'catatan' => $request->catatan,

                            'nama_alat' => $alatData['nama_alat'],
                            'merek' => $alatData['merek'] ?? $item->merek,
                            'kapasitas' => $alatData['kapasitas'] ?? $item->kapasitas,
                            'no_seri' => $alatData['no_seri'] ?? $item->no_seri,
                            'keterangan' => $alatData['keterangan'] ?? $item->keterangan,
                            'updated_by' => $updatedByName,
                        ]);
                    }
                } else {
                    // Tambah alat baru
                    BeritaAcara::create([
                        'no_ba'          => $no_ba,
                        'tanggal'        => $request->tanggal,
                        'perusahaan'     => $request->perusahaan,
                        'alamat'         => $request->alamat,
                        'no_order'       => $request->no_order,
                        'kontak'         => $request->kontak,
                        'telp_fax'       => $request->telp_fax,
                        'request_by'     => $request->request_by,
                        'approve_by'     => $request->approve_by,
                        'catatan'        => $request->catatan,

                        'nama_alat'      => $alatData['nama_alat'],
                        'merek'          => $alatData['merek'] ?? null,
                        'kapasitas'      => $alatData['kapasitas'] ?? null,
                        'no_seri'        => $alatData['no_seri'] ?? null,
                        'keterangan'     => $alatData['keterangan'] ?? null,

                        'created_by'     => $updatedByName,
                        'updated_by'     => $updatedByName,
                        'status_transaction' => $firstItem ? $firstItem->status_transaction : 'waiting_verified',
                        'status'         => $firstItem ? $firstItem->status : 'Draft'
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berita Acara berhasil diperbarui',
                'no_ba' => $no_ba
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('ERROR updateByNo: ' . $e->getMessage(), [
                'no_ba' => $no_ba,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate: ' . $e->getMessage()
            ], 500);
        }
    }
}
