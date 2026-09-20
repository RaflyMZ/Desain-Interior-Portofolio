<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'email',
        'telepon',
        'alamat',
        'instagram_url',
        'whatsapp',
        'linkedin_url',
    ];
}
