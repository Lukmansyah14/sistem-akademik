<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'nama_mahasiswa',
        'mata_kuliah',
        'nilai_angka',
        'nilai_huruf'
    ];
}