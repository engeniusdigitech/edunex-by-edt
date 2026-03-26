@props([
    'title'       => 'Best Education Management Software & School Management System | EduNex',
    'description' => 'EduNex is the #1 education management system and school management software. Automate fees, attendance, and student portals with our premium institute management ERP.',
    'keywords'    => 'education management software, school management system, best institute management software, school software, institute management erp, coaching center software, student management system, edunex',
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
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "150"
      },
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "USD",
        "description": "Free 7-day trial available for schools and institutes."
      },
      "description": "Leading school management software and education management system. EduNex automates student attendance, fee tracking, and provides a premium student portal for modern institutes."
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ url('/') }}"
        },
        {
          "@@type": "ListItem",
          "position": 2,
          "name": "{{ $title }}",
          "item": "{{ url()->current() }}"
        }
      ]
    }
  ]
}
</script>


