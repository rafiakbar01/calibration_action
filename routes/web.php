<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalibrationController;
use App\Http\Controllers\AlatStandardController;
use App\Http\Controllers\CalibrationMethodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\LogKalibrasiController;
use App\Http\Controllers\LabelDesignController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\FileTemplateController;
use App\Http\Controllers\TemplateMacroController;
use App\Http\Controllers\SertifikatKalibrasiController;
use App\Http\Controllers\DashboardControlController;
use App\Http\Controllers\CetakLabelOldController;
use App\Http\Controllers\SpeedTestController;
use App\Http\Controllers\FormCetakLabelController;
use App\Http\Controllers\CalibrationDraftController;

// Speed Test Routes (Public)
Route::get('/api/speedtest/ping', [SpeedTestController::class, 'ping'])->name('speedtest.ping');
Route::get('/api/speedtest/download', [SpeedTestController::class, 'download'])->name('speedtest.download');
Route::post('/api/speedtest/upload', [SpeedTestController::class, 'upload'])->name('speedtest.upload');
Route::post('/api/speedtest/log', [SpeedTestController::class, 'logResult'])->name('speedtest.log');

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});


// Route untuk clear cache di cPanel
Route::get('/clear-all-cache', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
    } catch (\Exception $e) {
    }

    // Force delete compiled views manually just in case Artisan fails
    $viewPath = storage_path('framework/views');
    $files = glob($viewPath . '/*');
    foreach ($files as $file) {
        if (is_file($file) && !str_ends_with($file, '.gitignore')) {
            @unlink($file);
        }
    }
    return 'Cache Laravel berhasil dibersihkan! Silakan kembali ke halaman Dashboard Control dan refresh.';
});

// ROUTES PUBLIC UNTUK APPROVAL & GDRIVE VIEWER (TANPA LOGIN)
Route::get('/sertifikat/gdrive-view', [SertifikatKalibrasiController::class, 'gdrivePublicView'])
    ->name('sertifikat.gdrive-view');

Route::get('/{slug}', [SertifikatKalibrasiController::class, 'publicQrView'])
    ->name('sertifikat.qr-view')
    ->where('slug', '(PAS|pas)-.*');

// ROUTES PUBLIC UNTUK APPROVAL (TANPA LOGIN)
Route::get('/berita-acara/approve/{token}', [BeritaAcaraController::class, 'publicApproval'])->name('berita-acara.public-approval');
Route::post('/berita-acara/approve/{token}', [BeritaAcaraController::class, 'publicApprove'])->name('berita-acara.approve');

// Route untuk melihat PDF langsung (tanpa login)
Route::get('/berita-acara/view-pdf-direct/{token}', [BeritaAcaraController::class, 'publicViewPdfDirect'])->name('berita-acara.view-pdf-direct');
Route::get('/berita-acara/download-pdf/{no_ba}', [BeritaAcaraController::class, 'downloadPDF'])->name('berita-acara.download-pdf');

Route::get('/qr-approve/{no_ba}', function ($no_ba) {
    // Log untuk debugging
    \Log::info('QR Approve accessed', [
        'no_ba' => $no_ba,
        'url' => request()->fullUrl(),
        'session_id' => session()->getId(),
        'user_agent' => request()->userAgent()
    ]);

    // Simpan ke session Laravel
    session(['qr_scanned_' . $no_ba => true]);
    session(['qr_time_' . $no_ba => time()]);

    // Pastikan session tersimpan
    session()->save();

    // Redirect ke WhatsApp
    $phone = '628889150150';
    $message = $no_ba;
    $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

    return redirect()->away($waUrl);
})->name('qr.approve')->withoutMiddleware(['auth']);

Route::get('/check-qr-scan/{no_ba}', function ($no_ba) {
    $scanned = session('qr_scanned_' . $no_ba, false);
    $time = session('qr_time_' . $no_ba);

    \Log::info('Check QR Scan', [
        'no_ba' => $no_ba,
        'scanned' => $scanned,
        'time' => $time,
        'session_id' => session()->getId()
    ]);

    return response()->json([
        'scanned' => $scanned,
        'time' => $time,
        'no_ba' => $no_ba,
        'session_id' => session()->getId()
    ]);
})->middleware('auth');

// Izinkan akses ke file assets
Route::get('css/{any}', function ($any) {
    return response()->file(public_path('css/' . $any));
})->where('any', '.*');

