@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 bg-primary text-white mb-4">
        <div class="card-body p-4">
            <h2 class="font-weight-bold">Selamat Datang, {{ auth()->user()->name }}! 🎓</h2>
            <p class="lead mb-0">
                Dashboard Mahasiswa
                @if($mahasiswa)
                    - NIM {{ $mahasiswa->nim }} / {{ $mahasiswa->jurusan }}
                @endif
            </p>
        </div>
    </div>

    @if(!$mahasiswa)
        <div class="alert alert-warning">
            Data mahasiswa dengan nama <strong>{{ auth()->user()->name }}</strong> belum ditemukan di data induk.
            Hubungi BAA agar data Anda didaftarkan supaya nilai dan absensi bisa tampil dengan benar.
        </div>
    @endif

    {{-- Ringkasan Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Rata-rata Nilai</h6>
                    <h2 class="font-weight-bold text-primary mb-0">{{ $rataRata }}</h2>
                    <p class="text-muted small mb-0">dari {{ $jumlahNilai }} mata kuliah</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Hadir</h6>
                    <h2 class="font-weight-bold text-success mb-0">{{ $rekapAbsensi['hadir'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Sakit / Izin</h6>
                    <h2 class="font-weight-bold text-warning mb-0">{{ $rekapAbsensi['sakit'] + $rekapAbsensi['izin'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Alpha</h6>
                    <h2 class="font-weight-bold text-danger mb-0">{{ $rekapAbsensi['alpha'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Nilai --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white font-weight-bold">📊 Nilai Saya</div>
                <div class="card-body">
                    @if($nilaiSaya->isEmpty())
                        <p class="text-muted mb-0 text-center py-3">Belum ada nilai yang tercatat.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Mata Kuliah</th>
                                        <th class="text-center">Angka</th>
                                        <th class="text-center">Huruf</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nilaiSaya as $nilai)
                                        <tr>
                                            <td>{{ $nilai->mata_kuliah }}</td>
                                            <td class="text-center">{{ $nilai->nilai_angka }}</td>
                                            <td class="text-center"><span class="badge badge-primary">{{ $nilai->nilai_huruf }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Absensi --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white font-weight-bold">📝 Riwayat Absensi</div>
                <div class="card-body">
                    @if($absensiSaya->isEmpty())
                        <p class="text-muted mb-0 text-center py-3">Belum ada riwayat absensi.</p>
                    @else
                        <div class="table-responsive" style="max-height: 320px; overflow-y: auto;">
                            <table class="table table-sm table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Mata Kuliah</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absensiSaya as $absen)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $absen->jadwal->mata_kuliah ?? '-' }}</td>
                                            <td class="text-center">
                                                @php
                                                    $badge = [
                                                        'hadir' => 'success',
                                                        'sakit' => 'warning',
                                                        'izin'  => 'info',
                                                        'alpha' => 'danger',
                                                    ][$absen->status] ?? 'secondary';
                                                @endphp
                                                <span class="badge badge-{{ $badge }}">{{ ucfirst($absen->status) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection