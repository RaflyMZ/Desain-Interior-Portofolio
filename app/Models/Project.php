<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'kategori',
        'deskripsi',
        'client',
        'tahun',
        'cover_image',
        'urutan',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('order');
    }
}