Route::get('js/{any}', function ($any) {
    return response()->file(public_path('js/' . $any));
})->where('any', '.*');

Route::get('fonts/{any}', function ($any) {
    return response()->file(public_path('fonts/' . $any));
})->where('any', '.*');

Route::get('images/{any}', function ($any) {
    return response()->file(public_path('images/' . $any));
})->where('any', '.*');

Route::get('vendor/{any}', function ($any) {
    return response()->file(public_path('vendor/' . $any));
})->where('any', '.*');

// TANGKAP URL yang mengandung /dist/pages/ dan redirect ke login
Route::get('dist/{any}', function ($any) {
    return redirect()->route('login');
})->where('any', '.*');

Route::get('pages/{any}', function ($any) {
    return redirect()->route('login');
})->where('any', '.*');

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ROUTES YANG MEMERLUKAN AUTH
Route::middleware('auth')->group(function () {
    // Dashboard (PPIC otomatis diredirect ke dashboard-control di controller)
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Profile Routes (Semua user login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/photo', [ProfilePhotoController::class, 'edit'])->name('profile.photo');
    Route::post('/profile/photo', [ProfilePhotoController::class, 'update'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfilePhotoController::class, 'destroy'])->name('profile.photo.destroy');
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::post('/api/log-activity', [ActivityLogController::class, 'logActivity'])->name('api.log-activity');

    // Calibration Draft (server-side backup agar data tidak hilang saat logout)
    Route::post('/api/calibration-draft/save', [CalibrationDraftController::class, 'save'])->name('calibration-draft.save');
    Route::get('/api/calibration-draft/load', [CalibrationDraftController::class, 'load'])->name('calibration-draft.load');
    Route::delete('/api/calibration-draft/clear', [CalibrationDraftController::class, 'clear'])->name('calibration-draft.clear');

    // Dashboard Control (Super Admin, Checker, Approver, PPIC, + Teknisi tertentu via NIK)
    // Middleware hanya cek role — controller (canAccessDashboardControl) filter lebih lanjut by NIK
    Route::middleware('role:super admin,checker,approver,ppic,teknisi')->group(function () {
        Route::get('/dashboard-control', [DashboardControlController::class, 'index'])->name('dashboard.control');
        Route::get('/api/dashboard-control/technician-data', [DashboardControlController::class, 'getTechnicianChartData'])->name('dashboard.control.technician-data');
    });

    // Kompetensi Teknisi Routes
    Route::prefix('kompetensi')->group(function () {
        Route::get('/', [App\Http\Controllers\KompetensiTeknisiController::class, 'index'])->name('kompetensi.index');
        Route::post('/store', [App\Http\Controllers\KompetensiTeknisiController::class, 'store'])->name('kompetensi.store');
        Route::get('/technician/{userId}', [App\Http\Controllers\KompetensiTeknisiController::class, 'getTechnicianKompetensi'])->name('kompetensi.technician');
    });

    // Cetak Label Old (Super Admin, Teknisi, Approver, Checker)
    Route::middleware('role:super admin,teknisi,approver,checker')->group(function () {
        Route::get('/cetak-label-old', [CetakLabelOldController::class, 'index'])->name('cetak-label-old.index');
    });

    // Master Data & User Management (Hanya Super Admin)
    Route::middleware('role:super admin')->group(function () {
        Route::get('/register-user', [UserController::class, 'index'])->name('register-user');
        Route::get('/label-design', function () {
            return view('label-design');
        })->name('label.design');

        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/photo', [UserController::class, 'updatePhoto'])->name('users.photo');
        Route::delete('/users/photo', [UserController::class, 'deletePhoto'])->name('users.photo.delete');
        Route::get('/users/{id}/get-password-hash', [UserController::class, 'getPasswordHash'])->name('users.get-password-hash');
        Route::post('/users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::delete('/users/{id}/clear-session-token', [UserController::class, 'clearSessionToken'])->name('users.clear-session-token');

        Route::resource('alat-standards', AlatStandardController::class);
        Route::resource('calibration-methods', CalibrationMethodController::class);

        // Activity Logs
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('/activity-logs/data', [ActivityLogController::class, 'getData'])->name('activity-logs.data');
        Route::get('/activity-logs/export', [ActivityLogController::class, 'export'])->name('activity-logs.export');
        Route::get('/activity-logs/{id}', [ActivityLogController::class, 'show'])->name('activity-logs.show');
        Route::delete('/activity-logs/delete-multiple', [ActivityLogController::class, 'destroyMultiple'])->name('activity-logs.destroyMultiple');

        // Control Data Routes (Master Data - Khusus Super Admin)
        Route::prefix('master-data/control-data')->name('control-data.')->group(function () {
            Route::get('/', [\App\Http\Controllers\ControlDataController::class, 'index'])->name('index');
            Route::get('/{id}', [\App\Http\Controllers\ControlDataController::class, 'show'])->name('show');
            Route::put('/{id}', [\App\Http\Controllers\ControlDataController::class, 'update'])->name('update');
            Route::get('/{id}/ajax', [\App\Http\Controllers\ControlDataController::class, 'getDetailAjax'])->name('ajax');
            Route::get('/{id}/export-json', [\App\Http\Controllers\ControlDataController::class, 'exportJson'])->name('export-json');
        });
    });

    // Calibrations Routes (Super Admin, Teknisi, Approver, Checker)
    Route::middleware('role:super admin,teknisi,approver,checker')->group(function () {
        Route::get('/calibrations/recycle-bin', [CalibrationController::class, 'recycleBin'])->name('calibrations.recycle-bin');
        Route::post('/calibrations/{id}/restore', [CalibrationController::class, 'restore'])->name('calibrations.restore');
        Route::delete('/calibrations/empty-recycle-bin', [CalibrationController::class, 'emptyRecycleBin'])->name('calibrations.empty-recycle-bin');
        Route::delete('/calibrations/{id}/force-delete', [CalibrationController::class, 'forceDelete'])->name('calibrations.force-delete');

        Route::get('/calibrations', [CalibrationController::class, 'index'])->name('calibrations.index');
        Route::get('/calibrations/create', [CalibrationController::class, 'create'])->name('calibrations.create');
        Route::post('/calibrations', [CalibrationController::class, 'store'])->name('calibrations.store');
        Route::get('/calibrations/{id}', [CalibrationController::class, 'show'])->name('calibrations.show');
        Route::put('/calibrations/{id}', [CalibrationController::class, 'update'])->name('calibrations.update');
        Route::delete('/calibrations/{id}', [CalibrationController::class, 'destroy'])->name('calibrations.destroy');
        Route::get('/get-form-html/{formType}', [CalibrationController::class, 'getFormHtml'])->name('get.form.html');
        Route::get('/calibrations/{id}/view-data', [CalibrationController::class, 'viewData'])->name('calibrations.view-data');
        Route::get('/calibrations/{id}/form-view/{formType}', [CalibrationController::class, 'getFormView'])->name('calibrations.form-view');
        Route::put('/calibrations/{id}/form-update/{formType}', [CalibrationController::class, 'updateFormData'])->name('calibrations.form-update');
        Route::post('/calibrations/{id}/update-label', [CalibrationController::class, 'updateLabel'])->name('calibrations.update-label');
        Route::get('/api/calibrations/fetch-data/{id}', [CalibrationController::class, 'fetchDataById'])->name('calibrations.fetch-data');
        Route::get('/calibrations/{id}/print-label', [CalibrationController::class, 'printLabel'])->name('calibrations.print-label');
        Route::get('/calibrations/{id}/export', [CalibrationController::class, 'export'])->name('calibrations.export');
        Route::get('/calibrations/{id}/export-pdf', [CalibrationController::class, 'exportPdf'])->name('calibrations.export-pdf');
        Route::post('/calibrations/{id}/save-excel', [CalibrationController::class, 'saveExcel'])->name('calibrations.save-excel');
        Route::get('/calibrations/{id}/download-excel-template', [CalibrationController::class, 'downloadExcelTemplate'])->name('calibrations.download.excel.template');
        Route::get('/calibrations/{id}/download-excel-template/{formType}', [CalibrationController::class, 'downloadExcelTemplateByType'])->name('calibrations.download.excel.template.bytype');
        Route::get('/calibrations/{id}/download-verified', [CalibrationController::class, 'downloadVerified'])->name('calibrations.download.verified');
        Route::get('/calibrations/{id}/download/rejected', [CalibrationController::class, 'downloadRejected'])->name('calibrations.download.rejected');
        Route::post('/calibrations/{id}/send-to-checker', [CalibrationController::class, 'sendToChecker'])->name('calibrations.send-to-checker');
        Route::post('/calibrations/send-all-to-checker', [CalibrationController::class, 'sendAllToChecker'])->name('calibrations.send-all-to-checker');
        Route::post('/calibrations/{id}/update-next-date', [CalibrationController::class, 'updateNextDate'])->name('calibrations.update-next-date');
        Route::delete('/calibrations/gauge-block/{calibration}/attachment/{index}', [CalibrationController::class, 'deleteAttachment'])
            ->name('calibrations.gauge-block.attachment.delete');
        Route::post('/print-via-node', [App\Http\Controllers\PrinterController::class, 'printViaNode'])->name('print.node');
        Route::get('/calibrations/{id}/open-excel', [CalibrationController::class, 'openExcel'])->name('calibrations.open-excel');
    });

    // Berita Acara Routes (Super Admin, Teknisi, Approver, Checker)
    Route::middleware('role:super admin,teknisi,approver,checker')->prefix('berita-acara')->name('berita-acara.')->group(function () {
        Route::get('/', [BeritaAcaraController::class, 'index'])->name('index');
        Route::get('/create', [BeritaAcaraController::class, 'create'])->name('create');
        Route::get('/create-from-calibration/{id}', [BeritaAcaraController::class, 'createFromCalibration'])->name('create-from-calibration');
        Route::post('/create-from-group', [BeritaAcaraController::class, 'createFromGroup'])->name('create-from-group');
        Route::post('/', [BeritaAcaraController::class, 'store'])->name('store');
        Route::get('/list', [BeritaAcaraController::class, 'list'])->name('list');
        Route::get('/show/{no_ba}', [BeritaAcaraController::class, 'show'])->name('show');
        Route::get('/approval/{no_ba}', [BeritaAcaraController::class, 'approval'])->name('approval');
        Route::post('/approve', [BeritaAcaraController::class, 'approve'])->name('approve');
        Route::post('/reject/{no_ba}', [BeritaAcaraController::class, 'reject'])->name('reject');
        Route::get('/check-status/{no_ba}', [BeritaAcaraController::class, 'checkApprovalStatus'])->name('check-status');
        Route::get('/{id}/edit', [BeritaAcaraController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BeritaAcaraController::class, 'update'])->name('update');
        Route::get('/edit-modal/{id}', [BeritaAcaraController::class, 'editModal'])->name('edit-modal');
        Route::put('/update-modal/{id}', [BeritaAcaraController::class, 'updateModal'])->name('update-modal');
        Route::delete('/{id}', [BeritaAcaraController::class, 'destroy'])->name('destroy');
        Route::delete('/destroy-all/{no_ba}', [BeritaAcaraController::class, 'destroyAll'])->name('destroy-all');
        Route::get('/detail/{no_ba}', [BeritaAcaraController::class, 'detail'])->name('detail')->where('no_ba', '.*');
        Route::get('/generate-token/{no_ba}', [BeritaAcaraController::class, 'generateApprovalToken'])->name('generate-token');
        Route::get('/approval-detail/{no_ba}', [BeritaAcaraController::class, 'getApprovalDetail'])->name('approval-detail');
        Route::get('/export-pdf/{no_ba}', [BeritaAcaraController::class, 'exportPdf'])->name('export-pdf');
        Route::get('/download-pdf/{no_ba}', [BeritaAcaraController::class, 'downloadPdf'])->name('download-pdf');
        Route::get('/edit-modal/{id}', [BeritaAcaraController::class, 'editModal'])->name('edit-modal');
        Route::put('/update-modal/{id}', [BeritaAcaraController::class, 'updateModal'])->name('update-modal');
        Route::put('/update-by-no/{no_ba}', [BeritaAcaraController::class, 'updateByNo'])->name('update-by-no');
    });

    // Log Kalibrasi Routes (Super Admin, Teknisi, Approver, Checker)
    Route::middleware('role:super admin,teknisi,approver,checker')->prefix('log-kalibrasi')->name('log-kalibrasi.')->group(function () {
        Route::get('/', [LogKalibrasiController::class, 'index'])->name('index');
        Route::get('/ajax', [LogKalibrasiController::class, 'ajax'])->name('ajax');
        Route::get('/export', [LogKalibrasiController::class, 'export'])->name('export');
        Route::get('/kalibrasi/{kalibrasi_id}', [LogKalibrasiController::class, 'showByKalibrasi'])->name('per-kalibrasi');
        Route::get('/{id}', [LogKalibrasiController::class, 'show'])->name('show');
        Route::get('/bersihkan/log-lama', [LogKalibrasiController::class, 'bersihkan'])->name('bersihkan');
        Route::get('/data', [ActivityLogController::class, 'getData'])->name('data');
    });

    // File Template Routes (Super Admin, Approver, Checker)
    Route::middleware('role:super admin,approver,checker')->group(function () {
        Route::get('/file-template', [FileTemplateController::class, 'index'])->name('file-template.index');
        Route::get('/file-template/download/{type}/{filename}', [FileTemplateController::class, 'download'])->name('file-template.download');
        Route::delete('/file-template/delete/{type}/{filename}', [FileTemplateController::class, 'destroy'])->name('file-template.destroy');
        Route::delete('/file-template/delete-all/{category}', [FileTemplateController::class, 'destroyAll'])->name('file-template.destroy-all');
        Route::post('/file-template/delete-multiple', [FileTemplateController::class, 'destroyMultiple'])->name('file-template.destroy-multiple');
        Route::post('/file-template/download-multiple', [FileTemplateController::class, 'downloadMultiple'])->name('file-template.download-multiple');

        Route::get('/template-macro', [TemplateMacroController::class, 'index'])->name('template-macro.index');
        Route::post('/template-macro/upload', [TemplateMacroController::class, 'upload'])->name('template-macro.upload');
        Route::get('/template-macro/download/{filename}', [TemplateMacroController::class, 'download'])->name('template-macro.download');
        Route::delete('/template-macro/delete/{filename}', [TemplateMacroController::class, 'destroy'])->name('template-macro.destroy');
        Route::post('/template-macro/rename/{filename}', [TemplateMacroController::class, 'rename'])->name('template-macro.rename');
    });

    // Sertifikat Kalibrasi Routes (Super Admin, Checker, Approver)
    Route::middleware('role:super admin,checker,approver')->prefix('sertifikat-kalibrasi')->name('sertifikat-kalibrasi.')->group(function () {
        Route::get('/', [SertifikatKalibrasiController::class, 'index'])->name('index');
        Route::get('/download', [SertifikatKalibrasiController::class, 'download'])->name('download');
        Route::delete('/file', [SertifikatKalibrasiController::class, 'destroyFile'])->name('file.destroy');
        Route::post('/upload', [SertifikatKalibrasiController::class, 'upload'])->name('upload');
        Route::post('/file/move', [SertifikatKalibrasiController::class, 'moveFile'])->name('file.move');
        Route::post('/file/rename', [SertifikatKalibrasiController::class, 'renameFile'])->name('file.rename');
        Route::post('/folder/create', [SertifikatKalibrasiController::class, 'createFolder'])->name('folder.create');
        Route::post('/folder/rename', [SertifikatKalibrasiController::class, 'renameFolder'])->name('folder.rename');
        Route::delete('/folder', [SertifikatKalibrasiController::class, 'destroyFolder'])->name('folder.destroy');
    });
});

// API Route (public)
Route::get('/api/calibration-events', function () {
    return \App\Models\Calibration::select('id', 'namaAlat', 'NoSeri', 'status', 'created_at as start')
        ->get()
        ->map(function ($item) {
            $color = match ($item->status) {
                'waiting_verification' => '#ffc107',
                'approved'             => '#28a745',
                'rejected'             => '#dc3545',
                default                => '#6c757d',
            };

            return [
                'id'     => $item->id,
                'title'  => $item->namaAlat . ' (' . ($item->NoSeri ?? '—') . ')',
                'start'  => $item->start,
                'color'  => $color,
                'url'    => route('calibrations.show', $item->id),
            ];
        });
})->name('calibration.events');

// TEST: Compass DB Connection
Route::get('/test-compass-db', function () {
    try {
        // Test connection
        $pdo = \DB::connection('compass_postgres')->getPdo();

        // Fetch planned calibrations
        $results = \DB::connection('compass_postgres')
            ->table('inlab_calibrations')
            ->where('status', 'planned')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Connection to Compass PostgreSQL successful!',
            'count' => $results->count(),
            'data' => $results
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
