<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\JobPosition.
 *
 * @property Carbon                                                              $created_at   létrehozási idő
 * @property Carbon                                                              $updated_at   frissítési idő
 * @property string                                                              $name         pozíció neve (pl. backend, frontend)
 * @property array                                                               $keywords     kulcsszavak, amik alapján kikereshető címből
 * @property int                                                                 $order        sorrend
 * @property int                                                                 $id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\JobStack> $stacks
 * @property int|null                                                            $stacks_count
 * @property ?JobPosition                                                        $jobPosition
 *
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereUpdatedAt($value)
 *
 * @property int $job_position_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereJobPositionId($value)
 *
 * @property int                                                        $hidden_in_statistics
 * @property \Illuminate\Database\Eloquent\Collection<int, JobPosition> $jobPositions
 * @property int|null                                                   $job_positions_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition whereHiddenInStatistics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobPosition notHidden()
 *
 * @mixin \Eloquent
 */
class JobPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keywords', 'order', 'job_position_id', 'hidden_in_statistics',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public function stacks(): HasMany
    {
        return $this->hasMany(JobStack::class);
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function jobPositions(): HasMany
    {
        return $this->hasMany(JobPosition::class);
    }

    public function scopeNotHidden(Builder $query): void
    {
        $query->where('hidden_in_statistics', '=', 0);
    }
}
