@extends('layout.app')

@section('content')

<h1>Tambah Nilai</h1>

<form action="/nilai" method="POST">
    @csrf

    <div class="mb-3">
        <label>Mahasiswa</label>
        <select name="mahasiswa_id" class="form-control">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach ($mahasiswas as $m)
                <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>
                    {{ $m->nama }} ({{ $m->nim }})
                </option>
            @endforeach
        </select>
        @error('mahasiswa_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Mata Kuliah</label>
        <select name="mata_kuliah_id" class="form-control">
            <option value="">-- Pilih Mata Kuliah --</option>
            @foreach ($mataKuliahs as $mk)
                <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                    {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>
        @error('mata_kuliah_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Nilai Angka</label>
        <input type="number" name="nilai_angka" class="form-control" value="{{ old('nilai_angka') }}">
        @error('nilai_angka') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Nilai Huruf</label>
        <input type="text" name="nilai_huruf" class="form-control" value="{{ old('nilai_huruf') }}">
        @error('nilai_huruf') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-success">Simpan</button>
</form>

@endsection
