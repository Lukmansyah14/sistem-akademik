@extends('layouts.tugas')

@section('title', 'Detail Absensi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">
                <i class="fa fa-info-circle me-2"></i>Detail Absensi
            </h5>
            <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left me-1"></i>Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Mahasiswa</th>
                            <td>: {{ $absensi->mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>: {{ $absensi->mahasiswa->nim ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Mata Kuliah</th>
                            <td>: {{ $absensi->jadwal->mataKuliah->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>: {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Status</th>
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
                                <span class="badge {{ $badgeClass[$absensi->status] }} fs-6">
                                    {{ $statusText[$absensi->status] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>: {{ $absensi->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>: {{ $absensi->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate</th>
                            <td>: {{ $absensi->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-warning text-white">
                <i class="fa fa-edit me-1"></i>Edit
            </a>
            <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash me-1"></i>Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection