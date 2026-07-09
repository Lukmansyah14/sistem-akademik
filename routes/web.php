<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\AbsensiController;

// ==========================================
// 1. GUEST ROUTES (Keur nu can login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

// ==========================================
// 2. AUTHENTICATED ROUTES (Kudu login heula)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // Logout 
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Route '/' geus dibenerkeun kurungna + dialungkeun ka dashboard masing-masing
    Route::get('/', function () {
        $role = auth()->user()->role;

        if ($role == 'baa') {
            return redirect()->route('baa.dashboard'); // <--- Lumpat ka kamar dashboard BAA
        } elseif ($role == 'dosen') {
            return redirect('/nilai'); 
        }

        return redirect('/mahasiswa'); 
    });

    // ------------------------------------------
    // A. HAK AKSES KHUSUS: BAA & ADMIN 
    // ------------------------------------------
    Route::middleware('role:baa,admin')->group(function () {
        
        // IEU KAMAR BARU KHUSUS BAA NU DIOMONGKEUN BIEU, LUR!
        Route::get('/baa/dashboard', function () {
            return view('baa.dashboard'); 
        })->name('baa.dashboard');

        Route::resource('kelas', KelasController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('matakuliah', MataKuliahController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('semester', SemesterController::class);
        Route::resource('jadwal', JadwalController::class);
    });

    // ------------------------------------------
    // B. HAK AKSES KHUSUS: ADMIN UTAMA SAJA 
    // ------------------------------------------
    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
    });

    // ------------------------------------------
    // C. HAK AKSES KHUSUS: DOSEN & ADMIN
    // ------------------------------------------
    Route::middleware('role:dosen,admin')->group(function () {
        Route::resource('nilai', NilaiController::class);
        Route::resource('absensi', AbsensiController::class);
    });

});