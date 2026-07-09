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
    
    // Route '/'
    Route::get('/', function () {
        $role = auth()->user()->role;

        if ($role == 'baa') {
            return redirect()->route('baa.dashboard');
        } elseif ($role == 'dosen') {
            return redirect('/nilai'); 
        }

        return redirect('/mahasiswa'); 
    });

    // ------------------------------------------
    // A. HAK AKSES UTAMA: BAA & ADMIN 
    // (Ayeuna BAA geus bisa nénjo data Mahasiswa, Dosen, jeung Nilai)
    // ------------------------------------------
    Route::middleware('role:baa,admin')->group(function () {
        
        // Dashboard BAA
        Route::get('/baa/dashboard', function () {
            return view('baa.dashboard'); 
        })->name('baa.dashboard');

        // Master data akademik biasa
        Route::resource('kelas', KelasController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('matakuliah', MataKuliahController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('semester', SemesterController::class);
        Route::resource('jadwal', JadwalController::class);

        // TAH IEU LUR: BAA geus dibéré aksés asup ka dieu
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
        Route::resource('nilai', NilaiController::class);
    });

    // ------------------------------------------
    // B. HAK AKSES KHUSUS: ADMIN UTAMA SAJA
    // (Kosongkeun heula da bieu data mhs/dosen geus dipindahkeun ka luhur)
    // ------------------------------------------
    Route::middleware('role:admin')->group(function () {
        // Kontrol akun tingkat luhur mun diperlukeun engké
    });

    // ------------------------------------------
    // C. HAK AKSES KHUSUS: DOSEN & ADMIN
    // (Urusan input nilai & absensi)
    // ------------------------------------------
    Route::middleware('role:dosen,admin')->group(function () {
        Route::resource('absensi', AbsensiController::class);
        // Nilai controller dihancupkeun fungsina keur dosen di dieu oge meunang
    });

});