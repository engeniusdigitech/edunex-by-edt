<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="School Library Management Software | EduNex ERP Digital Library"
        description="Catalogue books with QR barcodes, track issues & returns, manage digital resources, and collect overdue library fines with the EduNex ERP Library module."
        keywords="edunex library, edunex erp library, school library management software, library ERP software, book issue return software, digital library school, library catalogue software, school library system, library fine management, QR barcode library software, institute library software"
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
        "name": "Library Management",
        "item": "{{ route('features.library-management') }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [{
        "@@type": "Question",
        "name": "How does the QR barcode library software work?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "EduNex ERP generates unique barcodes/QR codes for library books. Librarians can scan these codes to instantly issue or return books using any device, speeding up counter operations."
        }
      },{
        "@@type": "Question",
        "name": "Does the school library system support digital books?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, EduNex ERP includes a Digital Resource Library where teachers can upload PDFs, e-books, and video lectures that students can access directly from the student portal."
        }
      },{
        "@@type": "Question",
        "name": "Can students search for books and reserve them from home?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Absolutely. The web OPAC (Online Public Access Catalogue) lets students and teachers search the entire inventory by author, title, or publisher, check real-time availability, and reserve books online."
        }
      },{
        "@@type": "Question",
        "name": "How are overdue notices and fines handled?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "The system calculates overdue fines automatically based on daily rates configured by the admin. Overdue alerts are sent automatically via SMS, and unpaid fines are posted to the student's primary bill."
        }
      },{
        "@@type": "Question",
        "name": "Does the software support cataloguing multi-volume series or journals?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, the catalog supports custom fields, serial tracking, multi-volume books, journals, news subscriptions, and teacher reference materials."
        }
      },{
        "@@type": "Question",
        "name": "Can teachers upload digital assignments and reading lists?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, teachers can link reading lists, worksheets, PDFs, and links directly to classes, so students can view and download them from the student dashboard."
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
    --bg:         #F8FAFC;
    --card-bg:    #FFFFFF;
    --border:     #E2E8F0;
    --muted:      #64748B;
    --primary:    #0D9488;
    --secondary:  hsl(217, 91%, 60%);
    --foreground: #0F172A;
    --gradient-primary: linear-gradient(135deg, #0D9488, hsl(217,91%,60%));
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
    background: #F8FAFC; border: 1px solid #E2E8F0;
    border-radius: 9px; padding: 7px 14px; font-size: 0.76rem; font-weight: 500; color: var(--muted);
}
.hpill i { color: var(--primary); }
.btn-primary-feat {
    background: var(--gradient-primary); color: #FFFFFF;
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
    box-shadow: 0 20px 40px rgba(0,0,0,0.06); overflow: hidden;
}
.mock-header {
    background: #F1F5F9; border-bottom: 1px solid var(--border);
    padding: 14px 20px; display: flex; justify-content: space-between; align-items: center;
}
.mock-dots { display: flex; gap: 6px; }
.mock-dot { width: 10px; height: 10px; border-radius: 50%; }
.mock-dot.red { background: #ff5f56; }
.mock-dot.yellow { background: #ffbd2e; }
.mock-dot.green { background: #27c93f; }
.lead {
    color: #334155 !important;
}
.text-muted {
    color: #64748B !important;
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
    filter: none;
}
</style>
</head>
<body>

@include('components.frontend-navbar')

<section class="container px-4 py-5" style="margin-top: 140px;">
    <div class="row align-items-center g-5 py-5">
        <div class="col-lg-6">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem;">Add-on Module</span>
            <h1 class="fw-bold display-4 mb-3"><span class="g-text">Digital Library</span> Management</h1>
            <p class="lead text-muted mb-4">
                Replace your paper-based library with a fully digital system. Catalogue books with QR barcodes, track issues and returns, manage digital resources, and collect fines — automatically.
            </p>
            <div class="hero-feat-pills mb-4">
                <span class="hpill"><i class="fas fa-book-open"></i> Book Catalogue</span>
                <span class="hpill"><i class="fas fa-qrcode"></i> QR Barcode Scan</span>
                <span class="hpill"><i class="fas fa-clock-rotate-left"></i> Issue &amp; Return</span>
                <span class="hpill"><i class="fas fa-coins"></i> Fine Collection</span>
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
                    <span class="text-uppercase fw-bold text-success" style="font-size: 0.65rem; letter-spacing: 1px;">Library Console</span>
                </div>
                <div class="p-4" style="background: #F8FAFC;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold">Recent Issue Activity</h6>
                        <span class="badge bg-info text-dark px-2 py-1" style="font-size:0.65rem;">4 Books Reserved</span>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item bg-transparent text-white border-secondary py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">Physics Vol. 2</div>
                                <div class="small text-muted">Issued to: Arjun Mehta · Class 10A</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 mb-1 d-block" style="font-size:0.6rem;">Due: 3 days</span>
                                <small class="text-muted">ID: BK-7742</small>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent text-white border-secondary py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">English Grammar</div>
                                <div class="small text-muted">Returned by: SanjaySharma · Class 8B</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 mb-1 d-block" style="font-size:0.6rem;">Fine: ₹0</span>
                                <small class="text-muted">ID: BK-1204</small>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent text-white border-secondary py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold">Chemistry Practicals</div>
                                <div class="small text-muted">Overdue: Rohit Kumar · Class 11C</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 mb-1 d-block" style="font-size:0.6rem;">Fine: ₹20</span>
                                <small class="text-muted">Overdue: 4 days</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Features Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: #F1F5F9;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Deep Dive</span>
            <h2 class="fw-bold display-5 mb-3">Core Modules &amp; Capabilities</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Explore the features designed to streamline physical book catalogs and provide accessible e-learning materials.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(174, 72%, 56%, 0.1); border-radius: 12px; color: var(--primary); font-size: 1.25rem;">
                        <i class="fas fa-book"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Complete Book Catalogue</h5>
                    <p class="small text-muted mb-3">Maintain a rich book catalogue with authors, publishers, categories, ISBNs, and cover images. Generate printable QR codes and barcodes for every book copy for quick scanning during issue and return.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Barcode Generator</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Category Management</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(217, 91%, 60%, 0.1); border-radius: 12px; color: var(--secondary); font-size: 1.25rem;">
                        <i class="fas fa-right-left"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Issue, Return &amp; Fine Management</h5>
                    <p class="small text-muted mb-3">Issue books to students and staff with a due date. The system automatically tracks overdue books, calculates daily fine amounts, and allows librarians to collect fines through the platform.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Auto-Fines</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Overdue Alerts</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(262, 83%, 58%, 0.1); border-radius: 12px; color: #a855f7; font-size: 1.25rem;">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Digital Resource Library</h5>
                    <p class="small text-muted mb-3">Upload PDFs, videos, and e-books to a digital library that students can access from the student portal. Preview resources online or download — no physical book needed.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Portal Uploads</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Mobile Accessible</span>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">From cataloguing books to managing reservations and fine collection digitally.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: #FFFFFF; border-radius: 50%; font-size: 1.1rem;">1</div>
                    <h5 class="fw-bold mb-2">Catalogue Your Collection</h5>
                    <p class="small text-muted mb-0">Add books with full details and generate QR barcodes. Place printed codes on physical books for instant scan-based issue and return.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: #FFFFFF; border-radius: 50%; font-size: 1.1rem;">2</div>
                    <h5 class="fw-bold mb-2">Issue &amp; Track Returns</h5>
                    <p class="small text-muted mb-0">Scan or search a book to issue it to a student. The system tracks due dates and alerts the librarian about overdue books automatically.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: #FFFFFF; border-radius: 50%; font-size: 1.1rem;">3</div>
                    <h5 class="fw-bold mb-2">Collect Fines &amp; Manage Digital</h5>
                    <p class="small text-muted mb-0">Collect overdue fines through the library module. Upload digital resources for students to access anytime from the student portal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Before vs After Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: #F1F5F9;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Evolution</span>
            <h2 class="fw-bold display-5 mb-3">Comparing the Experience</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">See how a digital cataloguing and issue system compares to traditional paper-based libraries.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(0, 50%, 15%, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 16px;">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Traditional Libraries</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Handwritten book registers and issue cards with zero search functionality.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>No overdue alerts — students keep books for months without return.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>No capability to distribute digital books, worksheets, or video lectures.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Manual library fine calculation and loose cash payment tracking.</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(174, 50%, 10%, 0.1); border: 1px solid hsla(174, 72%, 56%, 0.2); border-radius: 16px;">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">EduNex ERP Library Console</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Instantly searchable digital catalog with barcode &amp; QR scan lookup.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Automated overdue emails and SMS alerts sent to students and parents.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Digital resource library with PDF, audio, and video resources in student portal.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Automatic fine computation and integration with student fee accounts.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Operational Benefits & ROI Section -->
<section class="border-top py-5" style="border-color: var(--border) !important; background: #F8FAFC;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Educational Impact</span>
            <h2 class="fw-bold display-5 mb-3">Key Benefits &amp; Impact</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Transform your library from a storage room into an active, digital-friendly knowledge hub.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(174, 72%, 56%, 0.1); border-radius: 10px; color: var(--primary); font-size: 1.15rem;">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <h6 class="fw-bold mb-2">90% Faster Counter Work</h6>
                    <p class="small text-muted mb-0">Scan printed barcodes on book covers to issue or return items in 2 seconds, reducing front desk lines dramatically.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(217, 91%, 60%, 0.1); border-radius: 10px; color: var(--secondary); font-size: 1.15rem;">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Zero Lost Books</h6>
                    <p class="small text-muted mb-0">Automated system tracking, student borrower limits, and daily overdue fine computations keep your books returning on schedule.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(262, 83%, 58%, 0.1); border-radius: 10px; color: #a855f7; font-size: 1.15rem;">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h6 class="fw-bold mb-2">24/7 Portal OPAC</h6>
                    <p class="small text-muted mb-0">Allows students to browse physical shelf locations, search titles, read reviews, and request reserves from home.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(142, 72%, 29%, 0.1); border-radius: 10px; color: #22c55e; font-size: 1.15rem;">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Paperless E-Library</h6>
                    <p class="small text-muted mb-0">Upload revision PDFs, study guides, video lessons, and links directly, creating a centralized academic resources bank.</p>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Have questions about Digital Library Management? Find clear answers below.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-dark" id="faqAccordion">
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How does the QR barcode library software work?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                EduNex ERP generates unique barcodes/QR codes for library books. Librarians can scan these codes to instantly issue or return books using any device, speeding up counter operations.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the school library system support digital books?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, EduNex ERP includes a Digital Resource Library where teachers can upload PDFs, e-books, and video lectures that students can access directly from the student portal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can students search for books and reserve them from home?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Absolutely. The web OPAC (Online Public Access Catalogue) lets students and teachers search the entire inventory by author, title, or publisher, check real-time availability, and reserve books online.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How are overdue notices and fines handled?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                The system calculates overdue fines automatically based on daily rates configured by the admin. Overdue alerts are sent automatically via SMS, and unpaid fines are posted to the student's primary bill.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the software support cataloguing multi-volume series or journals?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, the catalog supports custom fields, serial tracking, multi-volume books, journals, news subscriptions, and teacher reference materials.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can teachers upload digital assignments and reading lists?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, teachers can link reading lists, worksheets, PDFs, and links directly to classes, so students can view and download them from the student dashboard.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bottom CTA Section -->
<section class="border-top py-5 text-center" style="border-color: var(--border) !important; background: #F1F5F9;">
    <div class="container py-5">
        <h2 class="fw-bold display-5 mb-3">Ready to Modernize Your School Library?</h2>
        <p class="mx-auto text-muted mb-4" style="max-width: 600px;">Get started with EduNex ERP today. Go fully paperless, barcode-track physical book collections, and provide access to rich digital learning media.</p>
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
