<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @mixin \Eloquent
 */
class JobPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keywords', 'order',
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public function stacks(): HasMany
    {
        return $this->hasMany(JobStack::class);
    }
}
