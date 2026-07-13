@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 bg-primary text-white mb-4">
        <div class="card-body p-4">
            <h2 class="font-weight-bold">Selamat Datang, {{ auth()->user()->name }}! 👨‍🏫</h2>
            <p class="lead mb-0">Dashboard Dosen - Kelola Nilai dan Absensi Perkuliahan Anda</p>
        </div>
    </div>

    {{-- Ringkasan Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Jadwal Mengajar</h6>
                    <h2 class="font-weight-bold text-primary mb-0">{{ $jumlahJadwal }}</h2>
                    <p class="text-muted small mb-0">kelas / mata kuliah</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Absensi Hari Ini</h6>
                    <h2 class="font-weight-bold text-success mb-0">{{ $absensiHariIni }}</h2>
                    <p class="text-muted small mb-0">catatan tercatat</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted text-uppercase small font-weight-bold">Total Nilai Diinput</h6>
                    <h2 class="font-weight-bold text-info mb-0">{{ $jumlahNilai }}</h2>
                    <p class="text-muted small mb-0">seluruh mata kuliah</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu Utama --}}
    <h4 class="mb-3 font-weight-bold text-secondary">Menu Dosen:</h4>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-primary">📊 Nilai Akademik</h5>
                        <p class="card-text text-muted small">Input dan kelola nilai mahasiswa untuk mata kuliah yang Anda ampu.</p>
                    </div>
                    <a href="{{ url('/nilai') }}" class="btn btn-primary btn-block mt-3">Kelola Nilai</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-success">📝 Absensi</h5>
                        <p class="card-text text-muted small">Catat dan pantau kehadiran mahasiswa di setiap pertemuan.</p>
                    </div>
                    <a href="{{ url('/absensi') }}" class="btn btn-success btn-block mt-3">Kelola Absensi</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-info">📅 Jadwal Kuliah</h5>
                        <p class="card-text text-muted small">Lihat seluruh jadwal perkuliahan, termasuk jadwal mengajar Anda.</p>
                    </div>
                    <a href="{{ route('dosen.jadwal') }}" class="btn btn-info btn-block mt-3 text-white">Lihat Jadwal</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Jadwal Mengajar Saya --}}
    <h4 class="mb-3 font-weight-bold text-secondary">Jadwal Mengajar Saya:</h4>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($jadwalSaya->isEmpty())
                <p class="text-muted mb-0 text-center py-3">
                    Belum ada jadwal mengajar yang tercatat atas nama Anda ({{ auth()->user()->name }}).
                    Hubungi BAA jika ini seharusnya tidak kosong.
                </p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwalSaya as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam }}</td>
                                    <td>{{ $jadwal->mata_kuliah }}</td>
                                    <td>{{ $jadwal->ruangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
