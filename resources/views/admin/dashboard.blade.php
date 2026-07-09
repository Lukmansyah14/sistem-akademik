@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0 bg-dark text-white mb-4">
        <div class="card-body p-4">
            <h2 class="font-weight-bold">Selamat Datang, Super Administrator! ⚡</h2>
            <p class="lead mb-0">Dashboard Utama Sistem Akademik - Hak Akses Penuh Manajemen Data</p>
        </div>
    </div>

    <h4 class="mb-3 font-weight-bold text-secondary">Menu Manajemen Sistem (Full Akses):</h4>
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-primary">📅 Data Kelas</h5>
                        <p class="card-text text-muted small">Kelola daftar kelas perkuliahan, kode kelas, dan kuota kelas.</p>
                    </div>
                    <a href="{{ url('/kelas') }}" class="btn btn-primary btn-block mt-3">Kelola Kelas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-success">⏱️ Jadwal Kuliah</h5>
                        <p class="card-text text-muted small">Kelola jadwal harian perkuliahan, jam, serta plotting dosen.</p>
                    </div>
                    <a href="{{ url('/jadwal') }}" class="btn btn-success btn-block mt-3">Kelola Jadwal</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-warning text-dark">🏢 Ruangan</h5>
                        <p class="card-text text-muted small">Kelola data gedung serta nomor ruangan perkuliahan.</p>
                    </div>
                    <a href="{{ url('/ruangan') }}" class="btn btn-warning text-dark btn-block mt-3">Kelola Ruangan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-info">📚 Mata Kuliah</h5>
                        <p class="card-text text-muted small">Kelola kurikulum master mata kuliah, bobot SKS, dan kode MK.</p>
                    </div>
                    <a href="{{ url('/matakuliah') }}" class="btn btn-info text-white btn-block mt-3">Kelola Mata Kuliah</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-danger">🏛️ Jurusan / Prodi</h5>
                        <p class="card-text text-muted small">Kelola daftar Program Studi serta Fakultas di lingkungan kampus.</p>
                    </div>
                    <a href="{{ url('/jurusan') }}" class="btn btn-danger btn-block mt-3">Kelola Jurusan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-secondary">🗓️ Semester</h5>
                        <p class="card-text text-muted small">Kelola status semester aktif, ganjil, genap, atau tahun ajaran.</p>
                    </div>
                    <a href="{{ url('/semester') }}" class="btn btn-secondary btn-block mt-3">Kelola Semester</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-dark">🎓 Data Mahasiswa</h5>
                        <p class="card-text text-muted small">Kelola data induk mahasiswa, NIM, sarta ploting kelas perkuliahan.</p>
                    </div>
                    <a href="{{ url('/mahasiswa') }}" class="btn btn-dark btn-block mt-3">Kelola Mahasiswa</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-dark">👨‍🏫 Data Dosen</h5>
                        <p class="card-text text-muted small">Kelola data induk dosen, NIDN, sarta master jadwal mengajar.</p>
                    </div>
                    <a href="{{ url('/dosen') }}" class="btn btn-dark btn-block mt-3">Kelola Dosen</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title font-weight-bold text-primary">📊 Nilai Akademik</h5>
                        <p class="card-text text-muted small">Kelola, verifikasi, dan pantau transkrip nilai akademik mahasiswa.</p>
                    </div>
                    <a href="{{ url('/nilai') }}" class="btn btn-primary btn-block mt-3">Kelola Nilai Kuliah</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection