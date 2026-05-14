@extends('layout.app')

@section('content')

<h1>Data Semester</h1>

<a href="/semester/create" class="btn btn-primary mb-3">
    Tambah Semester
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Nama Semester</th>
        <th>Tahun Ajaran</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_semester }}</td>
        <td>{{ $item->tahun_ajaran }}</td>

        <td>

            <a href="/semester/{{ $item->id }}/edit"
               class="btn btn-warning">
                Edit
            </a>

            <form action="/semester/{{ $item->id }}"
                  method="POST"
                  style="display:inline;">

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