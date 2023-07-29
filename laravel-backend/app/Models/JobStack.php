<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobStack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'keywords', 'job_position_id'
    ];

    protected $casts = [
        'keywords' => 'array',
    ];

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}
