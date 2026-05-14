@extends('layout.app')

@section('content')

<h1>Data Nilai</h1>

<a href="/nilai/create" class="btn btn-primary mb-3">
    Tambah Nilai
</a>

<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>Mahasiswa</th>
        <th>Mata Kuliah</th>
        <th>Nilai Angka</th>
        <th>Nilai Huruf</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $item)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nama_mahasiswa }}</td>
        <td>{{ $item->mata_kuliah }}</td>
        <td>{{ $item->nilai_angka }}</td>
        <td>{{ $item->nilai_huruf }}</td>

        <td>

            <a href="/nilai/{{ $item->id }}/edit"
               class="btn btn-warning">
                Edit
            </a>

            <form action="/nilai/{{ $item->id }}"
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