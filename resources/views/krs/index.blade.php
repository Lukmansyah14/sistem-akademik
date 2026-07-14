@extends('layout.app')

@section('content')

<h3 class="mb-1">📋 Kartu Rencana Studi (KRS)</h3>
@if($semesterAktif)
    <p class="text-muted mb-4">Semester aktif: <strong>{{ $semesterAktif->nama_semester }} {{ $semesterAktif->tahun_ajaran }}</strong></p>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(!$semesterAktif)
    <div class="alert alert-warning">
        Belum ada semester aktif. Hubungi BAA untuk mengaktifkan semester sebelum mengisi KRS.
    </div>
@else

    {{-- KRS yang sudah diambil --}}
    <div class="card mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Mata Kuliah yang Sudah Diambil</span>
            <span class="badge bg-light text-dark">Total: {{ $totalSks }} / {{ \App\Http\Controllers\KrsController::MAX_SKS }} SKS</span>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Jadwal</th>
                        <th>Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krsSaya as $krs)
                        <tr>
                            <td>{{ $krs->jadwal->mataKuliah->kode_mk ?? '-' }}</td>
                            <td>{{ $krs->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $krs->jadwal->mataKuliah->sks ?? '-' }}</td>
                            <td>{{ $krs->jadwal->dosen->nama ?? '-' }}</td>
                            <td>{{ $krs->jadwal->hari }}, {{ $krs->jadwal->jam }}</td>
                            <td>{{ $krs->jadwal->ruangan->nama_ruangan ?? '-' }}</td>
                            <td>
                                <form action="{{ route('krs.destroy', $krs) }}" method="POST"
                                      onsubmit="return confirm('Batalkan mata kuliah ini dari KRS?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Batalkan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">Belum ada mata kuliah yang diambil.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mata kuliah yang tersedia untuk diambil --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            Mata Kuliah Tersedia Semester Ini
        </div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Prasyarat</th>
                        <th>Dosen</th>
                        <th>Jadwal</th>
                        <th>Kuota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalTersedia as $jadwal)
                        <tr>
                            <td>{{ $jadwal->mataKuliah->kode_mk ?? '-' }}</td>
                            <td>{{ $jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $jadwal->mataKuliah->sks ?? '-' }}</td>
                            <td>
                                @if($jadwal->mataKuliah?->prasyarat)
                                    <span class="badge bg-secondary">{{ $jadwal->mataKuliah->prasyarat->nama_mk }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $jadwal->dosen->nama ?? '-' }}</td>
                            <td>{{ $jadwal->hari }}, {{ $jadwal->jam }}</td>
                            <td>
                                @if($jadwal->sisa_kuota <= 0)
                                    <span class="badge bg-danger">Penuh</span>
                                @else
                                    <span class="badge bg-success">{{ $jadwal->sisa_kuota }} / {{ $jadwal->kapasitas }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('krs.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                    <button class="btn btn-sm btn-primary" {{ $jadwal->sisa_kuota <= 0 ? 'disabled' : '' }}>
                                        Ambil
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">Tidak ada mata kuliah tersedia / sudah semua diambil.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endif

@endsection