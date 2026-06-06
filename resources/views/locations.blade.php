<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $isSchool = request()->is('school-erp-locations') || request()->is('*school*');
        $erpLabel = $isSchool ? 'School ERP' : 'Institute ERP';
        $prefix = $isSchool ? 'school-erp' : 'institute-erp';
        $oppPrefix = $isSchool ? 'institute-erp' : 'school-erp';
        $oppLabel = $isSchool ? 'Institute ERP' : 'School ERP';
        $oppUrl = $isSchool ? url('/institute-erp-locations') : url('/school-erp-locations');
        $seoTitle = "{$erpLabel} Locations Directory — Best School & Institute Software | EduNex";
        $seoDesc = "Browse the locations directory for EduNex {$erpLabel}. Find localized school and institute management software solutions for cities, states, and countries across India and globally.";
        $seoKeywords = "{$prefix} locations, school erp directory, institute erp directory, school management software locations, school software index";
    @endphp
    <x-seo
        :title="$seoTitle"
        :description="$seoDesc"
        :keywords="$seoKeywords"
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
            padding: 140px 0 60px;
            text-align: center;
            position: relative;
        }
        .directory-hero::before {
            content: '';
            position: absolute;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 500px;
            background: radial-gradient(ellipse, hsla(174, 72%, 56%, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .toggle-btn {
            background: rgba(255, 255, 255, 0.04);
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
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .loc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }
        .loc-item {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: all 0.25s ease;
        }
        .loc-item:hover {
            border-color: hsla(174, 72%, 56%, 0.35);
            background: rgba(255,255,255,0.03);
            transform: translateY(-2px);
        }
        .loc-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 8px;
            color: #fff;
        }
        .loc-badge {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 12px;
            background: hsla(217, 91%, 60%, 0.15);
            color: hsl(217, 91%, 75%);
        }
        .loc-badge.state-badge {
            background: hsla(174, 72%, 56%, 0.15);
            color: hsl(174, 72%, 70%);
        }
        .link-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .link-list a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.82rem;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .link-list a:hover {
            color: var(--primary);
        }
        .link-list a i {
            font-size: 0.7rem;
            opacity: 0.6;
        }
    </style>
</head>
<body>
@include('components.frontend-navbar')

<div class="directory-hero">
    <div class="container px-4">
        <span class="badge-pill"><i class="fas fa-map-marker-alt"></i> SEO Site Index</span>
        <h1 class="page-h1 mt-3">EduNex ERP <span class="g-text">Locations Directory</span></h1>
        <p class="page-sub">Explore our comprehensive range of school and institute ERP software deployments across India and worldwide.</p>
        
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
    
    <!-- Indian States -->
    <div class="section-card">
        <h2 class="section-title"><i class="fas fa-map text-primary"></i> Indian States & Union Territories</h2>
        <div class="row g-3">
            @foreach($states as $slug => $state)
                <div class="col-6 col-sm-4 col-md-3">
                    <a href="{{ url('/' . $prefix . '/state/' . $slug) }}" class="d-flex align-items-center justify-content-between p-3 rounded border text-decoration-none transition-all" style="background: rgba(255,255,255,0.02); border-color: var(--border); color: #fff; font-size: 0.88rem;" onmouseover="this.style.borderColor='hsla(174, 72%, 56%, 0.4)'; this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.borderColor='var(--border)'; this.style.background='rgba(255,255,255,0.02)'">
                        <span>{{ $state['name'] }}</span>
                        <i class="fas fa-arrow-right text-muted" style="font-size: 0.75rem;"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Countries -->
    <div class="section-card">
        <h2 class="section-title"><i class="fas fa-globe-asia text-primary"></i> Global Countries Index</h2>
        <div class="row g-3">
            @foreach($countries as $slug => $country)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ url('/' . $prefix . '/country/' . $slug) }}" class="d-flex align-items-center justify-content-between p-3 rounded border text-decoration-none transition-all" style="background: rgba(255,255,255,0.02); border-color: var(--border); color: #fff; font-size: 0.88rem;" onmouseover="this.style.borderColor='hsla(174, 72%, 56%, 0.4)'; this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.borderColor='var(--border)'; this.style.background='rgba(255,255,255,0.02)'">
                        <span>{{ $country['name'] }}</span>
                        <i class="fas fa-arrow-right text-muted" style="font-size: 0.75rem;"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Cities Grid -->
    <div class="section-card">
        <h2 class="section-title"><i class="fas fa-city text-primary"></i> Cities Index</h2>
        <div class="loc-grid">
            @foreach($locations as $slug => $loc)
                <div class="loc-item">
                    <div class="loc-name">{{ $loc['city'] }}</div>
                    @if(isset($loc['state']))
                        <span class="loc-badge state-badge">{{ $loc['state'] }}</span>
                    @else
                        <span class="loc-badge">{{ $loc['country'] }}</span>
                    @endif
                    
                    <div class="link-list">
                        <a href="{{ url('/' . $prefix . '/' . $slug) }}">
                            <i class="fas fa-link"></i> City ERP Home
                        </a>
                        @if(isset($loc['state_slug']))
                            <a href="{{ url('/' . $prefix . '/' . $slug . '/' . $loc['state_slug']) }}">
                                <i class="fas fa-map-marker-alt"></i> State View
                            </a>
                        @endif
                        @if(isset($loc['state_slug']) && isset($loc['country_slug']))
                            <a href="{{ url('/' . $prefix . '/' . $slug . '/' . $loc['state_slug'] . '/' . $loc['country_slug']) }}">
                                <i class="fas fa-globe"></i> Full Location View
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

<x-frontend-footer/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('components.whatsapp-widget')
</body>
</html>
