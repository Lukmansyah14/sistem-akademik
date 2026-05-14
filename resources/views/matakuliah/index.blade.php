@extends('layout.app')

@section('content')

<h1>Data Mata Kuliah</h1>

<a href="/matakuliah/create" class="btn btn-primary mb-3">
    Tambah Mata Kuliah
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama Mata Kuliah</th>
        <th>Kode Mata Kuliah</th>
        <th>SKS</th>
        <th>Aksi</th>
    </tr>

    @foreach($matakuliah as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_matakuliah }}</td>
        <td>{{ $item->kode_matakuliah }}</td>
        <td>{{ $item->sks }}</td>

        <td>

            <a href="/matakuliah/{{ $item->id }}/edit" class="btn btn-warning">
                Edit
            </a>

            <form action="/matakuliah/{{ $item->id }}" method="POST" style="display:inline;">

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