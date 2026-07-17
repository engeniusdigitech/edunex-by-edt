{!! $xmlHeader !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ route('sitemap.main') }}</loc>
        <lastmod>{{ $now }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.blog') }}</loc>
        <lastmod>{{ $now }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.country') }}</loc>
        <lastmod>{{ $now }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.state') }}</loc>
        <lastmod>{{ $now }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ route('sitemap.city') }}</loc>
        <lastmod>{{ $now }}</lastmod>
    </sitemap>
</sitemapindex>
