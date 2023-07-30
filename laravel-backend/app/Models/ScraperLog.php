<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string scraper
 * @property array log
 */
class ScraperLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'scraper', 'log',
    ];

    protected $casts = [
        'log' => 'json',
    ];
}
