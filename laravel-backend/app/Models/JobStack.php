<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\JobStack.
 *
 * @property Carbon      $created_at      létrehozási idő
 * @property Carbon      $updated_at      frissítési idő
 * @property string      $name            pozíció neve (pl. backend, frontend)
 * @property array       $keywords        kulcsszavak, amik alapján kikereshető címből
 * @property int         $job_position_id kapcsolódó pozíció azonosítója
 * @property JobPosition $jobPosition     kapcsolódó pozíció
 * @property int         $id
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack whereJobPositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStack whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keywords', 'job_position_id',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}
