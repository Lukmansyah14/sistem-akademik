@extends('layout.app')

@section('content')

<h1>Tambah Kelas</h1>

<form action="/kelas" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" class="form-control" value="{{ old('nama_kelas') }}">
        @error('nama_kelas') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Tingkat</label>
        <input type="text" name="tingkat" class="form-control" value="{{ old('tingkat') }}">
        @error('tingkat') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Wali Kelas</label>
        <select name="wali_kelas_id" class="form-control">
            <option value="">-- Pilih Dosen --</option>
            @foreach ($dosens as $d)
                <option value="{{ $d->id }}" {{ old('wali_kelas_id') == $d->id ? 'selected' : '' }}>
                    {{ $d->nama }}
                </option>
            @endforeach
        </select>
        @error('wali_kelas_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
