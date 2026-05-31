@extends('layouts.admin')
@section('title', 'Generate Report')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: #1E293B; font-weight: 700;">{{ ucfirst(str_replace('-', ' ', request('type', 'Custom'))) }} Report</h4>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Filter and export data</p>
        </div>
        <div>
            <a href="{{ route('library.reports.index') }}" class="btn btn-outline-secondary btn-modern shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Back to Reports
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius:16px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-filter text-primary me-2"></i>Report Filters</h6>
                    <form method="GET" action="{{ route('library.reports.generate') }}">
                        <input type="hidden" name="type" value="{{ request('type') }}">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-medium">Date From</label>
                            <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-medium">Date To</label>
                            <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-medium">Book Category</label>
                            <select name="category_id" class="form-select form-select-sm">
                                <option value="">All Categories</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-medium">Batch / Class</label>
                            <select name="batch_id" class="form-select form-select-sm">
                                <option value="">All Batches</option>
                                @foreach($batches ?? [] as $batch)
                                    <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm w-100 shadow-sm mb-2">Apply Filters</button>
                        <a href="{{ route('library.reports.generate', ['type' => request('type')]) }}" class="btn btn-light btn-sm w-100 shadow-sm">Reset</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results Table -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm overflow-hidden mb-4" style="border-radius:16px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">Results</h6>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-success btn-sm shadow-sm" onclick="window.print()">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm shadow-sm" onclick="window.print()">
                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm shadow-sm" onclick="window.print()">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                    </div>
                </div>
                <div class="card-body p-0 mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr style="background-color:#F8FAFC;">
                                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">#</th>
                                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Details</th>
                                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Data</th>
                                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($results ?? [] as $index => $row)
                                <tr>
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="px-4">Demo Data</td>
                                    <td class="px-4">Demo Value</td>
                                    <td class="px-4"><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Active</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div style="width:64px;height:64px;border-radius:16px;background:rgba(100,116,139,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                                            <i class="fas fa-table text-muted fs-3"></i>
                                        </div>
                                        <h6 class="text-dark fw-bold">No Data Found</h6>
                                        <p class="text-muted small mb-0">Try adjusting your filters to find what you're looking for.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            @if(isset($results) && $results->hasPages())
            <div class="d-flex justify-content-end">
                {{ $results->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
