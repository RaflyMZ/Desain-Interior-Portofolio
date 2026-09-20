<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'tanggal',
        'deskripsi',
        'file_url',
        'urutan',
    ];
}
