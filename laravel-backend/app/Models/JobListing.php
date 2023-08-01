<?php

namespace App\Models;

use App\Services\Scraper\DTOs\SalaryType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Carbon $created_at létrehozási idő
 * @property Carbon $updated_at frissítési idő
 * @property string $name a hirdetés teljes, eredeti neve
 * @property SalaryType $salary_type fizetés típusa
 * @property int $salary_low fizetési sáv alja
 * @property int $salary_high fizetési sáv teteje
 * @property int $salary_avg átlagfizetés (fizetési sáv aljából és tetejéből számítva)
 * @property int $salary_currency deviza
 * @property string $original_location munkavégzés helye
 * @property Location $location munkavégzés helye
 * @property integer $location_id munkavégzés helyének azonosítója
 * @property string $level JobLevel neve stringként
 * @property string $position JobPosition neve stringként
 * @property string $stack JobStack neve stringként
 * @property string $crawler Scraper class
 */
class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'salary_type', 'salary_low', 'salary_high', 'salary_currency', 'original_location', 'level', 'position',
        'stack', 'crawler', 'location_id',
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

    public function calculateAvgSalary(): void
    {
        $this->salary_avg = ($this->salary_low + $this->salary_high) / 2;
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
