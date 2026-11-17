<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssistanceRequestController;
use App\Http\Controllers\AdminAssistanceController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard berdasarkan Role
Route::get('/dashboard', function () {
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.assistance.index');
    }
    return redirect()->route('assistance.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Redirect akses /admin langsung ke dashboard admin
Route::get('/admin', function () {
    return redirect()->route('admin.assistance.index');
})->middleware(['auth', AdminMiddleware::class]);

// Group Route khusus User yang sudah Auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/assistance', [AssistanceRequestController::class, 'index'])->name('assistance.index');
    Route::get('/assistance/create', [AssistanceRequestController::class, 'create'])->name('assistance.create');
    Route::post('/assistance', [AssistanceRequestController::class, 'store'])->name('assistance.store');
});

// Group Route khusus Admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/assistance', [AdminAssistanceController::class, 'index'])->name('admin.assistance.index');
    Route::patch('/admin/assistance/{assistanceRequest}/status', [AdminAssistanceController::class, 'updateStatus'])->name('admin.assistance.updateStatus');
});

require __DIR__.'/auth.php';