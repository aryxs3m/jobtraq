<?php

namespace App\Models;

use App\Services\Scraper\DTOs\SalaryType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\JobListing.
 *
 * @property Carbon     $created_at        létrehozási idő
 * @property Carbon     $updated_at        frissítési idő
 * @property string     $name              a hirdetés teljes, eredeti neve
 * @property SalaryType $salary_type       fizetés típusa
 * @property int        $salary_low        fizetési sáv alja
 * @property int        $salary_high       fizetési sáv teteje
 * @property int        $salary_avg        átlagfizetés (fizetési sáv aljából és tetejéből számítva)
 * @property int        $salary_currency   deviza
 * @property string     $original_location munkavégzés helye
 * @property Location   $location          munkavégzés helye
 * @property int        $location_id       munkavégzés helyének azonosítója
 * @property string     $level             JobLevel neve stringként
 * @property string     $position          JobPosition neve stringként
 * @property string     $stack             JobStack neve stringként
 * @property string     $crawler           Scraper class
 * @property int        $id
 * @method static \Database\Factories\JobListingFactory            factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereCrawler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereOriginalLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereSalaryAvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereSalaryCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereSalaryHigh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereSalaryLow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereSalaryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereStack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereUpdatedAt($value)
 * @property string $external_id
 * @method static \Illuminate\Database\Eloquent\Builder|JobListing whereExternalId($value)
 * @mixin \Eloquent
 */
class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'salary_type', 'salary_low', 'salary_high', 'salary_currency', 'original_location', 'level', 'position',
        'stack', 'crawler', 'location_id', 'external_id',
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
