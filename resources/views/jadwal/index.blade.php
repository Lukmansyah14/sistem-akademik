@extends('layout.app')

@section('content')

<h1>Data Jadwal</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="/jadwal/create" class="btn btn-primary mb-3">
    Tambah Jadwal
</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Mata Kuliah</th>
        <th>Dosen</th>
        <th>Ruangan</th>
        <th>Hari</th>
        <th>Jam</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->mataKuliah->nama_mk ?? '-' }}</td>
        <td>{{ $item->dosen->nama ?? '-' }}</td>
        <td>{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
        <td>{{ $item->hari }}</td>
        <td>{{ $item->jam }}</td>
        <td>
            <a href="/jadwal/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
            <form action="/jadwal/{{ $item->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Yakin rék dihapus, lur?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
