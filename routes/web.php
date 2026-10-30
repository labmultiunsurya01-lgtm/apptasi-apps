<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryController;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/galeri/{gallery}', [HomeController::class, 'galleryShow'])->name('gallery.show');

// Anggota
Route::get('/anggota', [MemberController::class, 'index'])->name('members.index');
Route::post('/anggota/daftar', [MemberController::class, 'register'])->name('members.register');
Route::get('/anggota/kartu/{member}', [MemberController::class, 'printCard'])->middleware('auth')->name('members.card');

// Auth Admin
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit')
        ->middleware('throttle:5,1');
});
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::post('/ganti-password', [AuthController::class, 'changePassword'])
    ->middleware('auth')
    ->name('password.change');

// Admin (terproteksi autentikasi + role admin)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/approve/{member}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/reject/{member}', [AdminController::class, 'reject'])->name('admin.reject');
    Route::post('/renew/{member}', [AdminController::class, 'renew'])->name('admin.renew');
    Route::delete('/delete/{member}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
    Route::get('/export/pdf', [AdminController::class, 'exportPdf'])->name('admin.export.pdf');
    Route::get('/dokumen/{member}/{type}', [AdminController::class, 'viewDocument'])->name('admin.document');
    
    // Gallery Management
    Route::resource('gallery', GalleryController::class, ['as' => 'admin']);
});

