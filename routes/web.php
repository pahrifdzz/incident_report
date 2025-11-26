<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes dengan middleware admin untuk security
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reports/{report}', [AdminController::class, 'show'])->name('admin.reports.show');
    Route::post('/admin/reports/{report}/status', [AdminController::class, 'updateStatus'])->name('admin.reports.status');
    Route::get('/admin/export', [AdminController::class, 'exportExcel'])->name('admin.export');
    Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register.form');
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');
});

Route::get('/lapor', [ReportController::class, 'create'])->name('report.create');
Route::post('/lapor', [ReportController::class, 'store'])->name('report.store');


require __DIR__ . '/auth.php';
