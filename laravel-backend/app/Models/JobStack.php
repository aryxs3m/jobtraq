<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $name pozíció neve (pl. backend, frontend)
 * @property array $keywords kulcsszavak, amik alapján kikereshető címből
 * @property int $job_position_id kapcsolódó pozíció azonosítója
 * @property JobPosition $jobPosition kapcsolódó pozíció
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
