// routes/api.php (routes definition)
// ... existing routes ...

use App\Http\Controllers\CalibrationController; // NEW

Route::get('/calibrations', [CalibrationController::class, 'index']); // NEW
Route::post('/calibrations', [CalibrationController::class, 'store']); // NEW

// ... existing routes ...