{!! $xmlHeader !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- ── Static Pages ──────────────────────────────────────────────────── --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>2026-05-20</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/edunex') }}</loc>
        <lastmod>2026-05-20</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/edunex-erp') }}</loc>
        <lastmod>2026-05-20</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('about') }}</loc>
        <lastmod>2026-04-10</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('pricing') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>2026-04-10</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('blogs') }}</loc>
        <lastmod>2026-05-27</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('trial.request') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('legal.privacy') }}</loc>
        <lastmod>2026-03-15</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ route('legal.terms') }}</loc>
        <lastmod>2026-03-15</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ route('legal.refund') }}</loc>
        <lastmod>2026-03-15</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.4</priority>
    </url>
    <url>
        <loc>{{ route('digital.assessment') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('features.visitor-gate') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.tally-accounting') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.transit-tracking') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.statutory-payroll') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.inventory-management') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.hostel-management') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.library-management') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.accounting-tally') }}</loc>
        <lastmod>2026-05-01</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('seo.locations.school') }}</loc>
        <lastmod>2026-06-17</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('seo.locations.institute') }}</loc>
        <lastmod>2026-06-17</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- ── Country Pages (canonical: /{prefix}/{country}) ─────────────────── --}}
    @foreach($countries as $loc)
    {{-- School ERP --}}
    <url>
        <loc>{{ url('school-erp/' . $loc->country_slug) }}</loc>
        <lastmod>{{ $loc->lastmodString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.85</priority>
    </url>
    {{-- Institute ERP --}}
    <url>
        <loc>{{ url('institute-erp/' . $loc->country_slug) }}</loc>
        <lastmod>{{ $loc->lastmodString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.85</priority>
    </url>
    @endforeach

    {{-- ── State Pages (canonical: /{prefix}/{country}/{state}) ──────────── --}}
    @foreach($states as $loc)
    {{-- School ERP --}}
    <url>
        <loc>{{ url('school-erp/' . $loc->country_slug . '/' . $loc->state_slug) }}</loc>
        <lastmod>{{ $loc->lastmodString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    {{-- Institute ERP --}}
    <url>
        <loc>{{ url('institute-erp/' . $loc->country_slug . '/' . $loc->state_slug) }}</loc>
        <lastmod>{{ $loc->lastmodString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    @endforeach

    {{-- ── City Pages (canonical: /{prefix}/{country}/{state}/{city}) ──────── --}}
    @foreach($cities as $loc)
    {{-- School ERP --}}
    <url>
        <loc>{{ url('school-erp/' . $loc->country_slug . '/' . $loc->state_slug . '/' . $loc->city_slug) }}</loc>
        <lastmod>{{ $loc->lastmodString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    {{-- Institute ERP --}}
    <url>
        <loc>{{ url('institute-erp/' . $loc->country_slug . '/' . $loc->state_slug . '/' . $loc->city_slug) }}</loc>
        <lastmod>{{ $loc->lastmodString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

</urlset>
