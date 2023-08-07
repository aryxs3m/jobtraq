<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CrawlerKeyword
 *
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $crawler scraper class
 * @property array $keywords keresési feltételek/kulcsszavak
 * @property int $id
 * @method static \Database\Factories\CrawlerKeywordFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword query()
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword whereCrawler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CrawlerKeyword whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CrawlerKeyword extends Model
{
    use HasFactory;

    protected $fillable = [
        'crawler', 'keywords',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];
}
