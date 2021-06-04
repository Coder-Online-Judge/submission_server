<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name', 'is_archived',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
    ];
}
