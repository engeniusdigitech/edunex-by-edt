<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $erpLabel  = $isSchool ? 'School ERP'    : 'Institute ERP';
        $oppLabel  = $isSchool ? 'Institute ERP' : 'School ERP';
        $oppPrefix = $isSchool ? 'institute-erp' : 'school-erp';
        $seoTitle  = "{$erpLabel} Locations Directory — Best School & Institute Software | EduNex ERP";
        $seoDesc   = "Browse the global locations directory for EduNex ERP {$erpLabel}. Find localised school and institute management software solutions for cities, states, and countries worldwide.";
        $seoKw     = "{$prefix} locations, school erp directory, institute erp directory, school management software locations";
    @endphp
    <x-seo
        :title="$seoTitle"
        :description="$seoDesc"
        :keywords="$seoKw"
        :canonical="url()->current()"
    />
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')

    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: hsl(222, 47%, 6%);
            color: hsl(210, 40%, 98%);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        :root {
            --bg: hsl(222, 47%, 6%);
            --card: hsl(222, 47%, 8%);
            --border: hsl(217, 33%, 17%);
            --muted: hsl(215, 20%, 65%);
            --primary: hsl(174, 72%, 56%);
            --secondary: hsl(217, 91%, 60%);
            --gradient: linear-gradient(135deg, hsl(174, 72%, 56%), hsl(217, 91%, 60%));
        }
        .g-text {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .directory-hero {
            padding: 100px 0 60px;
            text-align: center;
            position: relative;
        }
        .directory-hero::before {
            content: '';
            position: absolute;
            top: -200px; left: 50%;
            transform: translateX(-50%);
            width: 800px; height: 500px;
            background: radial-gradient(ellipse, hsla(174, 72%, 56%, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .toggle-btn {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            padding: 6px 12px;
            border-radius: 30px;
            display: inline-flex;
            gap: 5px;
            margin-top: 24px;
        }
        .toggle-item {
            color: var(--muted);
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.25s;
        }
        .toggle-item.active {
            background: var(--gradient);
            color: hsl(222, 47%, 6%);
        }
        .section-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 40px;
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        /* Location link card */
        .loc-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: rgba(255,255,255,0.02);
            color: hsl(210, 40%, 88%);
            font-size: 0.84rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.22s ease;
        }
        .loc-link:hover {
            border-color: hsla(174, 72%, 56%, 0.4);
            background: rgba(255,255,255,0.04);
            color: hsl(174, 72%, 60%);
            transform: translateY(-1px);
        }
        .loc-link i { font-size: 0.7rem; opacity: 0.5; }
        /* City card */
        .city-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px 20px;
            transition: all 0.25s ease;
        }
        .city-card:hover {
            border-color: hsla(174, 72%, 56%, 0.35);
            background: rgba(255,255,255,0.03);
            transform: translateY(-2px);
        }
        .city-name { font-weight: 600; font-size: 0.96rem; margin-bottom: 4px; color: #fff; }
        .city-meta { font-size: 0.72rem; color: var(--muted); margin-bottom: 12px; }
        .city-link {
            display: flex; align-items: center; gap: 6px;
            color: var(--muted); text-decoration: none;
            font-size: 0.78rem; padding: 5px 0;
            transition: color 0.2s;
        }
        .city-link:hover { color: var(--primary); }
        .city-link i { font-size: 0.65rem; }
        /* Pagination */
        .page-link {
            background: var(--card) !important;
            border-color: var(--border) !important;
            color: var(--muted) !important;
            font-size: 0.82rem;
        }
        .page-link:hover, .page-item.active .page-link {
            background: var(--gradient) !important;
            border-color: transparent !important;
            color: hsl(222, 47%, 6%) !important;
        }
    </style>
</head>
<body>
@include('components.frontend-navbar')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" style="background:hsl(222,47%,7%); border-bottom:1px solid hsl(217,33%,13%); padding:10px 0;">
    <div class="container px-4">
        <ol class="breadcrumb mb-0" style="font-size:0.78rem;">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" style="color:hsl(215,20%,55%); text-decoration:none;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:hsl(210,40%,80%); font-weight:600;">
                {{ $erpLabel }} Locations
            </li>
        </ol>
    </div>
</nav>

<div class="directory-hero">
    <div class="container px-4">
        <span class="badge-pill"><i class="fas fa-map-marker-alt"></i> SEO Site Index</span>
        <h1 class="page-h1 mt-3">EduNex ERP <span class="g-text">Locations Directory</span></h1>
        <p class="page-sub">Explore our comprehensive range of school and institute ERP software deployments worldwide.</p>

        <div class="toggle-btn">
            <a href="{{ url('/school-erp-locations') }}" class="toggle-item {{ $isSchool ? 'active' : '' }}">
                <i class="fas fa-graduation-cap"></i> School ERP
            </a>
            <a href="{{ url('/institute-erp-locations') }}" class="toggle-item {{ !$isSchool ? 'active' : '' }}">
                <i class="fas fa-university"></i> Institute ERP
            </a>
        </div>
    </div>
</div>

<div class="container px-4 pb-5">

    {{-- ── Countries ──────────────────────────────────────────────────────── --}}
    <div class="section-card">
        <h2 class="section-title"><i class="fas fa-globe-asia" style="color:var(--secondary);"></i> Global Countries</h2>
        <div class="row g-2">
            @foreach($countries as $loc)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ url($prefix . '/' . $loc->country_slug) }}" class="loc-link">
                    <span>{{ $loc->country_name }}</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ── States (India — grouped, then international) ───────────────────── --}}
    <div class="section-card">
        <h2 class="section-title"><i class="fas fa-map" style="color:var(--primary);"></i> States &amp; Provinces</h2>

        @php
            // Group states by country for clean display
            $statesByCountry = $states->groupBy('country_name');
        @endphp

        @foreach($statesByCountry as $countryName => $stateGroup)
        <div class="mb-4">
            <div style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:var(--muted); margin-bottom:12px; padding-bottom:6px; border-bottom:1px solid hsl(217,33%,13%);">
                {{ $countryName }}
            </div>
            <div class="row g-2">
                @foreach($stateGroup as $loc)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ url($prefix . '/' . $loc->country_slug . '/' . $loc->state_slug) }}" class="loc-link">
                        <span>{{ $loc->state_name }}</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── Cities (paginated — 20 per page) ───────────────────────────────── --}}
    <div class="section-card">
        <h2 class="section-title">
            <i class="fas fa-city" style="color:var(--primary);"></i>
            Cities
            <span style="font-size:0.72rem; font-weight:500; color:var(--muted); margin-left:auto;">
                {{ $cities->total() }} cities &middot; Page {{ $cities->currentPage() }} of {{ $cities->lastPage() }}
            </span>
        </h2>

        <div class="row g-3">
            @foreach($cities as $loc)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="city-card">
                    <div class="city-name">{{ $loc->city_name }}</div>
                    <div class="city-meta">
                        {{ $loc->state_name }}, {{ $loc->country_name }}
                    </div>
                    {{-- School ERP city link --}}
                    <a href="{{ url('school-erp/' . $loc->country_slug . '/' . $loc->state_slug . '/' . $loc->city_slug) }}"
                       class="city-link">
                        <i class="fas fa-graduation-cap"></i> School ERP
                    </a>
                    {{-- Institute ERP city link --}}
                    <a href="{{ url('institute-erp/' . $loc->country_slug . '/' . $loc->state_slug . '/' . $loc->city_slug) }}"
                       class="city-link">
                        <i class="fas fa-university"></i> Institute ERP
                    </a>
                    {{-- State-level link --}}
                    <a href="{{ url($prefix . '/' . $loc->country_slug . '/' . $loc->state_slug) }}"
                       class="city-link" style="margin-top:4px;">
                        <i class="fas fa-map"></i> {{ $loc->state_name }} overview
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination (only shown when total > 20) --}}
        @if($cities->lastPage() > 1)
        <div class="d-flex justify-content-center mt-4">
            {{ $cities->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</div>

<x-frontend-footer/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('components.whatsapp-widget')
</body>
</html>
