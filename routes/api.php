<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CalibrationScheduleController;

// Calibration Schedule API Routes (Terpisah, tidak ganggu controller lama)
Route::prefix('calibrations')->group(function () {
    Route::post('/sync', [CalibrationScheduleController::class, 'sync']);
    Route::get('/scheduled', [CalibrationScheduleController::class, 'scheduled']);
    Route::post('/{id}/complete', [CalibrationScheduleController::class, 'complete']);
});
