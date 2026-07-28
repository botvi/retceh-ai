<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'price', 'credits', 'features', 'is_recommended'];

    protected $casts = [
        'features' => 'array',
        'is_recommended' => 'boolean',
    ];
}
