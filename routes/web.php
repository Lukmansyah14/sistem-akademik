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
        } elseif ($role == 'admin') {
            return redirect('/admin/dashboard'); // TAH IEU: Admin diarahkeun ka Dashboardna, lain ka mahasiswa polosan deui!
        }

        return redirect('/mahasiswa'); 
    });

    // ------------------------------------------
    // A. HAK AKSES UTAMA: BAA & ADMIN 
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

        // BAA & Admin sarua bisa CRUD ayeuna mah
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
        Route::resource('nilai', NilaiController::class);
    });

    // ------------------------------------------
    // B. HAK AKSES KHUSUS: ADMIN UTAMA SAJA
    // ------------------------------------------
    Route::middleware('role:admin')->group(function () {
        // TAH IEU LUR: Nambahkeun rute tampilan dashboard khusus admin di dieu!
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // ------------------------------------------
    // C. HAK AKSES KHUSUS: DOSEN & ADMIN
    // ------------------------------------------
    Route::middleware('role:dosen,admin')->group(function () {
        Route::resource('absensi', AbsensiController::class);
    });

});