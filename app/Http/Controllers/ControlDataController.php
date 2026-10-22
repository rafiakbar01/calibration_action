<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CalibrationController;
use App\Models\Calibration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ControlDataController extends Controller
{
    /**
     * Tampilkan halaman Control Data
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $formTypeFilter = $request->input('form_type');
        $statusFilter = $request->input('status');
        $dateStart = $request->input('tanggal_mulai');
        $dateEnd = $request->input('tanggal_akhir');
        $withDeleted = $request->boolean('with_deleted', false);
        
        $perPageRaw = $request->input('per_page', 50);
        if ($perPageRaw === 'all') {
            $perPage = 2000;
        } else {
            $perPage = (int) $perPageRaw;
            if ($perPage < 5 || $perPage > 2000) {
                $perPage = 50;
            }
        }

        $query = $withDeleted ? Calibration::withTrashed() : Calibration::query();

        // Filter Search
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('namaAlat', 'LIKE', "%{$search}%")
                  ->orWhere('brandAlat', 'LIKE', "%{$search}%")
                  ->orWhere('NoSeri', 'LIKE', "%{$search}%")
                  ->orWhere('kodeAlat', 'LIKE', "%{$search}%")
                  ->orWhere('pemilikAlat', 'LIKE', "%{$search}%")
                  ->orWhere('no_po', 'LIKE', "%{$search}%")
                  ->orWhere('form_type', 'LIKE', "%{$search}%");
            });
        }

        // Filter Form Type
        if (!empty($formTypeFilter)) {
            $query->where('form_type', $formTypeFilter);
        }

        // Filter Status
        if (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }

        // Filter Tanggal
        if (!empty($dateStart)) {
            $query->whereDate('tanggalKalibrasi', '>=', $dateStart);
        }
        if (!empty($dateEnd)) {
            $query->whereDate('tanggalKalibrasi', '<=', $dateEnd);
        }

        $calibrations = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        // Hitung statistik ringkasan
        $stats = [
            'total' => Calibration::count(),
            'month' => Calibration::whereMonth('created_at', now()->month)
                                  ->whereYear('created_at', now()->year)
                                  ->count(),
            'draft' => Calibration::where('status', 'draft')->count(),
            'verified' => Calibration::where('status', 'verified')->count(),
            'approved' => Calibration::where('status', 'approved')->count(),
            'deleted' => Calibration::onlyTrashed()->count(),
        ];

        // Daftar semua form_type dari formRegistry untuk filter dropdown
        $availableFormTypes = array_keys(CalibrationController::$formRegistry);
        sort($availableFormTypes);

        // Resolve data relasi (Head, Detail count, Add) untuk setiap row di halaman aktif
        $itemsWithRelations = [];
        foreach ($calibrations as $cal) {
            $itemsWithRelations[] = [
                'calibration' => $cal,
                'relation_info' => $this->getRelationSummary($cal),
            ];
        }

        return view('control_data.index', compact(
            'calibrations',
            'itemsWithRelations',
            'stats',
            'availableFormTypes',
            'search',
            'formTypeFilter',
            'statusFilter',
            'dateStart',
            'dateEnd',
            'withDeleted',
            'perPage'
        ));
    }

    /**
     * Tampilkan detail lengkap 1 record kalibrasi ter-join dengan head, detail, dan add
     */
    public function show($id)
    {
        $calibration = Calibration::withTrashed()->findOrFail($id);
        $joinedData = $this->fetchJoinedData($calibration);

        return view('control_data.show', compact('calibration', 'joinedData'));
    }

    /**
     * Endpoint JSON data join lengkap untuk Modal Inspect di Index Page
     */
    public function getDetailAjax($id)
    {
        try {
            $calibration = Calibration::withTrashed()->findOrFail($id);
            $joinedData = $this->fetchJoinedData($calibration);

            return response()->json([
                'success' => true,
                'calibration' => $calibration,
                'joined_data' => $joinedData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data join: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download data join lengkap sebagai JSON
     */
    public function exportJson($id)
    {
        $calibration = Calibration::withTrashed()->findOrFail($id);
        $joinedData = $this->fetchJoinedData($calibration);

        $payload = [
            'exported_at' => now()->toIso8601String(),
            'system' => 'Paperless PAS Calibration Control Data',
            'calibration' => $calibration,
            'joined' => $joinedData,
        ];

        $filename = "control_data_{$calibration->id}_" . date('Ymd_His') . ".json";

        return response()->json($payload)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Update data Calibration dan relasi join (Head, Detail, Add) secara aman
     */
    public function update(Request $request, $id)
    {
        $calibration = Calibration::withTrashed()->findOrFail($id);

        DB::beginTransaction();
        try {
            // 1. Update data Master Calibrations (Dinamis sesuai kolom tabel tanpa kolom terlarang)
            if ($request->has('calibration')) {
                $calData = $request->input('calibration');
                if (is_array($calData)) {
                    $calColumns = Schema::getColumnListing($calibration->getTable());
                    $forbidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
                    $fillableCal = array_diff($calColumns, $forbidden);
                    $filteredCalData = array_intersect_key($calData, array_flip($fillableCal));

                    // Decode JSON fields jika dikirim sebagai string
                    foreach (['additional_forms', 'subform_identities', 'status_transaction', 'location_data'] as $jCol) {
                        if (isset($filteredCalData[$jCol]) && is_string($filteredCalData[$jCol])) {
                            $trimmed = trim($filteredCalData[$jCol]);
                            if ($trimmed === '' || $trimmed === 'null') {
                                $filteredCalData[$jCol] = null;
                            } elseif (str_starts_with($trimmed, '[') || str_starts_with($trimmed, '{')) {
                                $decoded = json_decode($trimmed, true);
                                if (json_last_error() === JSON_ERROR_NONE) {
                                    $filteredCalData[$jCol] = $decoded;
                                }
                            }
                        }
                    }

                    $calibration->update($filteredCalData);
                }
            }

            // Kumpulkan model form utama dan form tambahan (subforms)
            $formType = $this->getFormTypeForCalibration($calibration);
            $allModelSets = [];
            $allModelSets[] = $this->resolveModelsForType($formType);

            if (!empty($calibration->additional_forms)) {
                $rawSubs = is_array($calibration->additional_forms)
                    ? $calibration->additional_forms
                    : json_decode($calibration->additional_forms, true);
                if (is_array($rawSubs)) {
                    foreach ($rawSubs as $subType) {
                        $allModelSets[] = $this->resolveModelsForType($subType);
                    }
                }
            }

            // 2. Update data Head
            if ($request->has('head')) {
                $headInputs = $request->input('head');
                if (is_array($headInputs)) {
                    foreach ($allModelSets as $models) {
                        if (empty($models['head_model']) || !class_exists($models['head_model'])) continue;
                        $headClass = $models['head_model'];

                        foreach ($headInputs as $hData) {
                            if (!is_array($hData)) continue;
                            $query = $headClass::where(function($q) use ($calibration) {
                                $q->where('calibration_id', $calibration->id)
                                  ->orWhere('calibration_id', 'like', $calibration->id . '-%');
                            });

                            if (!empty($hData['id'])) {
                                $headRecord = $query->where('id', $hData['id'])->first();
                            } else {
                                $headRecord = $query->first();
                            }

                            if ($headRecord) {
                                $headColumns = Schema::getColumnListing($headRecord->getTable());
                                $fillableHead = array_diff($headColumns, ['id', 'calibration_id', 'created_at', 'updated_at']);
                                $toUpdate = array_intersect_key($hData, array_flip($fillableHead));
                                $headRecord->update($toUpdate);
                            }
                        }
                    }
                }
            }

            // 3. Update data Detail
            if ($request->has('detail')) {
                $detailInputs = $request->input('detail');
                if (is_array($detailInputs)) {
                    foreach ($allModelSets as $models) {
                        foreach ($models['detail_models'] as $detailClass) {
                            if (!class_exists($detailClass)) continue;
                            $className = class_basename($detailClass);

                            // Dukung format detail[ClassName][rowId] maupun detail[rowId]
                            $rowsToUpdate = [];
                            if (isset($detailInputs[$className]) && is_array($detailInputs[$className])) {
                                $rowsToUpdate = $detailInputs[$className];
                            } else {
                                $rowsToUpdate = $detailInputs;
                            }

                            if (is_array($rowsToUpdate)) {
                                foreach ($rowsToUpdate as $rowId => $rowData) {
                                    if (!is_array($rowData)) continue;
                                    $actualId = isset($rowData['id']) ? $rowData['id'] : $rowId;
                                    $detailRow = $detailClass::where(function($q) use ($calibration) {
                                        $q->where('calibration_id', $calibration->id)
                                          ->orWhere('calibration_id', 'like', $calibration->id . '-%');
                                    })->where('id', $actualId)->first();

                                    if ($detailRow) {
                                        $detailColumns = Schema::getColumnListing($detailRow->getTable());
                                        $fillableDetail = array_diff($detailColumns, ['id', 'calibration_id', 'created_at', 'updated_at']);
                                        $toUpdate = array_intersect_key($rowData, array_flip($fillableDetail));
                                        $detailRow->update($toUpdate);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            // 4. Update data Add
            if ($request->has('add')) {
                $addInputs = $request->input('add');
                if (is_array($addInputs)) {
                    foreach ($allModelSets as $models) {
                        if (empty($models['add_model']) || !class_exists($models['add_model'])) continue;
                        $addClass = $models['add_model'];

                        foreach ($addInputs as $aData) {
                            if (!is_array($aData)) continue;
                            $query = $addClass::where(function($q) use ($calibration) {
                                $q->where('calibration_id', $calibration->id)
                                  ->orWhere('calibration_id', 'like', $calibration->id . '-%');
                            });

                            if (!empty($aData['id'])) {
                                $addRecord = $query->where('id', $aData['id'])->first();
                            } else {
                                $addRecord = $query->first();
                            }

                            if ($addRecord) {
                                $addColumns = Schema::getColumnListing($addRecord->getTable());
                                $fillableAdd = array_diff($addColumns, ['id', 'calibration_id', 'created_at', 'updated_at']);
                                $toUpdate = array_intersect_key($aData, array_flip($fillableAdd));
                                $addRecord->update($toUpdate);
                            }
                        }
                    }
                }
            }

            DB::commit();

            $refreshedCalibration = $calibration->fresh();
            $refreshedJoinedData = $this->fetchJoinedData($refreshedCalibration);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data kalibrasi, head, detail, dan add berhasil diperbarui!',
                    'calibration' => $refreshedCalibration,
                    'joined_data' => $refreshedJoinedData,
                ]);
            }

            return redirect()->route('control-data.show', $calibration->id)
                ->with('success', 'Data kalibrasi, head, detail, dan add berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error updating Control Data for {$id}: " . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Helper: Dapatkan ringkasan relasi cepat untuk satu record Calibration
     */
    protected function getRelationSummary($calibration)
    {
        $formType = $this->getFormTypeForCalibration($calibration);
        $models = $this->resolveModelsForType($formType);

        $hasHead = false;
        $headCount = 0;
        $detailCount = 0;
        $hasAdd = false;
        $addCount = 0;
        $headTable = null;
        $detailTables = [];
        $addTable = null;

        // Check Head
        if ($models['head_model'] && class_exists($models['head_model'])) {
            try {
                $headInstance = new $models['head_model'];
                $headTable = $headInstance->getTable();
                $headCount = $models['head_model']::where('calibration_id', $calibration->id)->count();
                $hasHead = $headCount > 0;
            } catch (\Exception $e) {}
        }

        // Check Details
        foreach ($models['detail_models'] as $detailClass) {
            if (class_exists($detailClass)) {
                try {
                    $detailInstance = new $detailClass;
                    $detailTables[] = $detailInstance->getTable();
                    $detailCount += $detailClass::where('calibration_id', $calibration->id)->count();
                } catch (\Exception $e) {}
            }
        }

        // Check Add
        if ($models['add_model'] && class_exists($models['add_model'])) {
            try {
                $addInstance = new $models['add_model'];
                $addTable = $addInstance->getTable();
                $addCount = $models['add_model']::where('calibration_id', $calibration->id)->count();
                $hasAdd = $addCount > 0;
            } catch (\Exception $e) {}
        }

        // Check subforms
        $subforms = [];
        if (!empty($calibration->additional_forms)) {
            $rawSubs = is_array($calibration->additional_forms)
                ? $calibration->additional_forms
                : json_decode($calibration->additional_forms, true);
            if (is_array($rawSubs)) {
                $subforms = $rawSubs;
            }
        }

        return [
            'form_type' => $formType,
            'head_model' => $models['head_model'] ? class_basename($models['head_model']) : null,
            'head_table' => $headTable,
            'has_head' => $hasHead,
            'head_count' => $headCount,
            'detail_models' => array_map('class_basename', $models['detail_models']),
            'detail_tables' => $detailTables,
            'detail_count' => $detailCount,
            'add_model' => $models['add_model'] ? class_basename($models['add_model']) : null,
            'add_table' => $addTable,
            'has_add' => $hasAdd,
            'add_count' => $addCount,
            'has_add_support' => !empty($models['add_model']),
            'subforms' => $subforms,
            'subforms_count' => count($subforms),
        ];
    }

    /**
     * Fetch seluruh record head, detail, dan add yang ter-join dengan Calibration
     */
    public function fetchJoinedData($calibration)
    {
        $formType = $this->getFormTypeForCalibration($calibration);
        $models = $this->resolveModelsForType($formType);

        $headRecords = collect();
        $detailRecords = collect();
        $addRecords = collect();

        // 1. Fetch Head
        if ($models['head_model'] && class_exists($models['head_model'])) {
            try {
                $headRecords = $models['head_model']::where('calibration_id', $calibration->id)->get();
            } catch (\Exception $e) {
                \Log::warning("Error fetching head for {$calibration->id}: " . $e->getMessage());
            }
        }

        // 2. Fetch Detail
        foreach ($models['detail_models'] as $detailClass) {
            if (class_exists($detailClass)) {
                try {
                    $rows = $detailClass::where('calibration_id', $calibration->id)
                        ->orderBy('id', 'asc')
                        ->get();
                    if ($rows->isNotEmpty()) {
                        $detailRecords->put(class_basename($detailClass), $rows);
                    }
                } catch (\Exception $e) {
                    \Log::warning("Error fetching detail for {$calibration->id}: " . $e->getMessage());
                }
            }
        }

        // 3. Fetch Add
        if ($models['add_model'] && class_exists($models['add_model'])) {
            try {
                $addRecords = $models['add_model']::where('calibration_id', $calibration->id)->get();
            } catch (\Exception $e) {
                \Log::warning("Error fetching add for {$calibration->id}: " . $e->getMessage());
            }
        }

        // 4. Fetch Subforms (jika ada form tambahan di transaksi ini)
        $subformsData = [];
        if (!empty($calibration->additional_forms)) {
            $rawSubs = is_array($calibration->additional_forms)
                ? $calibration->additional_forms
                : json_decode($calibration->additional_forms, true);

            if (is_array($rawSubs)) {
                foreach ($rawSubs as $subType) {
                    $subModels = $this->resolveModelsForType($subType);
                    $subHead = collect();
                    $subDetail = collect();
                    $subAdd = collect();

                    $subCode = CalibrationController::getSubformCode($subType);
                    $subId = $calibration->id . '-' . $subCode;

                    if ($subModels['head_model'] && class_exists($subModels['head_model'])) {
                        $subHead = $subModels['head_model']::where('calibration_id', $calibration->id)
                            ->orWhere('calibration_id', $subId)
                            ->get();
                    }

                    foreach ($subModels['detail_models'] as $detailClass) {
                        if (class_exists($detailClass)) {
                            $rows = $detailClass::where('calibration_id', $calibration->id)
                                ->orWhere('calibration_id', $subId)
                                ->orderBy('id', 'asc')
                                ->get();
                            if ($rows->isNotEmpty()) {
                                $subDetail->put(class_basename($detailClass), $rows);
                            }
                        }
                    }

                    if ($subModels['add_model'] && class_exists($subModels['add_model'])) {
                        $subAdd = $subModels['add_model']::where('calibration_id', $calibration->id)
                            ->orWhere('calibration_id', $subId)
                            ->get();
                    }

                    $subformsData[$subType] = [
                        'form_type' => $subType,
                        'head' => $subHead,
                        'detail' => $subDetail,
                        'add' => $subAdd,
                        'models' => [
                            'head' => $subModels['head_model'] ? class_basename($subModels['head_model']) : null,
                            'detail' => array_map('class_basename', $subModels['detail_models']),
                            'add' => $subModels['add_model'] ? class_basename($subModels['add_model']) : null,
                        ],
                    ];
                }
            }
        }

        return [
            'form_type' => $formType,
            'models' => [
                'head' => $models['head_model'] ? class_basename($models['head_model']) : null,
                'detail' => array_map('class_basename', $models['detail_models']),
                'add' => $models['add_model'] ? class_basename($models['add_model']) : null,
            ],
            'head' => $headRecords,
            'detail' => $detailRecords,
            'add' => $addRecords,
            'subforms' => $subformsData,
        ];
    }

    /**
     * Resolve model Head, Detail, dan Add berdasarkan form_type
     */
    protected function resolveModelsForType($formType)
    {
        $registry = CalibrationController::$formRegistry;
        if (!isset($registry[$formType])) {
            return [
                'head_model' => null,
                'detail_models' => [],
                'add_model' => null,
                'config' => null,
            ];
        }

        $config = $registry[$formType];
        $headModel = $config['head_model'] ?? null;
        $detailModels = [];
        $addModel = null;

        $associated = $config['associated_models'] ?? [];
        foreach ($associated as $modelClass) {
            $className = class_basename($modelClass);
            if ($className === class_basename($headModel)) {
                continue;
            }
            if (str_starts_with($className, 'Detail')) {
                $detailModels[] = $modelClass;
            } elseif (str_starts_with($className, 'Add')) {
                $addModel = $modelClass;
            } elseif (!$addModel && count($detailModels) > 0) {
                $addModel = $modelClass;
            } else {
                $detailModels[] = $modelClass;
            }
        }

        return [
            'head_model' => $headModel,
            'detail_models' => $detailModels,
            'add_model' => $addModel,
            'config' => $config,
        ];
    }

    /**
     * Helper: Menentukan formType dari record Calibration
     */
    protected function getFormTypeForCalibration($calibration)
    {
        if (!empty($calibration->form_type)) {
            return $calibration->form_type;
        }

        $namaAlat = strtolower($calibration->namaAlat ?? '');
        $registry = CalibrationController::$formRegistry;

        // Cocokkan key langsung atau dengan spasi
        foreach ($registry as $key => $conf) {
            $humanKey = str_replace('_', ' ', $key);
            if (str_contains($namaAlat, $humanKey) || str_contains($namaAlat, $key)) {
                return $key;
            }
        }

        return 'caliper'; // Fallback umum
    }
}
