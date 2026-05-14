@extends('layout.app')

@section('content')

<h1>Data Mahasiswa</h1>

<a href="/mahasiswa/create" class="btn btn-primary mb-3">
    Tambah Mahasiswa
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>

    @foreach($mahasiswa as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->nim }}</td>
        <td>{{ $item->jurusan }}</td>
        <td>

            <a href="/mahasiswa/{{ $item->id }}/edit" class="btn btn-warning">
                Edit
            </a>

            <form action="/mahasiswa/{{ $item->id }}" method="POST" style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger">
                    Hapus
                </button>

            </form>

        </td>
    </tr>

    @endforeach

</table>

@endsection