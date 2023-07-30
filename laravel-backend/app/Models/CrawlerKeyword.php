<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $crawler scraper class
 * @property array $keywords keresési feltételek/kulcsszavak
 */
class CrawlerKeyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'crawler', 'keywords'
    ];

    protected $casts = [
        'keywords' => 'array',
    ];
}
