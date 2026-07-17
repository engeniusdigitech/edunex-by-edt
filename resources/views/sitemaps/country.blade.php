{!! $xmlHeader !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
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
</urlset>
