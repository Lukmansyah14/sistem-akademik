@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="font-weight-bold mb-0">📅 Jadwal Perkuliahan</h4>
        <a href="{{ route('dosen.dashboard') }}" class="btn btn-sm btn-outline-secondary">⬅️ Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($semuaJadwal->isEmpty())
                <p class="text-muted mb-0 text-center py-3">Belum ada jadwal yang tersedia.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($semuaJadwal as $jadwal)
                                <tr class="{{ $jadwal->dosen == $namaDosen ? 'table-primary' : '' }}">
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->jam }}</td>
                                    <td>{{ $jadwal->mata_kuliah }}</td>
                                    <td>
                                        {{ $jadwal->dosen }}
                                        @if($jadwal->dosen == $namaDosen)
                                            <span class="badge badge-primary">Anda</span>
                                        @endif
                                    </td>
                                    <td>{{ $jadwal->ruangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-muted small mt-2 mb-0">Baris berwarna biru menandakan jadwal mengajar Anda.</p>
            @endif
        </div>
    </div>
</div>
@endsection
