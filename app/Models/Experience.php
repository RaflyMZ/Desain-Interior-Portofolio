<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title',
        'company',
        'periode',
        'tahun_mulai',
        'tahun_selesai',
        'ringkasan',
        'deskripsi',
        'gallery',
        'urutan',
    ];

    protected $casts = [
        'tahun_mulai'    => 'integer',
        'tahun_selesai'  => 'integer',
        'gallery'        => 'array',
    ];
}
