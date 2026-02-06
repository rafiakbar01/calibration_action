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

// Halaman Welcome (Publik)
Route::get('/', function () {
    return redirect()->route('login');
});

// === Auth Routes ===
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk membuka file Excel
Route::get('/calibrations/{id}/open-excel', [CalibrationController::class, 'openExcel'])
    ->name('calibrations.open-excel');

Route::get('/api/calibration-events', function () {
    return \App\Models\Calibration::select('id', 'namaAlat', 'NoSeri', 'status', 'created_at as start')
        ->get()
        ->map(function ($item) {
            $color = match ($item->status) {
                'waiting_verification' => '#ffc107', // kuning
                'approved'             => '#28a745', // hijau
                'rejected'             => '#dc3545', // merah
                default               => '#6c757d',
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

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Halaman Registrasi User + Daftar User
    Route::get('/register-user', [UserController::class, 'index'])->name('register-user');

    // CRUD User via AJAX
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Calibrations Routes - DENGAN MODE PARAMETER
    Route::get('/calibrations', [CalibrationController::class, 'index'])->name('calibrations.index');
    Route::get('/calibrations/create', [CalibrationController::class, 'create'])->name('calibrations.create');
    Route::post('/calibrations', [CalibrationController::class, 'store'])->name('calibrations.store');
    
    // Route untuk show dengan mode parameter (view/edit)
    Route::get('/calibrations/{id}', [CalibrationController::class, 'show'])
        ->name('calibrations.show');
    
    // Route untuk update (PUT)
    Route::put('/calibrations/{id}', [CalibrationController::class, 'update'])
        ->name('calibrations.update');
    
    // Route untuk delete
    Route::delete('/calibrations/{id}', [CalibrationController::class, 'destroy'])
        ->name('calibrations.destroy');
    
    // Route untuk get form HTML (create form)
    Route::get('/get-form-html/{formType}', [CalibrationController::class, 'getFormHtml'])
        ->name('get.form.html');
    
    // Route untuk view data modal (optional - bisa dihapus jika tidak digunakan)
    Route::get('/calibrations/{id}/view-data', [CalibrationController::class, 'viewData'])
        ->name('calibrations.view-data');
    
    // ✅ Route untuk load form view berdasarkan jenis alat (optional)
    Route::get('/calibrations/{id}/form-view/{formType}', [CalibrationController::class, 'getFormView'])
        ->name('calibrations.form-view');

    // ✅ Route untuk update form data khusus
    Route::put('/calibrations/{id}/form-update/{formType}', [CalibrationController::class, 'updateFormData'])
        ->name('calibrations.form-update');
    
    // Export route
    Route::get('/calibrations/{id}/export', [CalibrationController::class, 'export'])
        ->name('calibrations.export');

    // Excel Editor Routes
    Route::get('/calibrations/{id}/open-excel', [CalibrationController::class, 'openExcel'])
        ->name('calibrations.open-excel');

    Route::post('/calibrations/{id}/save-excel', [CalibrationController::class, 'saveExcel'])
        ->name('calibrations.save-excel');

    // Route untuk download Excel dengan template
    Route::get('/calibrations/{id}/download-excel-template', 
        [CalibrationController::class, 'downloadExcelTemplate'])
        ->name('calibrations.download.excel.template');
    
    Route::get('/calibrations/{id}/download-verified', [CalibrationController::class, 'downloadVerified'])
        ->name('calibrations.download.verified');

    Route::get('/calibrations/{id}/download/rejected', [CalibrationController::class, 'downloadRejected'])
        ->name('calibrations.download.rejected');
        
    // Alat Standard Routes
    Route::resource('alat-standards', AlatStandardController::class);
    
    // Metode Kalibrasi Routes
    Route::resource('calibration-methods', CalibrationMethodController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Change Password Routes
    Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])
        ->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])
        ->name('password.update');

    // Profile Photo Routes
    Route::get('/profile/photo', [ProfilePhotoController::class, 'edit'])->name('profile.photo');
    Route::post('/profile/photo', [ProfilePhotoController::class, 'update'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfilePhotoController::class, 'destroy'])->name('profile.photo.destroy');

     // Rute untuk log kalibrasi
    Route::prefix('log-kalibrasi')->name('log-kalibrasi.')->group(function () {
        Route::get('/', [LogKalibrasiController::class, 'index'])->name('index');
        Route::get('/ajax', [LogKalibrasiController::class, 'ajax'])->name('ajax');
        Route::get('/export', [LogKalibrasiController::class, 'export'])->name('export');
        Route::get('/kalibrasi/{kalibrasi_id}', [LogKalibrasiController::class, 'showByKalibrasi'])->name('per-kalibrasi');
        Route::get('/{id}', [LogKalibrasiController::class, 'show'])->name('show');
        Route::get('/bersihkan/log-lama', [LogKalibrasiController::class, 'bersihkan'])->name('bersihkan');
    });
});

