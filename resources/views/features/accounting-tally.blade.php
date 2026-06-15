<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="School Accounting Software | EduNex (EduNext) ERP Tally Integration"
        description="Track expenses, manage double-entry ledgers, generate GST compliance reports, and export to Tally XML with the EduNex ERP (also known as EduNext ERP) Accounting module."
        keywords="edunex accounting, edunext accounting, school accounting software, institute financial management, school expense tracking, tally integration school ERP, GST reporting school, ledger management software, school finance ERP, accounting module school, institute accounting software, school tally sync, edunext erp accounting"
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
        "name": "Accounting & Tally",
        "item": "{{ route('features.accounting-tally') }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [{
        "@@type": "Question",
        "name": "How does Tally integration work in EduNex ERP?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "EduNex ERP allows schools to export all fee collections, voucher entries, and department expenses into Tally-compatible XML format with one click, eliminating manual data entry for accounts teams."
        }
      },{
        "@@type": "Question",
        "name": "Can we generate GST-ready reports?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, the accounting module automatically calculates GST input/output tax liability and generates ready-to-file reports for school audits and chartered accountants."
        }
      },{
        "@@type": "Question",
        "name": "Does the system support double-entry accounting rules?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, the software enforces standard double-entry bookkeeping rules. Every transaction posts corresponding debit and credit entries to respective ledgers, ensuring strict accounting standards."
        }
      },{
        "@@type": "Question",
        "name": "Can we manage multiple bank accounts and cash boxes?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes. You can set up and reconcile multiple bank accounts, track petty cash boxes, and record bank transfers directly through the accounts module."
        }
      },{
        "@@type": "Question",
        "name": "How are department budgets and expense approvals managed?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Administrators can define annual budgets for departments (e.g., science lab, library, sports). Expense vouchers go through a multi-level approval process before being paid out."
        }
      },{
        "@@type": "Question",
        "name": "Can chartered accountants access financial records directly?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, you can create a dedicated accountant role with read-only permissions, allowing your auditor to inspect general ledgers, trial balances, and tax audits directly online."
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
.finance-stats {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 12px;
}
.f-stat-card {
    background: hsla(210,40%,98%,0.03);
    border: 1px solid hsla(210,40%,98%,0.06);
    border-radius: 10px;
    padding: 12px;
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
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem;">Add-on Module</span>
            <h1 class="fw-bold display-4 mb-3"><span class="g-text">Accounting &amp; Tally</span> Integration</h1>
            <p class="lead text-muted mb-4">
                Bring full financial transparency to your institute. Track every expense, manage ledgers, generate GST reports, and export to Tally with one click — no manual re-entry.
            </p>
            <div class="hero-feat-pills mb-4">
                <span class="hpill"><i class="fas fa-book-journal-whills"></i> Ledger Management</span>
                <span class="hpill"><i class="fas fa-receipt"></i> Expense Tracking</span>
                <span class="hpill"><i class="fas fa-file-invoice"></i> GST Reports</span>
                <span class="hpill"><i class="fas fa-arrows-rotate"></i> Tally XML Export</span>
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
                    <span class="text-uppercase fw-bold text-success" style="font-size: 0.65rem; letter-spacing: 1px;">Financial Dashboard</span>
                </div>
                <div class="p-4" style="background: hsl(222, 47%, 7%);">
                    
                    <!-- Stat Row -->
                    <div class="finance-stats mb-4">
                        <div class="f-stat-card">
                            <div class="small text-muted mb-1">Total Income</div>
                            <div class="fw-bold text-success" style="font-size: 1.05rem;">₹4,85,200</div>
                        </div>
                        <div class="f-stat-card">
                            <div class="small text-muted mb-1">Total Expenses</div>
                            <div class="fw-bold text-danger" style="font-size: 1.05rem;">₹1,23,400</div>
                        </div>
                        <div class="f-stat-card">
                            <div class="small text-muted mb-1">Net Balance</div>
                            <div class="fw-bold text-info" style="font-size: 1.05rem;">₹3,61,800</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold" style="font-size:0.85rem;">Recent Expenses</h6>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size:0.65rem;"><i class="fas fa-check me-1"></i> Tally Sync Ready</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent;">
                            <thead>
                                <tr class="text-muted" style="font-size: 0.75rem; border-bottom: 1px solid var(--border);">
                                    <th class="pb-2">Description</th>
                                    <th class="pb-2">Category</th>
                                    <th class="pb-2 text-center">Amount</th>
                                    <th class="pb-2 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.8rem;">
                                <tr style="border-bottom: 1px solid hsla(217,33%,17%,0.4);">
                                    <td class="py-2 fw-semibold">Electricity Bill</td>
                                    <td class="py-2 text-muted">Utilities</td>
                                    <td class="py-2 text-center">₹12,500</td>
                                    <td class="py-2 text-end"><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0.5">Paid</span></td>
                                </tr>
                                <tr style="border-bottom: 1px solid hsla(217,33%,17%,0.4);">
                                    <td class="py-2 fw-semibold">Lab Supplies</td>
                                    <td class="py-2 text-muted">Academic</td>
                                    <td class="py-2 text-center">₹8,200</td>
                                    <td class="py-2 text-end"><span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-0.5">Pending</span></td>
                                </tr>
                                <tr>
                                    <td class="py-2 fw-semibold">Staff Canteen</td>
                                    <td class="py-2 text-muted">Admin</td>
                                    <td class="py-2 text-center">₹3,100</td>
                                    <td class="py-2 text-end"><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0.5">Paid</span></td>
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
<section class="border-top py-5" style="border-color: var(--border) !important; background: hsl(222, 47%, 5%);">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Deep Dive</span>
            <h2 class="fw-bold display-5 mb-3">Core Modules &amp; Capabilities</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Explore the full financial suite designed to simplify school ledgers, expenses, tax compliance, and accountant handoff.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(174, 72%, 56%, 0.1); border-radius: 12px; color: var(--primary); font-size: 1.25rem;">
                        <i class="fas fa-book-journal-whills"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Ledger &amp; Double-Entry Accounting</h5>
                    <p class="small text-muted mb-3">Maintain proper accounting ledgers with debit/credit entries. Categorise income and expenses across departments, generate trial balances, and always know your financial position.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Double Entry</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Trial Balance</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(217, 91%, 60%, 0.1); border-radius: 12px; color: var(--secondary); font-size: 1.25rem;">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h5 class="fw-bold mb-2">GST Reports &amp; Compliance</h5>
                    <p class="small text-muted mb-3">Generate GST-ready financial reports with input and output tax breakdowns. Stay compliant with Indian GST regulations without hiring a dedicated accountant for data entry.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> GST Invoicing</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Tax Breakdowns</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(262, 83%, 58%, 0.1); border-radius: 12px; color: #a855f7; font-size: 1.25rem;">
                        <i class="fas fa-arrows-rotate"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Tally XML Export</h5>
                    <p class="small text-muted mb-3">Export all your accounting entries as Tally-compatible XML files with one click. Your CA or accounts team can import directly into Tally without any manual re-keying.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> One-Click XML</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> CA Integration</span>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">How transaction details are seamlessly captured, aggregated, and synced with standard accounting tools.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">1</div>
                    <h5 class="fw-bold mb-2">Record Income &amp; Expenses</h5>
                    <p class="small text-muted mb-0">Fee collections automatically flow into accounting as income. Manually record expenses across categories — salaries, utilities, supplies, and maintenance.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">2</div>
                    <h5 class="fw-bold mb-2">Generate Financial Reports</h5>
                    <p class="small text-muted mb-0">View profit &amp; loss, balance sheets, GST liability reports, and department-wise expense breakdowns from the dashboard at any time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">3</div>
                    <h5 class="fw-bold mb-2">Export to Tally Instantly</h5>
                    <p class="small text-muted mb-0">When your accountant needs the data, export a Tally XML file with one click. Import it into Tally — done. Zero manual re-entry.</p>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Compare double-entry digital school ERP accounting against manual accounts and double entry spreadsheets.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(0, 50%, 15%, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: 16px;">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Traditional Accounts</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Fee income and expense data tracked in separate Excel files with no synchronization.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>GST calculations done manually by accountant at the end of the tax quarter.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Tally entries typed manually from physical bills and receipts — slow and error-prone.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>No real-time financial dashboard or department budgets for school management.</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(174, 50%, 10%, 0.1); border: 1px solid hsla(174, 72%, 56%, 0.2); border-radius: 16px;">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">EduNex ERP Accounting Console</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>All fee income automatically posted to respective accounting ledgers in real-time.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>GST compliance reports auto-generated from transaction database instantly.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>One-click Tally XML export for error-free importing in seconds.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Live financial status dashboards showing profit and loss graphs to owners.</span></li>
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
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">Financial Control</span>
            <h2 class="fw-bold display-5 mb-3">Key Benefits &amp; Impact</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Streamline school accounting, enforce strict internal controls, and save hundreds of hours of manual bookkeeping.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(174, 72%, 56%, 0.1); border-radius: 10px; color: var(--primary); font-size: 1.15rem;">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Automated Fee Ledger Sync</h6>
                    <p class="small text-muted mb-0">No manual entry needed for receipts. All online gate check-ins and counter cash payments post to ledgers instantly.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(217, 91%, 60%, 0.1); border-radius: 10px; color: var(--secondary); font-size: 1.15rem;">
                        <i class="fas fa-arrows-spin"></i>
                    </div>
                    <h6 class="fw-bold mb-2">One-Click Tally Export</h6>
                    <p class="small text-muted mb-0">Download day-books or monthly collections as Tally Prime XML files and import them directly with zero errors.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(262, 83%, 58%, 0.1); border-radius: 10px; color: #a855f7; font-size: 1.15rem;">
                        <i class="fas fa-percent"></i>
                    </div>
                    <h6 class="fw-bold mb-2">GST Statutory Tax Splits</h6>
                    <p class="small text-muted mb-0">Automatically calculate input-tax credits, split CGST/SGST/IGST dynamically on bills, and export tax summaries.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(142, 72%, 29%, 0.1); border-radius: 10px; color: #22c55e; font-size: 1.15rem;">
                        <i class="fas fa-magnifying-glass-chart"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Direct CA Audits</h6>
                    <p class="small text-muted mb-0">Give your auditor direct access to profit &amp; loss statements, balance sheets, and ledgers for faster filing.</p>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Have questions about Accounting &amp; Tally? Find clear answers below.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-dark" id="faqAccordion">
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How does Tally integration work in EduNex ERP?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                EduNex ERP allows schools to export all fee collections, voucher entries, and department expenses into Tally-compatible XML format with one click, eliminating manual data entry for accounts teams.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can we generate GST-ready reports?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, the accounting module automatically calculates GST input/output tax liability and generates ready-to-file reports for school audits and chartered accountants.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the system support double-entry accounting rules?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, the software enforces standard double-entry bookkeeping rules. Every transaction posts corresponding debit and credit entries to respective ledgers, ensuring strict accounting standards.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can we manage multiple bank accounts and cash boxes?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes. You can set up and reconcile multiple bank accounts, track petty cash boxes, and record bank transfers directly through the accounts module.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How are department budgets and expense approvals managed?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Administrators can define annual budgets for departments (e.g., science lab, library, sports). Expense vouchers go through a multi-level approval process before being paid out.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can chartered accountants access financial records directly?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, you can create a dedicated accountant role with read-only permissions, allowing your auditor to inspect general ledgers, trial balances, and tax audits directly online.
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
        <h2 class="fw-bold display-5 mb-3">Ready to Automate Your School Finances?</h2>
        <p class="mx-auto text-muted mb-4" style="max-width: 600px;">Get started with EduNex ERP (also known as EduNext ERP) today. Eliminate manual entry errors, generate compliant financial statements, and export directly to Tally Prime in one click.</p>
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
