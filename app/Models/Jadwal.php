<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'mata_kuliah',
        'dosen',
        'ruangan',
        'hari',
        'jam'
    ];
}