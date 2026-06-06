{!! $xmlHeader !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>2026-05-20</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
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
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('features.visitor-gate') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.tally-accounting') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.transit-tracking') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('features.statutory-payroll') }}</loc>
        <lastmod>{{ now()->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
@foreach($locations as $slug => $loc)
    {{-- City-only --}}
    <url>
        <loc>{{ url('/school-erp/' . $slug) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/institute-erp/' . $slug) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>

    {{-- City + State --}}
    @if(isset($loc['state_slug']))
    <url>
        <loc>{{ url('/school-erp/' . $slug . '/' . $loc['state_slug']) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/institute-erp/' . $slug . '/' . $loc['state_slug']) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    @endif

    {{-- City + State + Country --}}
    @if(isset($loc['state_slug']) && isset($loc['country_slug']))
    <url>
        <loc>{{ url('/school-erp/' . $slug . '/' . $loc['state_slug'] . '/' . $loc['country_slug']) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/institute-erp/' . $slug . '/' . $loc['state_slug'] . '/' . $loc['country_slug']) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    @endif
@endforeach

@foreach($states as $slug => $state)
    <url>
        <loc>{{ url('/school-erp/' . $slug) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/institute-erp/' . $slug) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach

@foreach($countries as $slug => $country)
    <url>
        <loc>{{ url('/school-erp/' . $slug) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/institute-erp/' . $slug) }}</loc>
        <lastmod>{{ $lastmod }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
</urlset>
