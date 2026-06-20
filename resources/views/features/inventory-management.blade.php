<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="School Inventory Management Software | EduNex ERP Store Module"
        description="Track stock levels, manage purchase orders, and monitor store usage with the EduNex ERP Inventory Management software for schools & colleges."
        keywords="edunex inventory, edunex erp inventory, school inventory management software, institute stock management, school store ERP, purchase order software school, inventory tracking software, school supplies management, store management ERP, inventory module school software, school stock control software"
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
        "name": "Inventory Management",
        "item": "{{ route('features.inventory-management') }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [{
        "@@type": "Question",
        "name": "What is school inventory management software?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "School inventory management software helps educational institutions track store items, manage suppliers, raise purchase orders, and monitor consumption across departments automatically."
        }
      },{
        "@@type": "Question",
        "name": "Does EduNex ERP support Tally integration for store purchases?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, EduNex ERP features direct integration with Tally, allowing you to export purchase invoices and inventory expenses with one click."
        }
      },{
        "@@type": "Question",
        "name": "How do low-stock thresholds work?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "You can configure minimum stock levels for each item catalog entry. When the stock falls below that threshold, the system auto-sends notifications and places a warning badge on the dashboard."
        }
      },{
        "@@type": "Question",
        "name": "Can we manage multiple departments or sub-stores separately?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, you can create distinct sub-stores (such as Chemistry Lab, Sports Store, IT Department, or Hostel Mess Stock) with independent access controls for staff."
        }
      },{
        "@@type": "Question",
        "name": "Does the inventory system track assets and depreciation?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Absolutely. You can register school assets, record purchase dates and warranties, track shelf locations, and automatically compute annual depreciation values."
        }
      },{
        "@@type": "Question",
        "name": "How is the purchase order approval workflow configured?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Store wardens can create purchase requests. The system routes these requests to administrators or finance heads for digital approval before purchase orders are generated."
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

<section class="container px-4 py-5" style="margin-top: 100px;">
    <div class="row align-items-center g-5 py-5">
        <div class="col-lg-6">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem;">Add-on Module</span>
            <h1 class="fw-bold display-4 mb-3"><span class="g-text">Inventory &amp; Store</span> Management</h1>
            <p class="lead text-muted mb-4">
                Track every item in your institute store. Manage purchase orders, suppliers, stock levels, and item consumption — all from one real-time dashboard.
            </p>
            <div class="hero-feat-pills mb-4">
                <span class="hpill"><i class="fas fa-boxes-stacked"></i> Stock Tracking</span>
                <span class="hpill"><i class="fas fa-file-invoice"></i> Purchase Orders</span>
                <span class="hpill"><i class="fas fa-truck-fast"></i> Supplier Management</span>
                <span class="hpill"><i class="fas fa-chart-line"></i> Consumption Reports</span>
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
                    <span class="text-uppercase fw-bold text-success" style="font-size: 0.65rem; letter-spacing: 1px;">Store Inventory Dashboard</span>
                </div>
                <div class="p-4" style="background: #F8FAFC;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold">Stock Threshold Alerts</h6>
                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size:0.65rem;">3 Purchase Orders Pending</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                            <thead>
                                <tr class="text-muted" style="font-size: 0.75rem; border-bottom: 1px solid var(--border);">
                                    <th class="pb-2">Item Name</th>
                                    <th class="pb-2">Category</th>
                                    <th class="pb-2 text-center">Current Stock</th>
                                    <th class="pb-2 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.82rem;">
                                <tr style="border-bottom: 1px solid #E2E8F0;">
                                    <td class="py-3 fw-semibold">Whiteboard Markers</td>
                                    <td class="py-3 text-muted">Stationery</td>
                                    <td class="py-3 text-center">45 units</td>
                                    <td class="py-3 text-end"><span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1">Low Stock</span></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #E2E8F0;">
                                    <td class="py-3 fw-semibold">A4 Paper Reams</td>
                                    <td class="py-3 text-muted">Stationery</td>
                                    <td class="py-3 text-center">200 units</td>
                                    <td class="py-3 text-end"><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">In Stock</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 fw-semibold">Cleaning Liquid</td>
                                    <td class="py-3 text-muted">Supplies</td>
                                    <td class="py-3 text-center">8 units</td>
                                    <td class="py-3 text-end"><span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">Critical</span></td>
                                </tr>
                            </tbody>
                        </table>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Explore the enterprise-grade subsystems designed to streamline inventory operations and manage school resources efficiently.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(174, 72%, 56%, 0.1); border-radius: 12px; color: var(--primary); font-size: 1.25rem;">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Item Catalog &amp; Categories</h5>
                    <p class="small text-muted mb-3">Organise your entire inventory into categories. Track quantities, units of measure, minimum stock thresholds, and get automatic low-stock alerts before supplies run out.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Threshold Alerts</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Multi-Category</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(217, 91%, 60%, 0.1); border-radius: 12px; color: var(--secondary); font-size: 1.25rem;">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Purchase Order Workflow</h5>
                    <p class="small text-muted mb-3">Raise purchase orders to suppliers with approval workflows. Track delivery status, receive items into stock, and match invoices — complete procurement management.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Approval System</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Supplier Logs</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(262, 83%, 58%, 0.1); border-radius: 12px; color: #a855f7; font-size: 1.25rem;">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Consumption &amp; Usage Reports</h5>
                    <p class="small text-muted mb-3">Know exactly where every rupee of inventory goes. Track which department or batch consumed what — enabling smarter budgeting and waste reduction.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Dept-Wise Audits</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Waste Tracking</span>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">A streamlined process to manage stock, procure new assets, and track consumption across departments.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: #FFFFFF; border-radius: 50%; font-size: 1.1rem;">1</div>
                    <h5 class="fw-bold mb-2">Add Items &amp; Set Thresholds</h5>
                    <p class="small text-muted mb-0">Add your inventory items with minimum stock thresholds. The system automatically alerts staff when items fall below safe levels.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: #FFFFFF; border-radius: 50%; font-size: 1.1rem;">2</div>
                    <h5 class="fw-bold mb-2">Raise Purchase Orders</h5>
                    <p class="small text-muted mb-0">When stocks are low, raise purchase orders to approved suppliers. Track order status from pending to delivered.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: #FFFFFF; border-radius: 50%; font-size: 1.1rem;">3</div>
                    <h5 class="fw-bold mb-2">Receive &amp; Distribute</h5>
                    <p class="small text-muted mb-0">Receive delivered items into stock, distribute to departments, and watch consumption reports update in real-time.</p>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">See how digital stock management simplifies school store operations and ensures full financial control.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(0, 50%, 15%, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 16px;">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Traditional Stockrooms</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Handwritten stock registers that are easy to damage, misplace, or manipulate.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>No real-time visibility into item consumption per class or department.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Manual purchase order tracking in messy spreadsheets leading to double ordering.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>No low-stock alerts — discover shortages only when items are completely depleted.</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(174, 50%, 10%, 0.1); border: 1px solid hsla(174, 72%, 56%, 0.2); border-radius: 16px;">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">EduNex ERP Stock Dashboard</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Centralised digital item catalog with automatic low-stock notifications.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Consumption tracked per batch and department automatically.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Full purchase order lifecycle management integrated with vendor catalog.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Real-time stock dashboard visible to authorised staff with audit history.</span></li>
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
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Procurement &amp; Assets</span>
            <h2 class="fw-bold display-5 mb-3">Key Benefits &amp; Impact</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Optimize school store operations, track asset deprecation, and eliminate leaks or unauthorized resource consumption.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(174, 72%, 56%, 0.1); border-radius: 10px; color: var(--primary); font-size: 1.15rem;">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Multi-Store Segregation</h6>
                    <p class="small text-muted mb-0">Manage separate stock registers for hostels, sports, science labs, and office stationery from a single dashboard.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(217, 91%, 60%, 0.1); border-radius: 10px; color: var(--secondary); font-size: 1.15rem;">
                        <i class="fas fa-triangle-exclamation"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Automated Low-Stock Alerts</h6>
                    <p class="small text-muted mb-0">Get notified the moment item levels fall below defined re-order thresholds, preventing critical supply shortages.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(262, 83%, 58%, 0.1); border-radius: 10px; color: #a855f7; font-size: 1.15rem;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Asset Depreciation Logs</h6>
                    <p class="small text-muted mb-0">Register assets, record purchase values, keep warranty dates, and automatically compute yearly asset write-down rates.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(142, 72%, 29%, 0.1); border-radius: 10px; color: #22c55e; font-size: 1.15rem;">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Purchase Approval Flows</h6>
                    <p class="small text-muted mb-0">Route purchase requisitions digitally through department heads and finance managers before generating purchase orders.</p>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Have questions about Inventory &amp; Store Management? Find clear answers below.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-dark" id="faqAccordion">
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                What is school inventory management software?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                School inventory management software helps educational institutions track store items, manage suppliers, raise purchase orders, and monitor consumption across departments automatically.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does EduNex ERP support Tally integration for store purchases?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, EduNex ERP features direct integration with Tally, allowing you to export purchase invoices and inventory expenses with one click.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How do low-stock thresholds work?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                You can configure minimum stock levels for each item catalog entry. When the stock falls below that threshold, the system auto-sends notifications and places a warning badge on the dashboard.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can we manage multiple departments or sub-stores separately?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, you can create distinct sub-stores (such as Chemistry Lab, Sports Store, IT Department, or Hostel Mess Stock) with independent access controls for staff.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the inventory system track assets and depreciation?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Absolutely. You can register school assets, record purchase dates and warranties, track shelf locations, and automatically compute annual depreciation values.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How is the purchase order approval workflow configured?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Store wardens can create purchase requests. The system routes these requests to administrators or finance heads for digital approval before purchase orders are generated.
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
        <h2 class="fw-bold display-5 mb-3">Take Control of Your Institute Store &amp; Assets</h2>
        <p class="mx-auto text-muted mb-4" style="max-width: 600px;">Get started with EduNex ERP today. Streamline your procurement workflows, eliminate waste, and monitor consumption in real-time.</p>
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
