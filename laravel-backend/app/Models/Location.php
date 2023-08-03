<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string  $location    város vagy hely megnevezés
 * @property integer $country_id  ország azonosítója
 * @property Country $country     ország
 */
class Location extends Model
{
    use HasFactory;

    /**
     * Magyarország mindig az 1-es location kell legyen.
     */
    public const LOCATION_HUNGARY = 1;

    protected $fillable = [
        'location', 'country_id',
    ];

    public function jobListings(): HasMany
    {
        return $this->hasMany(JobListing::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
