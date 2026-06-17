<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LocationPage extends Model
{
    protected $fillable = [
        'country_name',
        'country_code',
        'country_slug',
        'state_name',
        'state_code',
        'state_slug',
        'city_name',
        'city_slug',
        'type',
        'last_modified',
    ];

    protected $casts = [
        'last_modified' => 'date',
    ];

    // ─── Type Constants ─────────────────────────────────────────────────────

    const TYPE_COUNTRY = 'country';
    const TYPE_STATE   = 'state';
    const TYPE_CITY    = 'city';

    // ─── Scopes ─────────────────────────────────────────────────────────────

    public function scopeCountries(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_COUNTRY);
    }

    public function scopeStates(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_STATE);
    }

    public function scopeCities(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_CITY);
    }

    public function scopeForCountry(Builder $query, string $countrySlug): Builder
    {
        return $query->where('country_slug', $countrySlug);
    }

    public function scopeForState(Builder $query, string $countrySlug, string $stateSlug): Builder
    {
        return $query->where('country_slug', $countrySlug)
                     ->where('state_slug', $stateSlug);
    }

    // ─── URL Builders ────────────────────────────────────────────────────────

    /**
     * Build the canonical URL for this location under a given ERP type prefix.
     *
     * @param  string $prefix  'school-erp' | 'institute-erp'
     */
    public function canonicalUrl(string $prefix): string
    {
        $segments = [$prefix, $this->country_slug];

        if ($this->type === self::TYPE_STATE || $this->type === self::TYPE_CITY) {
            $segments[] = $this->state_slug;
        }
        if ($this->type === self::TYPE_CITY) {
            $segments[] = $this->city_slug;
        }

        return url(implode('/', $segments));
    }

    /**
     * Returns a breadcrumb array suitable for rendering.
     *
     * @param  string $prefix  'school-erp' | 'institute-erp'
     * @return array<array{label: string, url: string}>
     */
    public function breadcrumbs(string $prefix): array
    {
        $crumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => $this->country_name, 'url' => url("{$prefix}/{$this->country_slug}")],
        ];

        if ($this->type === self::TYPE_STATE || $this->type === self::TYPE_CITY) {
            $crumbs[] = [
                'label' => $this->state_name,
                'url'   => url("{$prefix}/{$this->country_slug}/{$this->state_slug}"),
            ];
        }

        if ($this->type === self::TYPE_CITY) {
            $crumbs[] = [
                'label' => $this->city_name,
                'url'   => url("{$prefix}/{$this->country_slug}/{$this->state_slug}/{$this->city_slug}"),
            ];
        }

        return $crumbs;
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    /** Human-readable location name (most specific first). */
    public function displayName(): string
    {
        return match ($this->type) {
            self::TYPE_CITY    => "{$this->city_name}, {$this->state_name}, {$this->country_name}",
            self::TYPE_STATE   => "{$this->state_name}, {$this->country_name}",
            self::TYPE_COUNTRY => $this->country_name,
        };
    }

    /** Returns the lastmod string for sitemap (YYYY-MM-DD). */
    public function lastmodString(): string
    {
        return $this->last_modified->format('Y-m-d');
    }
}
