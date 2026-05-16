@extends('layout.app')

@section('title', 'Data Absensi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
            <h5 class="mb-0 font-weight-bold text-primary">
                <i class="fa fa-clipboard-check me-2"></i>Data Absensi
            </h5>
            <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                <i class="fa fa-plus"></i> Tambah Absensi
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensis as $absensi)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration }}</td>
                            <td>{{ $absensi->mahasiswa->nama }}</td>
                            <td>{{ $absensi->jadwal->mataKuliah->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                            <td>
                                @php
                                    $badgeClass = [
                                        'hadir' => 'bg-success',
                                        'sakit' => 'bg-warning',
                                        'izin' => 'bg-info',
                                        'alpha' => 'bg-danger'
                                    ];
                                    $statusText = [
                                        'hadir' => 'Hadir',
                                        'sakit' => 'Sakit',
                                        'izin' => 'Izin',
                                        'alpha' => 'Alpha'
                                    ];
                                @endphp
                                <span class="badge {{ $badgeClass[$absensi->status] }}">
                                    {{ $statusText[$absensi->status] }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('absensi.show', $absensi->id) }}" class="btn btn-sm btn-info text-white me-1" title="Detail">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fa fa-inbox fa-3x mb-3 d-block"></i>
                                    Belum ada data absensi
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $absensis->links() }}
        </div>
    </div>
</div>
@endsection