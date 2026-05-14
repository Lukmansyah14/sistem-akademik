@extends('layout.app')

@section('content')

<h1>Edit Nilai</h1>

<form action="/nilai/{{ $data->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Mahasiswa</label>
        <input type="text"
               name="nama_mahasiswa"
               class="form-control"
               value="{{ $data->nama_mahasiswa }}">
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <input type="text"
               name="mata_kuliah"
               class="form-control"
               value="{{ $data->mata_kuliah }}">
    </div>

    <div class="mb-3">
        <label>Nilai Angka</label>
        <input type="number"
               name="nilai_angka"
               class="form-control"
               value="{{ $data->nilai_angka }}">
    </div>

    <div class="mb-3">
        <label>Nilai Huruf</label>
        <input type="text"
               name="nilai_huruf"
               class="form-control"
               value="{{ $data->nilai_huruf }}">
    </div>

    <button class="btn btn-primary">
        Update
    </button>

</form>

@endsection