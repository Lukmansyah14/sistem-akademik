@extends('layout.app')

@section('content')

<h1>Tambah Jadwal</h1>

<form action="/jadwal" method="POST">
    @csrf

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <select name="mata_kuliah_id" class="form-control">
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach ($mataKuliahs as $mk)
                <option value="{{ $mk->id }}">{{ $mk->nama_mk }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Dosen</label>
        <select name="dosen_id" class="form-control">
            <option value="">-- Pilih Dosen --</option>
            @foreach ($dosens as $d)
                <option value="{{ $d->id }}">{{ $d->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Ruangan</label>
        <select name="ruangan_id" class="form-control">
            <option value="">-- Pilih Ruangan --</option>
            @foreach ($ruangans as $r)
                <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Hari</label>
        <input type="text" name="hari" class="form-control">
    </div>

    <div class="mb-3">
        <label>Jam</label>
        <input type="text" name="jam" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@endsection
