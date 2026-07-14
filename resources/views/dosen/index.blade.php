@extends('layout.app')

@section('content')

<h1>Data Dosen</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="/dosen/create" class="btn btn-primary mb-3">
    Tambah Dosen
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIDN</th>
        <th>Mata Kuliah</th>
        <th>Aksi</th>
    </tr>

    @foreach($dosen as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->nidn }}</td>
        <td>{{ $item->mataKuliah->nama_mk ?? '-' }}</td>

        <td>
            <a href="/dosen/{{ $item->id }}/edit" class="btn btn-warning">
                Edit
            </a>

            <form action="/dosen/{{ $item->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Yakin rék dihapus, lur?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>

    @endforeach

</table>

@endsection
