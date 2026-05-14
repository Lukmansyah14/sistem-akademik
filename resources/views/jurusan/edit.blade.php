@extends('layout.app')

@section('content')

<h1>Edit Jurusan</h1>

<form action="/jurusan/{{ $jurusan->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Jurusan</label>
        <input type="text" name="nama_jurusan" class="form-control" value="{{ $jurusan->nama_jurusan }}">
    </div>

    <div class="mb-3">
        <label>Kode Jurusan</label>
        <input type="text" name="kode_jurusan" class="form-control" value="{{ $jurusan->kode_jurusan }}">
    </div>

    <button class="btn btn-success">
        Update
    </button>

</form>

@endsection