<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Judger extends Model
{
    protected $fillable = [
        'judger_url','is_running'
    ];
    protected $casts = [
        'is_running' => 'boolean',
    ];
}
