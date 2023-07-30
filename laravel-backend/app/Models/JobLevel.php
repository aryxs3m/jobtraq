<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $name pozíció neve (pl. backend, frontend)
 * @property array $keywords kulcsszavak, amik alapján kikereshető címből
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
