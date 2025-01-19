<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ExperienceController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\PencariKerjaController;
use App\Http\Controllers\Admin\RiwayatPekerjaanController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to login if not authenticated
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // User Routes
    Route::middleware('user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Profile routes
        Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        
        // Experience routes
        Route::get('/experience', [ExperienceController::class, 'index'])->name('experience.index');
        Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
        Route::put('/experience/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
        Route::delete('/experience/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
        
        // Documents routes
        Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::post('/documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
        Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    });

    // Admin Routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('cards', CardController::class);
        Route::put('cards/{card}/approve', [CardController::class, 'approve'])->name('cards.approve');
        Route::put('cards/{card}/reject', [CardController::class, 'reject'])->name('cards.reject');
        Route::get('/pencari-kerja/export', [PencariKerjaController::class, 'export'])->name('pencari-kerja.export');
        Route::resource('pencari-kerja', PencariKerjaController::class);
        Route::resource('riwayat-pekerjaan', RiwayatPekerjaanController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    });
});
