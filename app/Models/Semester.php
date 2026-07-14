<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'nama_semester',
        'tahun_ajaran',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }
}