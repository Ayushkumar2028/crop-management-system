<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\CropUpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [CropController::class, 'index'])->name('dashboard');
    Route::resource('crops', CropController::class);
    Route::get('/crops/{crop}/report', [CropController::class, 'generateReport'])->name('crops.report');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Crop Updates routes
    Route::post('/crops/{crop}/updates', [CropUpdateController::class, 'store'])->name('crop-updates.store');
    Route::delete('/crops/{crop}/updates/{update}', [CropUpdateController::class, 'destroy'])->name('crop-updates.destroy');
});

require __DIR__.'/auth.php';