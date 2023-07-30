<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $name pozíció neve (pl. backend, frontend)
 * @property array $keywords kulcsszavak, amik alapján kikereshető címből
 * @property int $order sorrend
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
