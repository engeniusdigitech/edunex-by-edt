<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the location_pages table that powers the SEO hierarchical
     * location system (country → state → city) for school-erp and institute-erp.
     */
    public function up(): void
    {
        Schema::create('location_pages', function (Blueprint $table) {
            $table->id();

            // Country fields
            $table->string('country_name', 120);
            $table->string('country_code', 10);     // ISO 3166-1 alpha-2, e.g. "IN"
            $table->string('country_slug', 100);     // URL segment, e.g. "india"

            // State / Province fields (nullable for country-only records)
            $table->string('state_name', 120)->nullable();
            $table->string('state_code', 20)->nullable();   // e.g. "GJ"
            $table->string('state_slug', 100)->nullable();  // URL segment, e.g. "gujarat"

            // City fields (nullable for country/state-only records)
            $table->string('city_name', 120)->nullable();
            $table->string('city_slug', 100)->nullable();   // URL segment, e.g. "ahmedabad"

            // Type distinguishes hierarchical level
            // Values: 'country' | 'state' | 'city'
            $table->string('type', 20)->default('city');

            // Actual last-modified date for sitemap <lastmod> entries
            $table->date('last_modified');

            $table->timestamps();

            // Prevent duplicate records for the same location + type combination
            $table->unique(
                ['country_slug', 'state_slug', 'city_slug', 'type'],
                'loc_unique'
            );

            // Indexes for fast lookups by slug segments
            $table->index('country_slug');
            $table->index(['country_slug', 'state_slug']);
            $table->index(['country_slug', 'state_slug', 'city_slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_pages');
    }
};
