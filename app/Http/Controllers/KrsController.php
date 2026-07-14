<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Nilai;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    // Batas maksimal SKS yang boleh diambil mahasiswa dalam satu semester
    const MAX_SKS = 24;

    /**
     * Ambil data Mahasiswa milik user yang sedang login.
     */
    private function mahasiswaAktif()
    {
        return auth()->user()->mahasiswa;
    }

    public function index()
    {
        $mahasiswa = $this->mahasiswaAktif();
        $semesterAktif = Semester::aktif()->first();

        if (!$mahasiswa) {
            return back()->with('error', 'Akun Anda belum terhubung ke data Mahasiswa. Hubungi BAA.');
        }

        if (!$semesterAktif) {
            return view('mahasiswa.krs.index', [
                'semesterAktif' => null,
                'krsSaya' => collect(),
                'totalSks' => 0,
                'jadwalTersedia' => collect(),
            ]);
        }

        $krsSaya = Krs::with(['jadwal.mataKuliah', 'jadwal.dosen', 'jadwal.ruangan'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('semester_id', $semesterAktif->id)
            ->diambil()
            ->get();

        $totalSks = $krsSaya->sum(fn ($krs) => $krs->jadwal->mataKuliah->sks ?? 0);

        $jadwalDiambilIds = $krsSaya->pluck('jadwal_id');

        $jadwalTersedia = Jadwal::with(['mataKuliah.prasyarat', 'dosen', 'ruangan'])
            ->where('semester_id', $semesterAktif->id)
            ->whereNotIn('id', $jadwalDiambilIds)
            ->get();

        return view('mahasiswa.krs.index', compact(
            'semesterAktif', 'krsSaya', 'totalSks', 'jadwalTersedia'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);

        $mahasiswa = $this->mahasiswaAktif();
        if (!$mahasiswa) {
            return back()->with('error', 'Akun Anda belum terhubung ke data Mahasiswa. Hubungi BAA.');
        }

        $semesterAktif = Semester::aktif()->first();
        if (!$semesterAktif) {
            return back()->with('error', 'Tidak ada semester aktif untuk pengisian KRS saat ini.');
        }

        try {
            DB::transaction(function () use ($validated, $mahasiswa, $semesterAktif) {
                // Lock baris jadwal supaya pengecekan kuota aman dari race condition
                // saat banyak mahasiswa mengambil jadwal yang sama secara bersamaan.
                $jadwal = Jadwal::with('mataKuliah')
                    ->where('id', $validated['jadwal_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($jadwal->semester_id != $semesterAktif->id) {
                    throw new \Exception('Jadwal tersebut bukan penawaran semester aktif.');
                }

                // 1. Cek duplikat
                $sudahAmbil = Krs::where('mahasiswa_id', $mahasiswa->id)
                    ->where('jadwal_id', $jadwal->id)
                    ->where('semester_id', $semesterAktif->id)
                    ->diambil()
                    ->exists();

                if ($sudahAmbil) {
                    throw new \Exception('Anda sudah mengambil mata kuliah ini pada semester ini.');
                }

                // 2. Cek prasyarat mata kuliah
                $mataKuliah = $jadwal->mataKuliah;
                if ($mataKuliah && $mataKuliah->prasyarat_id) {
                    $lulusPrasyarat = Nilai::where('mahasiswa_id', $mahasiswa->id)
                        ->where('mata_kuliah_id', $mataKuliah->prasyarat_id)
                        ->where('nilai_huruf', '!=', 'E')
                        ->exists();

                    if (!$lulusPrasyarat) {
                        $namaPrasyarat = $mataKuliah->prasyarat->nama_mk ?? 'mata kuliah prasyarat';
                        throw new \Exception("Anda belum lulus mata kuliah prasyarat: {$namaPrasyarat}.");
                    }
                }

                // 3. Cek kapasitas kelas (dihitung ulang di dalam lock, bukan dari data view)
                $jumlahPeserta = Krs::where('jadwal_id', $jadwal->id)->diambil()->count();
                if ($jumlahPeserta >= $jadwal->kapasitas) {
                    throw new \Exception('Kuota kelas untuk jadwal ini sudah penuh.');
                }

                // 4. Cek batas maksimal SKS mahasiswa di semester ini
                $sksTerpakai = Krs::with('jadwal.mataKuliah')
                    ->where('mahasiswa_id', $mahasiswa->id)
                    ->where('semester_id', $semesterAktif->id)
                    ->diambil()
                    ->get()
                    ->sum(fn ($krs) => $krs->jadwal->mataKuliah->sks ?? 0);

                $sksBaru = $mataKuliah->sks ?? 0;
                if ($sksTerpakai + $sksBaru > self::MAX_SKS) {
                    throw new \Exception('Total SKS akan melebihi batas maksimal ('.self::MAX_SKS.' SKS).');
                }

                // Semua validasi lolos -> catat transaksi KRS
                Krs::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'jadwal_id' => $jadwal->id,
                    'semester_id' => $semesterAktif->id,
                    'status' => 'diambil',
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroy(Krs $krs)
    {
        $mahasiswa = $this->mahasiswaAktif();

        if (!$mahasiswa || $krs->mahasiswa_id !== $mahasiswa->id) {
            abort(403, 'Anda tidak berhak membatalkan KRS ini.');
        }

        $krs->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Mata kuliah berhasil dibatalkan dari KRS.');
    }
}