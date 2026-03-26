@props([
    'title'       => 'EduNex - The Ultimate Institute Management SaaS',
    'description' => 'EduNex is the #1 institute management software to automate fees, attendance, live lectures, and student portals. Try EduNex today to scale your institute.',
    'keywords'    => 'edunex, edunex software, edunex institute management, edunex app, institute management software, coaching management software, edunex saas',
    'image'       => null,
])

@php $ogImage = $image ?? asset('images/og-image.png'); @endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:site_name" content="EduNex">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "Organization",
      "name": "EduNex",
      "alternateName": "EduNex Software",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/logo.png') }}",
      "sameAs": [
        "https://www.linkedin.com/company/engenius-digitech/"
      ],
      "description": "The ultimate SaaS platform for modern educational institutes. Built by educators, for educators."
    },
    {
      "@@type": "WebSite",
      "name": "EduNex",
      "url": "{{ url('/') }}",
      "potentialAction": {
        "@@type": "SearchAction",
        "target": {
          "@@type": "EntryPoint",
          "urlTemplate": "{{ url('/') }}?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@@type": "SoftwareApplication",
      "name": "EduNex",
      "operatingSystem": "Web, Android, iOS",
      "applicationCategory": "EducationalApplication",
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      },
      "description": "EduNex is the #1 institute management software to automate fees, attendance, live lectures, and student portals. Go from manual spreadsheets to automated management."
    }
  ]
}
</script>


