<?php

namespace App\Models;

use App\Services\Crawler\DTOs\SalaryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'salary_type', 'salary_low', 'salary_high', 'salary_currency', 'location', 'level', 'position', 'stack',
        'crawler',
    ];

    protected $casts = [
        'salary_type' => SalaryType::class,
    ];

}
