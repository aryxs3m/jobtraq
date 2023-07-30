<?php

namespace App\Models;

use App\Services\Scraper\DTOs\SalaryType;
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

    protected static function boot()
    {
        parent::boot();

        self::creating(function (JobListing $listing) {
            $listing->calculateAvgSalary();
        });

        self::updating(function (JobListing $listing) {
            $listing->calculateAvgSalary();
        });
    }

    public function calculateAvgSalary()
    {
        $this->salary_avg = ($this->salary_low + $this->salary_high) / 2;
    }
}
