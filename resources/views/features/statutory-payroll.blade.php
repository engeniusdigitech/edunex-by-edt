<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-seo
        title="School & Institute Payroll Software | HR Statutory Payroll Management — EduNex ERP"
        description="Run compliant school and institute payroll in one click. EduNex ERP automates PF, ESIC, TDS calculations, CL/EL leave caps, biometric salary pro-rating, and generates PDF payslips. Best payroll software for schools and coaching institutes."
        keywords="school payroll software, institute payroll software, school HR software, school salary management system, payroll software for schools, institute salary management, school staff payroll ERP, PF ESIC TDS school software, school staff management software, coaching institute payroll, employee payroll software for schools, EduNex ERP payroll"
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
        "name": "Statutory Payroll",
        "item": "{{ route('features.statutory-payroll') }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [{
        "@@type": "Question",
        "name": "Does the payroll module support statutory deductions like PF and ESI?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes. The system automatically computes Provident Fund (PF) contributions, Employee State Insurance (ESI), Professional Tax (PT), and Tax Deducted at Source (TDS) based on real-time salary structures and active tax slabs."
        }
      },{
        "@@type": "Question",
        "name": "Can teachers download their payslips online?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes. Once payroll is generated and approved, staff members receive an email notification and can securely download their detailed PDF payslips directly from their employee self-service portal."
        }
      },{
        "@@type": "Question",
        "name": "How is attendance integrated with salary calculations?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "EduNex ERP integrates directly with your campus biometric machines. Logins/logouts are synced automatically to calculate actual present days, pro-rated payables, and unpaid absences based on shift configurations."
        }
      },{
        "@@type": "Question",
        "name": "Can we configure custom salary structures for different staff groups?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, administrators can set up unique salary templates for teaching staff, administration, non-teaching staff, and temporary contractors, defining base pays and custom allowances."
        }
      },{
        "@@type": "Question",
        "name": "Does the software generate tax declaration forms and TDS reports?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Yes, the platform generates tax calculations, processes employee tax declarations, and exports standard TDS reports that help accounting teams during quarterly filings."
        }
      },{
        "@@type": "Question",
        "name": "How does payroll handle paid leaves, unpaid leaves, and half-days?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Leaves approved through the HR module (such as casual leaves or medical leaves) are fully synchronized. The system automatically calculates pro-rated deductions for half-days or unauthorized unpaid absences."
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
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem;">HR Module</span>
            <h1 class="fw-bold display-4 mb-3">Statutory HR &amp; <span class="g-text">Payroll Management</span></h1>
            <p class="lead text-muted mb-4">
                Run compliant educational payroll in one click. Customize provident fund (PF) and employee state insurance (ESIC) deduction ratios. Restrict paid leave entitlements with distinct annual Casual Leave (CL) and Earned Leave (EL) caps, pro-rating salaries based on biometric check-ins and tax (TDS) slabs.
            </p>
            <div class="hero-feat-pills mb-4">
                <span class="hpill"><i class="fas fa-percent"></i> Custom PF &amp; ESIC rates</span>
                <span class="hpill"><i class="fas fa-calendar-alt"></i> CL / EL Leave Caps</span>
                <span class="hpill"><i class="fas fa-calculator"></i> TDS Bracket Slabs</span>
                <span class="hpill"><i class="fas fa-file-invoice-dollar"></i> PDF Corporate Payslips</span>
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
                    <span class="text-uppercase fw-bold text-success" style="font-size: 0.65rem; letter-spacing: 1px;">Itemized Salary Summary</span>
                </div>
                <div class="p-4" style="background: hsl(222, 47%, 7%); border-bottom: 1px solid var(--border);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 fw-bold">Active Staff: Dr. Ramesh Verma (Dean)</h6>
                        <span class="badge bg-success text-dark px-2 py-1" style="font-size:0.65rem;">Calculated</span>
                    </div>
                    <div class="list-group list-group-flush" style="font-size:0.85rem;">
                        <div class="d-flex justify-content-between py-2 border-bottom border-secondary text-muted">
                            <span>Basic Gross Salary</span>
                            <span class="text-white">₹75,000.00</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-secondary text-muted">
                            <span>Provident Fund (PF @ 12%)</span>
                            <span class="text-danger">-₹9,000.00</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-secondary text-muted">
                            <span>Employee State Insurance (ESIC @ 0.75%)</span>
                            <span class="text-danger">-₹562.50</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-secondary text-muted">
                            <span>TDS (Tax Slab Deduction)</span>
                            <span class="text-danger">-₹3,750.00</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 text-muted fw-bold">
                            <span class="text-white">Net Paid Disbursed</span>
                            <span class="text-success" style="font-size: 1rem;">₹61,687.50</span>
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
                        <i class="fas fa-percent"></i>
                    </div>
                    <h5 class="fw-bold mb-2">PF &amp; ESIC Calculators</h5>
                    <p class="small text-muted mb-3">Input custom employee contribution rates (e.g., 12% PF, 0.75% ESIC) to automatically calculate statutory monthly deductions correctly.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Custom PF</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> ESIC Deduct</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(217, 91%, 60%, 0.1); border-radius: 12px; color: var(--secondary); font-size: 1.25rem;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Annual CL &amp; EL Cap Guards</h5>
                    <p class="small text-muted mb-3">Configure separate annual allowances for Casual Leaves (CL) and Earned Leaves (EL), automatically pro-rating basic salaries upon overrun.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> CL/EL Limits</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Bio Pro-rating</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: hsla(262, 83%, 58%, 0.1); border-radius: 12px; color: #a855f7; font-size: 1.25rem;">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h5 class="fw-bold mb-2">TDS Bracket Slabs</h5>
                    <p class="small text-muted mb-3">Computes monthly Tax Deducted at Source (TDS) based on pro-rated annual income brackets and standard tax deduction slabs instantly.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> TDS Slabs</span>
                        <span class="small px-2 py-1" style="background: hsla(210,40%,98%,0.04); border: 1px solid hsla(210,40%,98%,0.09); border-radius: 6px; font-size: 0.65rem; color: var(--muted);"><i class="fas fa-check text-success me-1"></i> Tax Audit</span>
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
                    <h5 class="fw-bold mb-2">Biometric Attendance Integration</h5>
                    <p class="small text-muted mb-0">Biometric check-in/out logs sync with the payroll engine to calculate active workdays, sick leaves, and unapproved employee absences.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">2</div>
                    <h5 class="fw-bold mb-2">Deduction Calculation</h5>
                    <p class="small text-muted mb-0">The engine processes leaves against CL/EL caps, pro-rates salaries for overruns, and applies PF, ESIC, and TDS tax brackets automatically.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feat-card p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; background: var(--gradient-primary); color: hsl(222,47%,6%); border-radius: 50%; font-size: 1.1rem;">3</div>
                    <h5 class="fw-bold mb-2">Payslip Generation</h5>
                    <p class="small text-muted mb-0">Generate print-ready corporate payslips in one click. System creates detailed itemized breakdown (Gross, PF, ESIC, TDS, Net Pay) ready for bank disbursals.</p>
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
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">Manual Excel Payroll</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Manual entry errors when copying biometric records to calculate pro-rated days.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Mismatched tracking of employee annual Casual and Earned leave caps.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Tax computation errors due to manual TDS slab processing.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-times-circle text-danger mt-1"></i> <span>Slow payslip generation and distribution, taking hours or days of admin effort.</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 h-100" style="background: hsla(174, 50%, 10%, 0.1); border: 1px solid hsla(174, 72%, 56%, 0.2); border-radius: 16px;">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 mb-4 text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">EduNex ERP HR Payroll</span>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-muted mb-0">
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Biometric logins automatically calculate pro-rated workdays with precision.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Leaves automatically checked and tracked against distinct annual CL and EL caps.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>Automated TDS calculations based on real-time tax bracket configurations.</span></li>
                        <li class="d-flex gap-2"><i class="fas fa-check-circle text-success mt-1"></i> <span>One-click PDF payslip generation and auto-ledger bookkeeping vouchers.</span></li>
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
            <span class="badge-pill mb-3" style="text-transform:uppercase; letter-spacing:1px; color:var(--primary); font-size:0.75rem; background: hsla(174,72%,56%,0.1); border: 1px solid hsla(174,72%,56%,0.2); padding: 5px 14px; border-radius: 9999px;">HR Operations</span>
            <h2 class="fw-bold display-5 mb-3">Key Benefits &amp; Impact</h2>
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Streamline staff administration, automate complex tax computations, and provide self-service tools to your team.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(174, 72%, 56%, 0.1); border-radius: 10px; color: var(--primary); font-size: 1.15rem;">
                        <i class="fas fa-fingerprint"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Biometric Attendance Sync</h6>
                    <p class="small text-muted mb-0">Directly sync log sheets to pro-rate monthly payouts, process late check-in penalties, and calculate overtime hours automatically.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(217, 91%, 60%, 0.1); border-radius: 10px; color: var(--secondary); font-size: 1.15rem;">
                        <i class="fas fa-scale-balanced"></i>
                    </div>
                    <h6 class="fw-bold mb-2">100% Tax Compliance</h6>
                    <p class="small text-muted mb-0">System-enforced statutory computations automatically deduct correct PF, ESIC, Professional Tax, and TDS allocations.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(262, 83%, 58%, 0.1); border-radius: 10px; color: #a855f7; font-size: 1.15rem;">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Staff Self-Service Portal</h6>
                    <p class="small text-muted mb-0">Teachers can log in to view payslip histories, download tax statements, apply for leaves, and inspect leave balance limits.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feat-card p-4">
                    <div class="mb-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: hsla(142, 72%, 29%, 0.1); border-radius: 10px; color: #22c55e; font-size: 1.15rem;">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Single-Click Payouts</h6>
                    <p class="small text-muted mb-0">Generate pre-formatted bank upload files and detailed ledger logs to settle monthly salaries in a few minutes.</p>
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
            <p class="mx-auto text-muted mb-0" style="max-width: 600px;">Have questions about HR &amp; Statutory Payroll? Find clear answers below.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-dark" id="faqAccordion">
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the payroll module support statutory deductions like PF and ESI?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes. The system automatically computes Provident Fund (PF) contributions, Employee State Insurance (ESI), Professional Tax (PT), and Tax Deducted at Source (TDS) based on real-time salary structures and active tax slabs.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can teachers download their payslips online?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes. Once payroll is generated and approved, staff members receive an email notification and can securely download their detailed PDF payslips directly from their employee self-service portal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How is attendance integrated with salary calculations?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                EduNex ERP integrates directly with your campus biometric machines. Logins/logouts are synced automatically to calculate actual present days, pro-rated payables, and unpaid absences based on shift configurations.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Can we configure custom salary structures for different staff groups?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, administrators can set up unique salary templates for teaching staff, administration, non-teaching staff, and temporary contractors, defining base pays and custom allowances.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                Does the software generate tax declaration forms and TDS reports?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Yes, the platform generates tax calculations, processes employee tax declarations, and exports standard TDS reports that help accounting teams during quarterly filings.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; margin-bottom: 12px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" style="background: transparent; color: var(--foreground); box-shadow: none;">
                                How does payroll handle paid leaves, unpaid leaves, and half-days?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small" style="border-top: 1px solid var(--border);">
                                Leaves approved through the HR module (such as casual leaves or medical leaves) are fully synchronized. The system automatically calculates pro-rated deductions for half-days or unauthorized unpaid absences.
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
        <h2 class="fw-bold display-5 mb-3">Simplify School Staff &amp; Payroll Management</h2>
        <p class="mx-auto text-muted mb-4" style="max-width: 600px;">Get started with EduNex ERP (also known as EduNext ERP) today. Automate shift tracking, process salary payouts with one click, and stay 100% compliant with statutory guidelines.</p>
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
