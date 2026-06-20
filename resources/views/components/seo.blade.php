@props([
    'title'       => 'EduNex ERP | #1 School Management Software & Institute ERP India',
    'description' => 'EduNex ERP — India\'s #1 School Management Software & Institute ERP. Automates student attendance, online fee collection, school payroll, library, live lectures & parent portal. Trusted by 100+ schools. 7-day free trial.',
    'keywords'    => 'edunex, edunex erp, edunexerp, EduNex ERP, school management software, school erp, schoolerp, institute erp, school management system, institute management software, coaching class software, coaching center software, student management system, best school management software india, school administration software, school fee management software, school attendance software, online school management system, cbse school management software, icse school erp, gujarat board school software, state board school erp, school management software vadodara, school erp gujarat, school erp ahmedabad, school erp india, school management app, cloud school erp, saas school management, affordable school erp',
    'image'       => null,
    'canonical'   => null,
    'type'        => 'website',
    'pageType'    => 'WebPage',
])

@php
    $ogImage      = $image ?? asset('images/og-image.png');
    $canonicalUrl = $canonical ?? url()->current();
    $siteName     = 'EduNex ERP';
    $twitterHandle= '@edunexerp';
@endphp

{{-- ── Primary Meta ── --}}
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
<meta name="author" content="EduNex ERP — Engenius Digitech">
<meta name="application-name" content="EduNex ERP">
<meta name="generator" content="EduNex ERP by Engenius Digitech">
<meta name="theme-color" content="#0D9488">
<meta name="rating" content="general">
<meta name="revisit-after" content="3 days">
<meta name="language" content="English">
<meta name="classification" content="Education, School Management Software, ERP">
<meta name="category" content="Education Technology, School ERP, Institute Management">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="target" content="Schools, Coaching Centers, Colleges, Training Institutes">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="subject" content="School Management Software, Institute ERP, Education Technology">
<meta name="abstract" content="{{ $description }}">
<meta name="topic" content="School ERP Software, Institute Management System">
<meta name="summary" content="{{ $description }}">

{{-- ── Geo / Local SEO ── --}}
<meta name="geo.region" content="IN-GJ">
<meta name="geo.placename" content="Vadodara, Gujarat, India">
<meta name="geo.position" content="22.3072;73.1812">
<meta name="ICBM" content="22.3072, 73.1812">
<meta name="DC.title" content="{{ $title }}">
<meta name="DC.description" content="{{ $description }}">
<meta name="DC.subject" content="School Management Software, Institute ERP, Education Technology">
<meta name="DC.language" content="en">
<meta name="DC.coverage" content="India, Worldwide">
<meta name="DC.publisher" content="Engenius Digitech">
<meta name="DC.type" content="Software">
<meta name="DC.format" content="text/html">
<meta name="DC.identifier" content="{{ $canonicalUrl }}">

{{-- ── Apple / PWA ── --}}
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="EduNex ERP">
<meta name="format-detection" content="telephone=no">

{{-- ── Microsoft ── --}}
<meta name="msapplication-TileColor" content="#0D9488">
<meta name="msapplication-TileImage" content="{{ asset('images/logo.png') }}">
<meta name="msapplication-starturl" content="{{ url('/') }}">
<meta name="msapplication-tooltip" content="EduNex ERP — School Management Software">

{{-- ── Open Graph ── --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $siteName }} — School Management Software">
<meta property="og:image:type" content="image/png">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="en_IN">
<meta property="og:locale:alternate" content="en_GB">
<meta property="og:locale:alternate" content="en_US">
<meta property="article:publisher" content="https://www.facebook.com/edunexerp">
<meta property="article:author" content="Engenius Digitech">
<meta property="og:see_also" content="https://www.linkedin.com/company/engenius-digitech/">
<meta property="og:see_also" content="https://www.instagram.com/engenius.digitech">

{{-- ── Twitter / X ── --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ $twitterHandle }}">
<meta name="twitter:creator" content="{{ $twitterHandle }}">
<meta name="twitter:url" content="{{ $canonicalUrl }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">
<meta name="twitter:image:alt" content="{{ $siteName }} — School Management Software">
<meta name="twitter:label1" content="Free Trial">
<meta name="twitter:data1" content="7 Days — No Card Needed">
<meta name="twitter:label2" content="Trusted By">
<meta name="twitter:data2" content="100+ Schools & Institutes">

{{-- ── Canonical + Alternate ── --}}
<link rel="canonical" href="{{ $canonicalUrl }}">
<link rel="alternate" hreflang="en" href="{{ $canonicalUrl }}">
<link rel="alternate" hreflang="en-in" href="{{ $canonicalUrl }}">
<link rel="alternate" hreflang="x-default" href="{{ $canonicalUrl }}">

