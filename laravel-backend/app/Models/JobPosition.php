<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
