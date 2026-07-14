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
use App\Http\Controllers\KrsController;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Mahasiswa;

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
            return redirect()->route('dosen.dashboard');
        } elseif ($role == 'admin') {
            return redirect('/admin/dashboard'); // TAH IEU: Admin diarahkeun ka Dashboardna, lain ka mahasiswa polosan deui!
        } elseif ($role == 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }

        return redirect('/mahasiswa'); 
    });

    // ------------------------------------------
    // PENTING: Dashboard dosen & mahasiswa HARUS didaftarkan
    // SEBELUM Route::resource('dosen'/'mahasiswa', ...) di bawah.
    // Soalna Route::resource otomatis bikin rute wildcard
    // GET dosen/{dosen} jeung GET mahasiswa/{mahasiswa} (halaman show),
    // nu bakal "nelen" /dosen/dashboard jeung /mahasiswa/dashboard
    // lamun didaftarkeun ti heula (Laravel newiskeun rute ti luhur ka handap).
    // ------------------------------------------
    Route::middleware('role:dosen,admin')->group(function () {
        Route::get('/dosen/dashboard', function () {
            $namaDosen = auth()->user()->name;

            $jumlahJadwal   = Jadwal::where('dosen', $namaDosen)->count();
            $jadwalSaya     = Jadwal::where('dosen', $namaDosen)->orderBy('hari')->orderBy('jam')->get();
            $absensiHariIni = Absensi::whereDate('tanggal', today())->count();
            $jumlahNilai    = Nilai::count();

            return view('dosen.dashboard', compact(
                'jumlahJadwal', 'jadwalSaya', 'absensiHariIni', 'jumlahNilai'
            ));
        })->name('dosen.dashboard');

        // Lihat seluruh jadwal kuliah (read-only, teu bisa edit/hapus)
        Route::get('/dosen/jadwal', function () {
            $namaDosen    = auth()->user()->name;
            $semuaJadwal  = Jadwal::orderBy('hari')->orderBy('jam')->get();

            return view('dosen.jadwal', compact('semuaJadwal', 'namaDosen'));
        })->name('dosen.jadwal');
    });

    Route::middleware('role:mahasiswa,admin')->group(function () {
        Route::get('/mahasiswa/dashboard', function () {
            $namaUser  = auth()->user()->name;
            $mahasiswa = Mahasiswa::where('nama', $namaUser)->first();

            $nilaiSaya   = Nilai::where('nama_mahasiswa', $namaUser)->orderByDesc('nilai_angka')->get();
            $jumlahNilai = $nilaiSaya->count();
            $rataRata    = $jumlahNilai > 0 ? round($nilaiSaya->avg('nilai_angka'), 2) : 0;

            // Mata kuliah dengan nilai tertinggi & terendah (untuk sorotan performa)
            $nilaiTertinggi = $jumlahNilai > 0 ? $nilaiSaya->sortByDesc('nilai_angka')->first() : null;
            $nilaiTerendah  = $jumlahNilai > 0 ? $nilaiSaya->sortBy('nilai_angka')->first() : null;

            $absensiSaya = $mahasiswa
                ? Absensi::with('jadwal')->where('mahasiswa_id', $mahasiswa->id)->orderByDesc('tanggal')->get()
                : collect();

            $rekapAbsensi = [
                'hadir' => $absensiSaya->where('status', 'hadir')->count(),
                'sakit' => $absensiSaya->where('status', 'sakit')->count(),
                'izin'  => $absensiSaya->where('status', 'izin')->count(),
                'alpha' => $absensiSaya->where('status', 'alpha')->count(),
            ];

            $totalAbsensi        = $absensiSaya->count();
            $persentaseKehadiran = $totalAbsensi > 0 ? round(($rekapAbsensi['hadir'] / $totalAbsensi) * 100) : 100;

            // Jadwal kuliah hari ini (dicocokkan dari nama hari dalam Bahasa Indonesia)
            $namaHariIni = [
                'Sunday'    => 'Minggu',
                'Monday'    => 'Senin',
                'Tuesday'   => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday'  => 'Kamis',
                'Friday'    => 'Jumat',
                'Saturday'  => 'Sabtu',
            ][now()->format('l')];

            $jadwalHariIni = Jadwal::whereRaw('LOWER(TRIM(hari)) = ?', [strtolower($namaHariIni)])
                ->orderBy('jam')
                ->get();

            return view('mahasiswa.dashboard', compact(
                'mahasiswa', 'nilaiSaya', 'jumlahNilai', 'rataRata', 'absensiSaya', 'rekapAbsensi',
                'nilaiTertinggi', 'nilaiTerendah', 'persentaseKehadiran', 'jadwalHariIni', 'namaHariIni'
            ));
        })->name('mahasiswa.dashboard');

        // KRS: mahasiswa mengisi Kartu Rencana Studi untuk semester aktif
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
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

    // ------------------------------------------
    // D. HAK AKSES: BAA, DOSEN & ADMIN (Nilai)
    // ------------------------------------------
    Route::middleware('role:baa,dosen,admin')->group(function () {
        Route::resource('nilai', NilaiController::class);
    });

});