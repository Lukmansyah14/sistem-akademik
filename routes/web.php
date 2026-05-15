<?php

use Illuminate\Support\Facades\Route;
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

Route::resource('kelas', KelasController::class);

Route::resource('dosen', DosenController::class);

Route::resource('ruangan', RuanganController::class);

Route::resource('jurusan', JurusanController::class);

Route::resource('mahasiswa', MahasiswaController::class);

Route::resource('matakuliah', MataKuliahController::class);

Route::resource('semester', SemesterController::class);

Route::resource('jadwal', JadwalController::class);

Route::resource('nilai', NilaiController::class);

Route::resource('absensi', AbsensiController::class);