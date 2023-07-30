<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $scraper
 * @property array $log
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
