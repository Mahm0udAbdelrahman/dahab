<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'favicon',
        'facebook',
        'instagram',
        'tiktok',
        'whatsapp',
    ];

    protected $casts = [
        'name'    => 'array',
        'address' => 'array',
    ];
}
