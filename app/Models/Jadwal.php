<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = ['mata_kuliah_id', 'dosen_id', 'ruangan_id', 'semester_id', 'hari', 'jam', 'kapasitas'];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    // Jumlah mahasiswa yang sudah mengambil jadwal ini (status masih aktif/diambil)
    public function getJumlahPesertaAttribute()
    {
        return $this->krs()->diambil()->count();
    }

    public function getSisaKuotaAttribute()
    {
        return max(0, $this->kapasitas - $this->jumlah_peserta);
    }
}