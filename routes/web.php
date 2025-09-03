<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Dashboard untuk user biasa (menggunakan Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

// Route untuk admin - redirect ke Filament admin panel
Route::get('/admin-dashboard', function () {
    return redirect('/admin');
})->middleware(['auth', 'admin'])->name('admin.dashboard');

// Routes untuk voting
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
    Route::post('/voting', [VotingController::class, 'store'])->name('voting.store');
    Route::get('/voting/success', [VotingController::class, 'success'])->name('voting.success');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