{{-- ── Resource Hints ── --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="https://www.google-analytics.com">
<link rel="dns-prefetch" href="https://www.googletagmanager.com">

{{-- ── Icons / Manifest ── --}}
<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">

{{-- ── JSON-LD Structured Data ── --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": ["Organization", "LocalBusiness"],
      "@@id": "{{ url('/') }}/#organization",
      "name": "EduNex ERP",
      "legalName": "Engenius Digitech",
      "alternateName": ["Edunex", "EduNex School Software", "EduNex Institute ERP", "edunexerp", "EduNex School ERP"],
      "url": "{{ url('/') }}",
      "logo": {
        "@@type": "ImageObject",
        "@@id": "{{ url('/') }}/#logo",
        "url": "{{ asset('images/logo.png') }}",
        "contentUrl": "{{ asset('images/logo.png') }}",
        "width": 200,
        "height": 60,
        "caption": "EduNex ERP Logo"
      },
      "image": { "@@id": "{{ url('/') }}/#logo" },
      "description": "EduNex ERP is India's leading School Management Software and Institute ERP. Built by Engenius Digitech. Automates attendance, fees, payroll, academics, library, and parent communication.",
      "foundingDate": "2020",
      "numberOfEmployees": { "@@type": "QuantitativeValue", "value": 20 },
      "priceRange": "₹₹",
      "currenciesAccepted": "INR, USD",
      "paymentAccepted": "Online Payment, UPI, Net Banking, Credit Card, Debit Card",
      "openingHoursSpecification": [
        {
          "@@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
          "opens": "09:00",
          "closes": "19:00"
        }
      ],
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Vadodara",
        "addressLocality": "Vadodara",
        "addressRegion": "Gujarat",
        "postalCode": "390001",
        "addressCountry": "IN"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 22.3072,
        "longitude": 73.1812
      },
      "areaServed": [
        { "@@type": "Country", "name": "India" },
        { "@@type": "Country", "name": "United States" },
        { "@@type": "Country", "name": "United Arab Emirates" },
        { "@@type": "Country", "name": "United Kingdom" },
        { "@@type": "Country", "name": "Canada" },
        { "@@type": "Country", "name": "Australia" },
        { "@@type": "State", "name": "Gujarat" },
        { "@@type": "State", "name": "Maharashtra" },
        { "@@type": "State", "name": "Rajasthan" },
        { "@@type": "State", "name": "Delhi" }
      ],
      "contactPoint": [
        {
          "@@type": "ContactPoint",
          "contactType": "customer support",
          "availableLanguage": ["English", "Hindi", "Gujarati"],
          "contactOption": "TollFree",
          "areaServed": ["IN", "US", "GB", "AU", "CA", "AE"],
          "hoursAvailable": {
            "@@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
            "opens": "09:00",
            "closes": "19:00"
          }
        },
        {
          "@@type": "ContactPoint",
          "contactType": "sales",
          "availableLanguage": ["English", "Hindi", "Gujarati"],
          "areaServed": "IN"
        },
        {
          "@@type": "ContactPoint",
          "contactType": "technical support",
          "availableLanguage": ["English", "Hindi"],
          "areaServed": ["IN"]
        }
      ],
      "sameAs": [
        "https://www.linkedin.com/company/engenius-digitech/",
        "https://www.facebook.com/edunexerp",
        "https://www.instagram.com/edunexerp",
        "https://twitter.com/edunexerp",
        "https://www.youtube.com/@edunexerp",
        "https://edunexerp.online"
      ],
      "knowsAbout": [
        "School Management Software",
        "Institute ERP",
        "EdTech",
        "School ERP",
        "Attendance Automation",
        "AI Face Biometric Attendance",
        "Online Fee Collection",
        "School Payroll",
        "Library Management",
        "Coaching Center Software",
        "Student Information System",
        "Academic Management",
        "School Analytics",
        "WhatsApp Integration for Schools",
        "Student Parent Portal",
        "CBSE School Software",
        "Gujarat Board School ERP"
      ],
      "hasOfferCatalog": {
        "@@type": "OfferCatalog",
        "name": "EduNex ERP Plans",
        "itemListElement": [
          {
            "@@type": "Offer",
            "name": "Free Trial",
            "description": "Full-access 7-day free trial — no credit card required",
            "price": "0",
            "priceCurrency": "INR",
            "url": "{{ url('/pricing') }}"
          },
          {
            "@@type": "Offer",
            "name": "School ERP Plan",
            "description": "Complete School Management Software with all modules",
            "priceCurrency": "INR",
            "url": "{{ url('/pricing') }}"
          }
        ]
      }
    },
    {
      "@@type": "WebSite",
      "@@id": "{{ url('/') }}/#website",
      "url": "{{ url('/') }}",
      "name": "EduNex ERP",
      "alternateName": ["Edunex ERP", "EduNex School Management"],
      "description": "India's #1 School Management Software & Institute ERP",
      "publisher": { "@@id": "{{ url('/') }}/#organization" },
      "inLanguage": ["en", "en-IN"],
      "potentialAction": [
        {
          "@@type": "SearchAction",
          "target": {
            "@@type": "EntryPoint",
            "urlTemplate": "{{ url('/') }}?q={search_term_string}"
          },
          "query-input": "required name=search_term_string"
        },
        {
          "@@type": "RegisterAction",
          "target": "{{ url('/pricing') }}",
          "name": "Start Free Trial"
        }
      ]
    },
    {
      "@@type": "{{ $pageType }}",
      "@@id": "{{ $canonicalUrl }}/#webpage",
      "url": "{{ $canonicalUrl }}",
      "name": "{{ $title }}",
      "description": "{{ $description }}",
      "isPartOf": { "@@id": "{{ url('/') }}/#website" },
      "about": { "@@id": "{{ url('/') }}/#organization" },
      "inLanguage": "en-IN",
      "datePublished": "2020-01-01",
      "dateModified": "{{ now()->toDateString() }}",
      "speakable": {
        "@@type": "SpeakableSpecification",
        "cssSelector": ["h1", "h2", ".sec-title", ".hero-sub", ".sec-desc"]
      },
      "primaryImageOfPage": { "@@id": "{{ url('/') }}/#logo" },
      "breadcrumb": {
        "@@type": "BreadcrumbList",
        "itemListElement": [
          { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
          { "@@type": "ListItem", "position": 2, "name": "{{ $title }}", "item": "{{ $canonicalUrl }}" }
        ]
      }
    },
    {
      "@@type": "SoftwareApplication",
      "@@id": "{{ url('/') }}/#software",
      "name": "EduNex ERP",
      "alternateName": ["Edunex", "EduNex School Software", "EduNex Institute Software", "edunexerp", "EduNex School Management Software"],
      "applicationCategory": "EducationalApplication",
      "applicationSubCategory": "School Management Software, Institute ERP, School ERP, Coaching Center Software, Student Management System",
      "operatingSystem": "Web Browser, Android 5.0+, iOS 12+",
      "url": "{{ url('/') }}",
      "screenshot": "{{ asset('images/og-image.png') }}",
      "softwareVersion": "3.0",
      "datePublished": "2020-01-01",
      "dateModified": "{{ now()->toIso8601String() }}",
      "inLanguage": ["en", "hi", "gu"],
      "isAccessibleForFree": false,
      "countriesSupported": "IN, US, GB, AU, CA, AE, NG, ZA, PK, BD",
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "INR",
        "description": "Free 7-day trial — no credit card required",
        "availability": "https://schema.org/InStock",
        "url": "{{ url('/pricing') }}",
        "seller": { "@@id": "{{ url('/') }}/#organization" }
      },
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "150",
        "bestRating": "5",
        "worstRating": "1"
      },
      "review": [
        {
          "@@type": "Review",
          "author": { "@@type": "Person", "name": "Rajesh Patel" },
          "datePublished": "2025-11-10",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "reviewBody": "EduNex ERP completely transformed how we manage our institute. Fee collection, attendance, and academics are now fully automated. Best school management software in Gujarat."
        },
        {
          "@@type": "Review",
          "author": { "@@type": "Person", "name": "SanjaySharma" },
          "datePublished": "2025-10-22",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "reviewBody": "The best school ERP software we have used. Setup was done in minutes and the team support is excellent. Highly recommended for CBSE schools."
        },
        {
          "@@type": "Review",
          "author": { "@@type": "Person", "name": "Mohammed Raza" },
          "datePublished": "2025-09-15",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "reviewBody": "We manage a coaching institute with 500+ students. EduNex ERP handles our fee collection, WhatsApp notifications, and online tests seamlessly. 10/10."
        },
        {
          "@@type": "Review",
          "author": { "@@type": "Person", "name": "Sunita Gupta" },
          "datePublished": "2025-08-05",
          "reviewRating": { "@@type": "Rating", "ratingValue": "5", "bestRating": "5" },
          "reviewBody": "AI biometric attendance is a game changer. No more proxy, no more manual register. EduNex ERP paid for itself in the first month."
        },
        {
          "@@type": "Review",
          "author": { "@@type": "Person", "name": "Arjun Nair" },
          "datePublished": "2025-07-19",
          "reviewRating": { "@@type": "Rating", "ratingValue": "4", "bestRating": "5" },
          "reviewBody": "Very powerful institute management software. Online fee collection with Razorpay works flawlessly. Parents love the mobile app notifications."
        }
      ],
      "featureList": [
        "AI Face Biometric Attendance for Staff & Students",
        "Online Fee Collection with Razorpay & Stripe Payment Gateway",
        "School Payroll & HR Management with Payslip Generation",
        "Library Management with QR Barcode Tracking",
        "Live & Recorded Video Lectures",
        "Student & Parent Mobile App (PWA — Android & iOS)",
        "WhatsApp Notification Integration",
        "Timetable & Academic Schedule Management",
        "Visitor & Gate Management System",
        "School Bus & Transport Tracking",
        "Hostel & Mess Management",
        "Online Examination & Question Bank",
        "Analytics & Reports Dashboard",
        "Multi-Branch Institute Support",
        "Admission & Enquiry Management",
        "Homework & Study Material Distribution",
        "Discipline & Conduct Management",
        "School Inventory & Store Management",
        "Tally Accounting Integration",
        "CBSE, ICSE, Gujarat Board Compatible"
      ],
      "publisher": { "@@id": "{{ url('/') }}/#organization" }
    }
  ]
}
</script>

