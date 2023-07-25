<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keywords',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];
}
