@extends('layout.app')

@section('content')

<h1>Data Ruangan</h1>

<a href="/ruangan/create" class="btn btn-primary mb-3">
    Tambah Ruangan
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama Ruangan</th>
        <th>Kode Ruangan</th>
        <th>Kapasitas</th>
        <th>Aksi</th>
    </tr>

    @foreach($ruangan as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_ruangan }}</td>
        <td>{{ $item->kode_ruangan }}</td>
        <td>{{ $item->kapasitas }}</td>

        <td>

            <a href="/ruangan/{{ $item->id }}/edit" class="btn btn-warning">
                Edit
            </a>

            <form action="/ruangan/{{ $item->id }}" method="POST" style="display:inline;">

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