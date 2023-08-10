<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ScraperLog.
 *
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $scraper
 * @property array  $log
 * @property int    $id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog whereScraper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScraperLog whereUpdatedAt($value)
 *
 * @mixin \Eloquent
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
