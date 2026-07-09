@extends('layout.app') {{-- Pastikeun 'layouts.app' ieu sarua jeung ngaran file template utama proyék maneh --}}

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <h2 class="font-weight-bold">Selamat Datang, Biro Administrasi Akademik! 👋</h2>
                    <p class="lead mb-0">Dashboard khusus BAA yang mengatur semua data data master Akademik</p>
                </div>
            </div>

            <h4 class="mb-3 font-weight-bold text-secondary">Menu Utama BAA:</h4>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title font-weight-bold text-primary">📅 Data Kelas</h5>
                                <p class="card-text text-muted small">Mengatur daftar kelas perkuliahan, kode kelas, dan kuota kelas.</p>
                            </div>
                            <a href="{{ url('/kelas') }}" class="btn btn-primary btn-block mt-3">Buka Menu Kelas</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title font-weight-bold text-success">⏱️ Jadwal Kuliah</h5>
                                <p class="card-text text-muted small">Menyusun jadwal harian perkuliahan, jam, serta dosen yang mengajar.</p>
                            </div>
                            <a href="{{ url('/jadwal') }}" class="btn btn-success btn-block mt-3">Buka Menu Jadwal</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title font-weight-bold text-warning text-dark">🏢 Ruangan</h5>
                                <p class="card-text text-muted small">Mengolah data gedung serta nomor ruangan yang dipakai unruk perkuliahan.</p>
                            </div>
                            <a href="{{ url('/ruangan') }}" class="btn btn-warning text-dark btn-block mt-3">Buka Menu Ruangan</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title font-weight-bold text-info">📚 Mata Kuliah</h5>
                                <p class="card-text text-muted small">Mengolah data kurikulum master mata kuliah, bobot SKS, dan kode MK.</p>
                            </div>
                            <a href="{{ url('/matakuliah') }}" class="btn btn-info text-white btn-block mt-3">Buka Mata Kuliah</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title font-weight-bold text-danger">🏛️ Jurusan / Prodi</h5>
                                <p class="card-text text-muted small">Mengatur daftar Program Studi serta Fakultas di lingkungan kampus.</p>
                            </div>
                            <a href="{{ url('/jurusan') }}" class="btn btn-danger btn-block mt-3">Buka Menu Jurusan</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title font-weight-bold text-secondary">🗓️ Semester</h5>
                                <p class="card-text text-muted small">Mengatur status semester aktif, apakah ganjil atau genap.</p>
                            </div>
                            <a href="{{ url('/semester') }}" class="btn btn-secondary btn-block mt-3">Buka Menu Semester</a>
                        </div>
                    </div>
                </div>
            </div> {{-- Akhir dari class row --}}

        </div>
    </div>
</div>
@endsection