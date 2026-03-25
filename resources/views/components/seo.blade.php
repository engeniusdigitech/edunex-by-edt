@props([
    'title' => 'EduNex - The Ultimate Institute Management SaaS', 
    'description' => 'EduNex is the #1 institute management software to automate fees, attendance, live lectures, and student portals. Try EduNex today to scale your institute.', 
    'keywords' => 'edunex, edunex software, edunex institute management, edunex app, institute management software, coaching management software, edunex saas'
])

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<!-- Assuming you have an og image or using logo as fallback -->
<meta property="og:image" content="{{ asset('images/logo.png') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $title }}">
<meta property="twitter:description" content="{{ $description }}">
<meta property="twitter:image" content="{{ asset('images/logo.png') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- JSON-LD Structured Data for Brand Search -->
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
