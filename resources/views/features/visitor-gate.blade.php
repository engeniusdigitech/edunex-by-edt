<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="School Visitor Gate Security & Campus Lobby Management Software | EduNex ERP"
        description="Secure your school or institute with EduNex ERP's Visitor Gate Management module. QR-based self-registration, live receptionist approval, printable passes, and complete visitor audit logs for schools and institutes."
        keywords="school visitor management software, campus visitor gate system, visitor gate security software, school lobby management system, institute visitor check-in, school gate security software, visitor pass software for school, campus security ERP, school visitor log software, digital visitor register school"
    />
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [{
        "@@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
      },{
        "@@type": "ListItem",
        "position": 2,
        "name": "Features",
        "item": "{{ url('/') }}#features"
      },{
        "@@type": "ListItem",
        "position": 3,
        "name": "Visitor Gate Security",
        "item": "{{ route('features.visitor-gate') }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [{
        "@@type": "Question",
        "name": "How do visitors register at the school gate contactless?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Visitors scan the QR code posted at the entry gate using their smartphone cameras. This opens a secure registration page where they enter their details, host name, and vehicle number without downloading any app."
        }
      },{
        "@@type": "Question",
        "name": "Can receptionists approve or reject visitor requests?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, receptionists or admins monitor check-ins in real-time from the dashboard lobby console. They can click to approve or reject requests, print physical passes, and notify hosts instantly."
        }
      },{
        "@@type": "Question",
        "name": "Are visitor logs secure and tenant-isolated?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Absolutely. All visitor records, including contact numbers, check-in timestamps, and host departments, are stored securely and fully isolated per tenant (institute), ensuring absolute data privacy."
        }
      },{
        "@@type": "Question",
        "name": "Can we restrict access for specific blacklisted visitors?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, administrators can flag specific contact numbers or individuals as blacklisted. If they attempt to scan and register at the gate, the reception desk is immediately alerted to deny entry."
        }
      },{
        "@@type": "Question",
        "name": "Does the system support OTP verification for phone numbers?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, to prevent fake details, you can enable one-time password (OTP) verification. Visitors must verify their phone number via a quick SMS code before completing their gate registration request."
        }
      },{
        "@@type": "Question",
        "name": "How does the host receive notification of visitor arrival?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Once the receptionist approves a visitor pass, the host teacher or staff member receives an instant email, SMS, or notification on their portal dashboard to alert them that their guest has arrived."
        }
      }]
    }
    </script>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @include('components.frontend-styles')

<style>
:root {
    --bg:         hsl(222, 47%, 6%);
    --card-bg:    hsl(222, 47%, 8%);
    --border:     hsl(217, 33%, 17%);
    --muted:      hsl(215, 20%, 65%);
    --primary:    hsl(174, 72%, 56%);
    --secondary:  hsl(217, 91%, 60%);
    --foreground: hsl(210, 40%, 98%);
    --gradient-primary: linear-gradient(135deg, hsl(174,72%,56%), hsl(217,91%,60%));
}
body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--foreground);
}
.g-text {
    background: var(--gradient-primary);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.hero-feat-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 20px; }
