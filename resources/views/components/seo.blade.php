@props([
    'title'       => 'EduNex ERP | Best School Management Software, School ERP & Institute Software',
    'description' => 'EduNex ERP is the best School Management Software & Institute ERP. Our School Management System automates student attendance, online fee collection, school ERP, payroll, library & more. Trusted by 100+ schools and institutes.',
    'keywords'    => 'school erp, schoolerp, school software, school management software, school management system, institute software, institute management software, institute erp, coaching class software, coaching center software, training institute software, student management system, school administration software, best school management software, online school management system, school management app, institute management system, coaching institute software, edunex erp, edunex erp',
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
<meta property="og:site_name" content="EduNex ERP">

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
      "name": "EduNex ERP",
      "alternateName": "EduNex ERP Software",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/logo.png') }}",
      "sameAs": [
        "https://www.linkedin.com/company/engenius-digitech/"
      ],
      "description": "EduNex ERP — The best School Management Software, School ERP, and Institute Management System. Built by educators, for educators."
    },
    {
      "@@type": "WebSite",
      "name": "EduNex ERP",
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
      "name": "EduNex ERP",
      "operatingSystem": "Web, Android, iOS",
      "applicationCategory": "EducationalApplication",
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "150"
      },
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "USD",
        "description": "Free 7-day trial available for schools and institutes."
      },
      "applicationSubCategory": "School Management Software, Institute ERP, School ERP, Coaching Center Software",
      "description": "EduNex ERP is the #1 School Management Software and Institute ERP. Our School Management System automates student attendance, online fee collection, school payroll, library management, live lectures, and parent communication. Best school ERP and institute management software for schools and coaching centers worldwide."
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


