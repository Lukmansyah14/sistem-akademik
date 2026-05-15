<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'jadwal_id',
        'tanggal',
        'status',
        'keterangan',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // Scope untuk filter status
    public function scopeHadir($query)
    {
        return $query->where('status', 'hadir');
    }

    public function scopeSakit($query)
    {
        return $query->where('status', 'sakit');
    }

    public function scopeIzin($query)
    {
        return $query->where('status', 'izin');
    }

    public function scopeAlpha($query)
    {
        return $query->where('status', 'alpha');
    }
}