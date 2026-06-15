@props([
    'title'       => 'EduNex ERP | #1 School Management Software & Institute ERP',
    'description' => 'EduNex ERP (also known as EduNext ERP) is the best School Management Software & Institute ERP. Automates student attendance, online fee collection, school ERP, payroll, library & more. Trusted by 100+ schools and institutes. Try free.',
    'keywords'    => 'edunex, edunext, edunex erp, edunext erp, edunexerp, EduNex ERP, EduNext ERP, school erp, schoolerp, school software, school management software, school management system, institute software, institute management software, institute erp, coaching class software, coaching center software, training institute software, student management system, school administration software, best school management software, online school management system, school management app, institute management system, coaching institute software',
    'image'       => null,
])

@php $ogImage = $image ?? asset('images/og-image.png'); @endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="author" content="EduNex ERP by Engenius Digitech">
<meta name="application-name" content="EduNex ERP">
<meta name="theme-color" content="#1B75D7">

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
      "alternateName": ["EduNext ERP", "Edunex", "Edunext", "EduNex School ERP", "EduNex Institute ERP"],
      "url": "{{ url('/') }}",
      "logo": {
        "@@type": "ImageObject",
        "url": "{{ asset('images/logo.png') }}",
        "width": 200,
        "height": 60
      },
      "sameAs": [
        "https://www.linkedin.com/company/engenius-digitech/",
        "https://edunexerp.online",
        "https://www.facebook.com/edunexerp",
        "https://twitter.com/edunexerp",
        "https://www.youtube.com/@edunexerp",
        "https://www.instagram.com/edunexerp"
      ],
      "contactPoint": {
        "@@type": "ContactPoint",
        "contactType": "customer support",
        "availableLanguage": ["English", "Hindi"],
        "contactOption": "TollFree"
      },
      "description": "EduNex ERP (also known as EduNext ERP or Edunex) — The best School Management Software, School ERP, and Institute Management System. Built by educators, for educators."
    },
    {
      "@@type": "WebSite",
      "name": "EduNex ERP",
      "alternateName": "EduNext ERP",
      "url": "{{ url('/') }}",
      "description": "EduNex ERP: School Management Software and Institute ERP System",
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
      "alternateName": ["EduNext ERP", "Edunex School Software", "Edunext School Software"],
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
        "priceCurrency": "INR",
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


