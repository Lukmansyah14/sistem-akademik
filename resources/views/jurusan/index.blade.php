@extends('layout.app')

@section('content')

<h1>Data Jurusan</h1>

<a href="/jurusan/create" class="btn btn-primary mb-3">
    Tambah Jurusan
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama Jurusan</th>
        <th>Kode Jurusan</th>
        <th>Aksi</th>
    </tr>

    @foreach($jurusan as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_jurusan }}</td>
        <td>{{ $item->kode_jurusan }}</td>

        <td>

            <a href="/jurusan/{{ $item->id }}/edit" class="btn btn-warning">
                Edit
            </a>

            <form action="/jurusan/{{ $item->id }}" method="POST" style="display:inline;">

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