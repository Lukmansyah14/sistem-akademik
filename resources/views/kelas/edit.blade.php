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
        <select name="wali_kelas_id" class="form-control">
            @foreach ($dosens as $d)
                <option value="{{ $d->id }}" {{ $kelas->wali_kelas_id == $d->id ? 'selected' : '' }}>
                    {{ $d->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Update</button>
</form>

@endsection
