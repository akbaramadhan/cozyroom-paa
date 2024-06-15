<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $table = 'kos'; // Sesuaikan dengan nama tabel yang benar di dalam database Anda


    protected $fillable = [
        'kos',
        'deskripsi',
        'harga',
        'lokasi',
        'gambar',
    ];
}
