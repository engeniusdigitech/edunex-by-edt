@extends('layouts.admin')
@section('title', 'Library Reports')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="mb-4">
        <h4 class="mb-1" style="color: #1E293B; font-weight: 700;">Library Reports</h4>
        <p class="text-muted mb-0" style="font-size: 0.875rem;">Generate and view insights about library usage and inventory</p>
    </div>

    <!-- Reports Grid -->
    <div class="row g-4">
        <!-- Inventory Reports -->
        <div class="col-12 mb-2">
            <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.75rem; letter-spacing: 1px;">Inventory Reports</h6>
        </div>
        
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(37,99,235,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-book text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Book Inventory</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Complete list of all books, total copies, available copies, and condition status.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'inventory']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-book-dead text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Lost/Damaged Books</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Books marked as lost or damaged, including the users responsible and penalty status.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'lost']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(245,158,11,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-star text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Most Borrowed</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Top books borrowed in a specific time period to help with acquisition planning.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'most-borrowed']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Circulation Reports -->
        <div class="col-12 mb-2 mt-4">
            <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.75rem; letter-spacing: 1px;">Circulation Reports</h6>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-hand-holding text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Issued Books</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">List of all currently issued books, borrowers, and expected return dates.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'issued']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(99,102,241,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-undo text-indigo fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Returned Books</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Log of books returned within a specified date range.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'returned']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(220,38,38,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-exclamation-circle text-danger fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Overdue Books</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Books that have passed their due date and the corresponding fine accrued.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'overdue']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- User Reports -->
        <div class="col-12 mb-2 mt-4">
            <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.75rem; letter-spacing: 1px;">User Reports</h6>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(14,165,233,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-user-graduate text-info fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Student Report</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Library usage statistics for students by class or batch.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'student']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(139,92,246,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-chalkboard-teacher text-purple fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Staff Report</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Library usage statistics and borrowing history for staff members.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'staff']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div style="width:48px;height:48px;border-radius:12px;background:rgba(5,150,105,0.1);display:flex;align-items:center;justify-content:center;margin-right:16px;">
                            <i class="fas fa-money-bill-wave text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">Fine Collection</h6>
                        </div>
                    </div>
                    <p class="text-muted small mb-4 flex-grow-1">Details of fines collected over a period, sorted by date or user.</p>
                    <a href="{{ route('library.reports.generate', ['type' => 'fine']) }}" class="btn btn-outline-primary btn-sm w-100 shadow-sm" style="border-radius:8px;">Generate Report <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
