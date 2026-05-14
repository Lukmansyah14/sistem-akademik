@extends('layout.app')

@section('content')

<h1>Edit Kelas</h1>

<form action="/kelas/{{ $kelas->id }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}">
    </div>

    <div class="mb-3">
        <label>Tingkat</label>
        <input type="text" name="tingkat" class="form-control" value="{{ $kelas->tingkat }}">
    </div>

    <div class="mb-3">
        <label>Wali Kelas</label>
        <input type="text" name="wali_kelas" class="form-control" value="{{ $kelas->wali_kelas }}">
    </div>

    <button class="btn btn-success">
        Update
    </button>

</form>

@endsection