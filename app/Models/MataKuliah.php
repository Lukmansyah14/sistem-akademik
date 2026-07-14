<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliahs';

    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'prasyarat_id'];

    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    // Mata kuliah prasyarat yang wajib lulus dulu sebelum mengambil matkul ini
    public function prasyarat()
    {
        return $this->belongsTo(MataKuliah::class, 'prasyarat_id');
    }

    // Mata kuliah lain yang menjadikan matkul ini sebagai prasyarat
    public function mataKuliahLanjutan()
    {
        return $this->hasMany(MataKuliah::class, 'prasyarat_id');
    }
}