<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\JobLevel.
 *
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $name       pozíció neve (pl. backend, frontend)
 * @property array  $keywords   kulcsszavak, amik alapján kikereshető címből
 * @property int    $order      sorrend
 * @property int    $id
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLevel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keywords',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];
}
