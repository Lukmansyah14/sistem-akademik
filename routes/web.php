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

Route::resource('kelas', KelasController::class);

Route::resource('dosen', DosenController::class);

Route::resource('ruangan', RuanganController::class);

Route::resource('jurusan', JurusanController::class);

Route::resource('mahasiswa', MahasiswaController::class);

Route::resource('matakuliah', MataKuliahController::class);

Route::resource('semester', SemesterController::class);

Route::resource('jadwal', JadwalController::class);

Route::resource('nilai', NilaiController::class);

/*
|--------------------------------------------------------------------------
| Guest Routes (Hanya untuk yang belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Hanya untuk yang sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/', function () {
        return redirect('/mahasiswa');
    });
    
    // Mahasiswa Routes
    Route::resource('/mahasiswa', MahasiswaController::class);
    
    // Routes lainnya (Dosen, Jurusan, dll)
    // Route::resource('/dosen', DosenController::class);
    // Route::resource('/jurusan', JurusanController::class);
    // dst...
});