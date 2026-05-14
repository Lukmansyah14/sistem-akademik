@extends('layout.app')

@section('content')

<h1>Data Kelas</h1>

<a href="/kelas/create" class="btn btn-primary mb-3">
    Tambah Kelas
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Tingkat</th>
        <th>Wali Kelas</th>
        <th>Aksi</th>
    </tr>

    @foreach($kelas as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_kelas }}</td>
        <td>{{ $item->tingkat }}</td>
        <td>{{ $item->wali_kelas }}</td>

        <td>

            <a href="/kelas/{{ $item->id }}/edit" class="btn btn-warning">
                Edit
            </a>

            <form action="/kelas/{{ $item->id }}" method="POST" style="display:inline;">

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