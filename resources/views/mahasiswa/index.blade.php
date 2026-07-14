@extends('layout.app')

@section('content')

<h1>Data Mahasiswa</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(in_array(auth()->user()->role, ['baa', 'admin']))
<a href="/mahasiswa/create" class="btn btn-primary mb-3">
    Tambah Mahasiswa
</a>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->nim }}</td>
            <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
            <td>
                @if(in_array(auth()->user()->role, ['baa', 'admin']))
                    <a href="/mahasiswa/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="/mahasiswa/{{ $item->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin rék dihapus, lur?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
