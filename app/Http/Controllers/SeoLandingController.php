<?php

namespace App\Http\Controllers;

use App\Models\LocationPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class SeoLandingController extends Controller
{
    // ── Cache TTL ──────────────────────────────────────────────────────────
    private const CACHE_TTL = 3600; // 1 hour

    // ── Per-page count for location hub directory ──────────────────────────
    private const PER_PAGE = 20;

    // ─────────────────────────────────────────────────────────────────────
    // Data access helpers (cached)
    // ─────────────────────────────────────────────────────────────────────

    private function allCities()
    {
        return Cache::remember('loc_cities', self::CACHE_TTL,
            fn () => LocationPage::cities()->get()
        );
    }

    private function allStates()
    {
        return Cache::remember('loc_states', self::CACHE_TTL,
            fn () => LocationPage::states()->get()
        );
    }

    private function allCountries()
    {
        return Cache::remember('loc_countries', self::CACHE_TTL,
            fn () => LocationPage::countries()->get()
        );
    }

    /**
     * Resolve a country record; abort 404 if not found.
     */
    private function findCountry(string $countrySlug): LocationPage
    {
        $record = Cache::remember("loc_country_{$countrySlug}", self::CACHE_TTL,
            fn () => LocationPage::countries()->where('country_slug', $countrySlug)->first()
        );

        abort_unless($record, 404, "Country '{$countrySlug}' not found.");
        return $record;
    }

    /**
     * Resolve a state record that belongs to the given country; abort 404 if not found.
     */
    private function findState(string $countrySlug, string $stateSlug): LocationPage
    {
        $record = Cache::remember("loc_state_{$countrySlug}_{$stateSlug}", self::CACHE_TTL,
            fn () => LocationPage::states()
                        ->where('country_slug', $countrySlug)
                        ->where('state_slug', $stateSlug)
                        ->first()
        );

        abort_unless($record, 404, "State '{$stateSlug}' in country '{$countrySlug}' not found.");
        return $record;
    }

    /**
     * Resolve a city record that belongs to the given country + state; abort 404 if not found.
     */
    private function findCity(string $countrySlug, string $stateSlug, string $citySlug): LocationPage
    {
        $record = Cache::remember("loc_city_{$countrySlug}_{$stateSlug}_{$citySlug}", self::CACHE_TTL,
            fn () => LocationPage::cities()
                        ->where('country_slug', $countrySlug)
                        ->where('state_slug', $stateSlug)
                        ->where('city_slug', $citySlug)
                        ->first()
        );

        abort_unless($record, 404, "City '{$citySlug}' in '{$stateSlug}/{$countrySlug}' not found.");
        return $record;
    }

    // ─────────────────────────────────────────────────────────────────────
    // Shared view builder
    // ─────────────────────────────────────────────────────────────────────

    /**
     * Build the seo-landing view from a resolved LocationPage record.
     *
     * @param  LocationPage $location  The record (city, state, or country level)
     * @param  string       $type      'school' | 'institute'
     * @param  string       $prefix    'school-erp' | 'institute-erp'
     */
    private function buildView(LocationPage $location, string $type, string $prefix)
    {
        $canonicalUrl = $location->canonicalUrl($prefix);
        $breadcrumbs  = $location->breadcrumbs($prefix);

        // Named variables for view clarity
        $city    = $location->city_name    ?? $location->state_name ?? $location->country_name;
        $state   = $location->state_name   ?? null;
        $country = $location->country_name;

        // Related pages for internal linking
        $siblingsInState  = ($location->type === LocationPage::TYPE_CITY && $location->state_slug)
            ? Cache::remember(
                "loc_siblings_{$location->country_slug}_{$location->state_slug}",
                self::CACHE_TTL,
                fn () => LocationPage::cities()
                            ->where('country_slug', $location->country_slug)
                            ->where('state_slug', $location->state_slug)
                            ->where('city_slug', '!=', $location->city_slug)
                            ->limit(8)
                            ->get()
              )
            : collect();

        $statesInCountry = ($location->type !== LocationPage::TYPE_STATE || true)
            ? Cache::remember(
                "loc_states_in_{$location->country_slug}",
                self::CACHE_TTL,
                fn () => LocationPage::states()
                            ->where('country_slug', $location->country_slug)
                            ->get()
              )
            : collect();

        return view('seo-landing', compact(
            'location',
            'type',
            'prefix',
            'city',
            'state',
            'country',
            'canonicalUrl',
            'breadcrumbs',
            'siblingsInState',
            'statesInCountry',
        ));
    }

    // ─────────────────────────────────────────────────────────────────────
    // School ERP — Canonical Handlers
    // ─────────────────────────────────────────────────────────────────────

    /** GET /school-erp/{country} */
    public function schoolCountry(string $country)
    {
        $loc = $this->findCountry($country);
        return $this->buildView($loc, 'school', 'school-erp');
    }

    /** GET /school-erp/{country}/{state} */
    public function schoolState(string $country, string $state)
    {
        $loc = $this->findState($country, $state);
        return $this->buildView($loc, 'school', 'school-erp');
    }

    /** GET /school-erp/{country}/{state}/{city} */
    public function schoolCity(string $country, string $state, string $city)
    {
        $loc = $this->findCity($country, $state, $city);
        return $this->buildView($loc, 'school', 'school-erp');
    }

    // ─────────────────────────────────────────────────────────────────────
    // Institute ERP — Canonical Handlers
    // ─────────────────────────────────────────────────────────────────────

    /** GET /institute-erp/{country} */
    public function instituteCountry(string $country)
    {
        $loc = $this->findCountry($country);
        return $this->buildView($loc, 'institute', 'institute-erp');
    }

    /** GET /institute-erp/{country}/{state} */
    public function instituteState(string $country, string $state)
    {
        $loc = $this->findState($country, $state);
        return $this->buildView($loc, 'institute', 'institute-erp');
    }

    /** GET /institute-erp/{country}/{state}/{city} */
    public function instituteCity(string $country, string $state, string $city)
    {
        $loc = $this->findCity($country, $state, $city);
        return $this->buildView($loc, 'institute', 'institute-erp');
    }

    // ─────────────────────────────────────────────────────────────────────
    // 301 Redirect Handlers (old URL format → new canonical)
    // /school-erp/{citySlug}  →  /school-erp/{country}/{state}/{city}
    // ─────────────────────────────────────────────────────────────────────

    /**
     * Old: /school-erp/{slug}  (could be city, state, or country slug)
     * Redirect to the correct canonical URL.
     */
    public function legacySchoolSingle(string $slug)
    {
        return $this->redirectLegacySingle($slug, 'school-erp');
    }

    /**
     * Old: /institute-erp/{slug}
     */
    public function legacyInstituteSingle(string $slug)
    {
        return $this->redirectLegacySingle($slug, 'institute-erp');
    }

    /**
     * Old: /school-erp/{city}/{state}  (old order: city then state)
     */
    public function legacySchoolCityState(string $city, string $state)
    {
        return $this->redirectLegacyCityState($city, $state, 'school-erp');
    }

    /**
     * Old: /institute-erp/{city}/{state}
     */
    public function legacyInstituteCityState(string $city, string $state)
    {
        return $this->redirectLegacyCityState($city, $state, 'institute-erp');
    }

    /**
     * Old: /school-erp/{city}/{state}/{country}
     */
    public function legacySchoolCityStateCountry(string $city, string $state, string $country)
    {
        return $this->redirectLegacyCityStateCountry($city, $state, $country, 'school-erp');
    }

    /**
     * Old: /institute-erp/{city}/{state}/{country}
     */
    public function legacyInstituteCityStateCountry(string $city, string $state, string $country)
    {
        return $this->redirectLegacyCityStateCountry($city, $state, $country, 'institute-erp');
    }

    // ── Private redirect logic ─────────────────────────────────────────

    private function redirectLegacySingle(string $slug, string $prefix)
    {
        // Try city first
        $city = LocationPage::cities()->where('city_slug', $slug)->first();
        if ($city) {
            return Redirect::to("/{$prefix}/{$city->country_slug}/{$city->state_slug}/{$city->city_slug}", 301);
        }

        // Try state
        $state = LocationPage::states()->where('state_slug', $slug)->first();
        if ($state) {
            return Redirect::to("/{$prefix}/{$state->country_slug}/{$state->state_slug}", 301);
        }

        // Try country
        $country = LocationPage::countries()->where('country_slug', $slug)->first();
        if ($country) {
            return Redirect::to("/{$prefix}/{$country->country_slug}", 301);
        }

        abort(404);
    }

    private function redirectLegacyCityState(string $citySlug, string $stateSlug, string $prefix)
    {
        $city = LocationPage::cities()
                    ->where('city_slug', $citySlug)
                    ->where('state_slug', $stateSlug)
                    ->first();

        if ($city) {
            return Redirect::to("/{$prefix}/{$city->country_slug}/{$city->state_slug}/{$city->city_slug}", 301);
        }

        abort(404);
    }

    private function redirectLegacyCityStateCountry(string $citySlug, string $stateSlug, string $countrySlug, string $prefix)
    {
        $city = LocationPage::cities()
                    ->where('city_slug', $citySlug)
                    ->where('state_slug', $stateSlug)
                    ->where('country_slug', $countrySlug)
                    ->first();

        if ($city) {
            return Redirect::to("/{$prefix}/{$city->country_slug}/{$city->state_slug}/{$city->city_slug}", 301);
        }

        abort(404);
    }

    // ─────────────────────────────────────────────────────────────────────
    // Locations Hub Directory
    // ─────────────────────────────────────────────────────────────────────

    /** GET /school-erp-locations  |  /institute-erp-locations */
    public function locations(Request $request)
    {
        $isSchool = $request->is('school-erp-locations') || $request->is('*school*');
        $prefix   = $isSchool ? 'school-erp' : 'institute-erp';

        $countries = $this->allCountries();
        $states    = $this->allStates();

        // Cities are paginated — 20 per page
        $cities = LocationPage::cities()
                    ->orderBy('country_name')
                    ->orderBy('state_name')
                    ->orderBy('city_name')
                    ->paginate(self::PER_PAGE);

        return view('locations', compact('countries', 'states', 'cities', 'isSchool', 'prefix'));
    }

    // ─────────────────────────────────────────────────────────────────────
    // Sitemap XML
    // ─────────────────────────────────────────────────────────────────────

    /** GET /sitemap.xml */
    public function sitemap()
    {
        $countries = $this->allCountries();
        $states    = $this->allStates();
        $cities    = $this->allCities();
        $xmlHeader = '<?xml version="1.0" encoding="UTF-8"?>';

        return response()
            ->view('sitemap', compact('countries', 'states', 'cities', 'xmlHeader'))
            ->header('Content-Type', 'text/xml')
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