.hpill {
    display: inline-flex; align-items: center; gap: 7px;
    background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09);
    border-radius: 9px; padding: 7px 14px; font-size: 0.76rem; font-weight: 500; color: var(--muted);
}
.hpill i { color: var(--primary); }
.btn-primary-feat {
    background: var(--gradient-primary); color: hsl(222,47%,6%);
    border: none; padding: 14px 30px; border-radius: 10px;
    font-weight: 700; font-size: 0.9rem;
    display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
}
.btn-primary-feat:hover { opacity: 0.9; transform: translateY(-2px); }
.btn-outline-feat {
    background: transparent; color: var(--foreground);
    border: 1px solid var(--border); padding: 14px 30px; border-radius: 10px;
    font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px;
    text-decoration: none; transition: all 0.25s ease;
}
.btn-outline-feat:hover { border-color: var(--primary); background: hsla(174,72%,56%,0.08); }
.mock-card {
    background: var(--card-bg); border: 1px solid var(--border); border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4); overflow: hidden;
}
.mock-header {
    background: hsl(222, 47%, 5%); border-bottom: 1px solid var(--border);
    padding: 14px 20px; display: flex; justify-content: space-between; align-items: center;
}
.mock-dots { display: flex; gap: 6px; }
.mock-dot { width: 10px; height: 10px; border-radius: 50%; }
.mock-dot.red { background: #ff5f56; }
.mock-dot.yellow { background: #ffbd2e; }
.mock-dot.green { background: #27c93f; }
.lead {
    color: #cbd5e1 !important;
}
.text-muted {
    color: #94a3b8 !important;
}
.feat-card {
    background: var(--card-bg);
    border: 1px solid var(--border);
    border-radius: 16px;
    height: 100%;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.feat-card:hover {
    border-color: hsla(174, 72%, 56%, 0.4);
    box-shadow: 0 0 32px hsla(174, 72%, 56%, 0.12);
    transform: translateY(-3px);
}
.accordion-button:not(.collapsed) {
    background: hsla(174,72%,56%,0.08) !important;
    color: var(--primary) !important;
}
.accordion-button::after {
    filter: invert(1);
}
</style>
</head>
<body>

@include('components.frontend-navbar')

<section class="container px-4 py-5" style="margin-top: 100px;">
    <div class="row align-items-center g-5 py-5">
        <div class="col-lg-6">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem;">Platform Module</span>
            <h1 class="fw-bold display-4 mb-3"><span class="g-text">Visitor Gate Security</span> &amp; Lobby Management</h1>
            <p class="lead text-muted mb-4">
                Secure your campus entryways. Allow guests to self-register in seconds via dynamic gate QR posters, wait on animated live approval status pages, and get instant entry passes approved by lobby receptionists.
            </p>
            <div class="hero-feat-pills mb-4">
                <span class="hpill"><i class="fas fa-qrcode"></i> QR Self Check-In</span>
                <span class="hpill"><i class="fas fa-satellite-dish"></i> Live Approval Polling</span>
                <span class="hpill"><i class="fas fa-id-badge"></i> Printable Passes</span>
                <span class="hpill"><i class="fas fa-user-shield"></i> Tenant-Isolated Data</span>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('pricing') }}" class="btn-primary-feat">Start Free Trial <i class="fas fa-rocket"></i></a>
                <a href="{{ route('contact') }}" class="btn-outline-feat">Talk to Sales <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mock-card">
                <div class="mock-header">
                    <div class="mock-dots">
                        <div class="mock-dot red"></div>
                        <div class="mock-dot yellow"></div>
                        <div class="mock-dot green"></div>
                    </div>
                    <span class="text-uppercase fw-bold text-success" style="font-size: 0.65rem; letter-spacing: 1px;">Live Lobby Console</span>
                </div>
                <div class="p-4" style="background: hsl(222, 47%, 7%);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold">Recent Check-In Requests</h6>
                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size:0.65rem;">3 Awaiting Approval</span>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item bg-transparent text-white border-secondary py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">Amit Sharma</div>
                                <div class="small text-muted">Meeting: Class Teacher (Ramesh) · Parent</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 mb-1 d-block" style="font-size:0.6rem;">Awaiting</span>
                                <small class="text-muted">Vehicle: DL-3C-1234</small>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent text-white border-secondary py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">Nisha Goel</div>
                                <div class="small text-muted">Meeting: Principal (Dr. Verma) · Vendor</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 mb-1 d-block" style="font-size:0.6rem;">Checked In</span>
                                <small class="text-muted">Gate 2 · Pass VIS-4392</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Features Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: hsl(222, 47%, 5%);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Deep Dive</span>
            <h2 class="fw-bold display-5 mb-3">Core Modules &amp; Capabilities</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Explore the enterprise-grade subsystems designed to streamline operations and enforce safety compliance across your campus.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(174, 72%, 56%, 0.1); border-radius: 12px; color: var(--primary); font-size: 1.25rem;">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Instant QR Guest Posters</h5>
                    <p class="small text-muted mb-3">Place dynamic QR posters at all entryways. Visitors register on their own devices without needing application downloads, bypassing physical logs completely.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Contactless</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Web App</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(217, 91%, 60%, 0.1); border-radius: 12px; color: var(--secondary); font-size: 1.25rem;">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Lobby Reception Console</h5>
                    <p class="small text-muted mb-3">Monitor incoming check-ins in real-time. Staff members get alerted immediately, and entry is only permitted upon explicit approval from the receptionist or host.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Instant Sync</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Staff Alerts</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(262, 83%, 58%, 0.1); border-radius: 12px; color: #a855f7; font-size: 1.25rem;">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Secure Badge Printing &amp; Passes</h5>
                    <p class="small text-muted mb-3">Automatically generate print-friendly passes featuring unique tracking IDs, visitor photos, and checkout QR codes to manage campus departures securely.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Print Passes</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Checkout Logs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: var(--bg);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Step-by-Step Workflow</span>
            <h2 class="fw-bold display-5 mb-3">How the System Works</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">A simple, three-step journey that ensures complete security registration, screening, and check-out tracking.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">1</div>
                    <h5 class="fw-bold mb-2">Scan &amp; Submit</h5>
                    <p class="small text-muted mb-0">Visitors scan the gate QR code on arrival and fill out their purpose of visit, name, phone, vehicle registration, and who they are here to meet.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">2</div>
                    <h5 class="fw-bold mb-2">Real-Time Review</h5>
                    <p class="small text-muted mb-0">The receptionist reviews pending requests from their dashboard. The visitor waits on a live status screen polling every 3 seconds for instant updates.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">3</div>
                    <h5 class="fw-bold mb-2">Access Granted</h5>
                    <p class="small text-muted mb-0">Once approved, the visitor pass details generate instantly, permitting campus entry. The gate logs the departure timestamp upon checkout.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Before vs After Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: hsl(222, 47%, 5%);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Evolution</span>
            <h2 class="fw-bold display-5 mb-3">Comparing the Experience</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">See how the digital check-in platform improves security, decreases queues, and enhances audit accountability compared to manual logs.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(0, 50%, 15%, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 16px;">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Traditional Logbooks</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Unreadable handwriting makes security audits and contact tracing impossible.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>No verification of phone numbers or guest identity details.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Hosts are unaware that guests have arrived, causing lobby congestion.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Mismatched or missing checkout records create campus security blindspots.</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(174, 50%, 10%, 0.1); border: 1px solid hsla(174, 72%, 56%, 0.2); border-radius: 16px;">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">EduNex ERP QR Lobby</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Clean, digital database of all past and current campus visitors.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Required verification fields and photo capture capabilities for security.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Instant notification sent to the host via dashboard/portal alerts.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Lobby consoles track duration and checkout times with precision.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Operational Benefits & ROI Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: hsl(222, 47%, 7%);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Campus Security</span>
            <h2 class="fw-bold display-5 mb-3">Key Benefits &amp; Impact</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Replace unreadable paper logbooks with automated screening workflows that secure your campus entryways.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(174, 72%, 56%, 0.1); border-radius: 10px; color: var(--primary); font-size: 1.15rem;">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <h6 class="fw-bold mb-2">100% Contactless Check-In</h6>
                    <p class="small text-muted mb-0">Guests scan gate QR posters to self-register in 15 seconds, keeping lines clear and front desks uncrowded.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(217, 91%, 60%, 0.1); border-radius: 10px; color: var(--secondary); font-size: 1.15rem;">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Instant Host Alerts</h6>
                    <p class="small text-muted mb-0">Hosts receive automated dashboard and SMS notifications the second a visitor checks in, streamlining meetings.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(262, 83%, 58%, 0.1); border-radius: 10px; color: #a855f7; font-size: 1.15rem;">
                        <i class="fas fa-print"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Printed Badges &amp; Passes</h6>
                    <p class="small text-muted mb-0">Auto-generate professional visitor badges containing checkout QR codes, visitor photos, and vehicle IDs.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(142, 72%, 29%, 0.1); border-radius: 10px; color: #22c55e; font-size: 1.15rem;">
                        <i class="fas fa-user-lock"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Visitor Blacklists</h6>
                    <p class="small text-muted mb-0">Block unauthorized persons instantly. The system flags restricted phone numbers and alerts guards immediately.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visible FAQ Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: var(--bg);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">FAQ</span>
            <h2 class="fw-bold display-5 mb-3">Frequently Asked Questions</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Have questions about Visitor Gate Security? Find clear answers below.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-dark" id="faqAccordion">
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How do visitors register at the school gate contactless?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Visitors scan the QR code posted at the entry gate using their smartphone cameras. This opens a secure registration page where they enter their details, host name, and vehicle number without downloading any app.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can receptionists approve or reject visitor requests?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, receptionists or admins monitor check-ins in real-time from the dashboard lobby console. They can click to approve or reject requests, print physical passes, and notify hosts instantly.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Are visitor logs secure and tenant-isolated?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Absolutely. All visitor records, including contact numbers, check-in timestamps, and host departments, are stored securely and fully isolated per tenant (institute), ensuring absolute data privacy.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can we restrict access for specific blacklisted visitors?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, administrators can flag specific contact numbers or individuals as blacklisted. If they attempt to scan and register at the gate, the reception desk is immediately alerted to deny entry.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the system support OTP verification for phone numbers?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, to prevent fake details, you can enable one-time password (OTP) verification. Visitors must verify their phone number via a quick SMS code before completing their gate registration request.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How does the host receive notification of visitor arrival?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Once the receptionist approves a visitor pass, the host teacher or staff member receives an instant email, SMS, or notification on their portal dashboard to alert them that their guest has arrived.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA Section -->
<section class="border-top py-5 text-center" style="border-color: var(--border) !important; background: linear-gradient(180deg, hsl(222, 47%, 5%), hsl(222, 47%, 2%));">
    <div class="container py-5">
        <h2 class="fw-bold display-5 mb-3">Ready to Secure Your Campus Entryways?</h2>
        <p class="mx-auto text-muted mb-4" style="max-width: 600px;">Get started with EduNex ERP (also known as EduNext ERP) today. Secure your lobby, speed up visitor check-ins, and keep a clean digital record of who is on your campus.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('pricing') }}" class="btn-primary-feat">Start Free Trial <i class="fas fa-rocket"></i></a>
            <a href="{{ route('contact') }}" class="btn-outline-feat">Schedule Live Demo <i class="fas fa-calendar-days"></i></a>
        </div>
    </div>
</section>

<x-frontend-footer/>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('components.whatsapp-widget')
</body>
</html>
