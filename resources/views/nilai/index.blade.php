@extends('layout.app')

@section('content')

<h1>Data Nilai</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(in_array(auth()->user()->role, ['dosen', 'admin']))
<a href="/nilai/create" class="btn btn-primary mb-3">
    Tambah Nilai
</a>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Mahasiswa</th>
            <th>Mata Kuliah</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
            <td>{{ $item->mataKuliah->nama_mk ?? '-' }}</td>
            <td>{{ $item->nilai_angka }}</td>
            <td>{{ $item->nilai_huruf }}</td>
            <td>
                @if(in_array(auth()->user()->role, ['dosen', 'admin']))
                    <a href="/nilai/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="/nilai/{{ $item->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin rék dihapus, lur?')">
                            Hapus
                        </button>
                    </form>
                @else
                    <span class="text-muted small">🔒 Read-Only (BAA)</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
