@extends('layouts.admin')

@section('title', 'Library Dashboard')

@section('content')

    {{-- ── OVERDUE ALERT BANNER ── --}}
    @if($overdueBooks > 0)
        <div class="alert border-0 d-flex align-items-center gap-3 mb-4"
            style="background:linear-gradient(135deg,#FEF2F2,#FFF1F2);border-radius:14px;padding:14px 20px;border-left:4px solid #EF4444!important;">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(239,68,68,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="fas fa-exclamation-triangle" style="color:#EF4444;font-size:1rem;"></i>
            </div>
            <div>
                <span class="fw-semibold text-dark" style="font-size:0.88rem;">{{ $overdueBooks }} book{{ $overdueBooks > 1 ? 's are' : ' is' }} overdue!</span>
                <span class="text-muted" style="font-size:0.82rem;"> Please follow up with members to collect overdue items.</span>
            </div>
        </div>
    @endif

    {{-- ── ROW 1: 6 STAT CARDS ── --}}
    <div class="row g-3 mb-4">
        {{-- Total Books --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(37,99,235,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Total Books</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(37,99,235,0.1);color:#2563EB;font-size:0.75rem;">
                            <i class="fas fa-book"></i>
                        </div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $totalBooks }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">in library</div>
                </div>
            </div>
        </div>

        {{-- Available --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(16,185,129,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Available</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(16,185,129,0.1);color:#10B981;font-size:0.75rem;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $availableBooks }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">copies available</div>
                </div>
            </div>
        </div>

        {{-- Issued --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(245,158,11,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Issued</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(245,158,11,0.1);color:#F59E0B;font-size:0.75rem;">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $issuedBooks }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">currently issued</div>
                </div>
            </div>
        </div>

        {{-- Overdue --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(239,68,68,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Overdue</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(239,68,68,0.1);color:#EF4444;font-size:0.75rem;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $overdueBooks }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">overdue items</div>
                </div>
            </div>
        </div>

        {{-- Fines Collected --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(139,92,246,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Fines</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(139,92,246,0.1);color:#8B5CF6;font-size:0.75rem;">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;font-size:1.3rem;">{{ currencySymbol() }}{{ number_format($finesCollected, 0) }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">collected</div>
                </div>
            </div>
        </div>

        {{-- Reservations --}}
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(20,184,166,0.08);">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-uppercase fw-medium text-muted" style="font-size:0.62rem;letter-spacing:1px;">Reservations</span>
                        <div class="rounded-2 d-flex align-items-center justify-content-center"
                            style="width:30px;height:30px;background:rgba(20,184,166,0.1);color:#14B8A6;font-size:0.75rem;">
                            <i class="fas fa-bookmark"></i>
                        </div>
                    </div>
                    <h2 class="fw-black mb-0" style="color:#0F172A;">{{ $totalReservations }}</h2>
                    <div class="text-muted" style="font-size:0.7rem;">active reservations</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── ROW 2: CHARTS ── --}}
    <div class="row g-4 mb-4">
        {{-- Issue Trends Line Chart --}}
        <div class="col-lg-8">
            <div class="card border-0" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-medium text-dark mb-0">Issue Trends</h6>
                        <p class="text-muted small mb-0">Monthly book issues</p>
                    </div>
                    <span class="badge rounded-pill px-3 py-2 fw-semibold"
                        style="background:#EFF6FF;color:#2563EB;font-size:0.7rem;">
                        <i class="fas fa-chart-line me-1"></i> Last 12 months
                    </span>
                </div>
                <div class="card-body p-4">
                    <canvas id="issueTrendChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- Books by Category Doughnut --}}
        <div class="col-lg-4">
            <div class="card border-0 h-100" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h6 class="fw-medium text-dark mb-0">Books by Category</h6>
                    <p class="text-muted small mb-0">Distribution</p>
                </div>
                <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height:220px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ── ROW 3: RECENT TABLES ── --}}
    <div class="row g-4">
        {{-- Recently Issued Books --}}
        <div class="col-lg-6">
            <div class="card border-0 overflow-hidden" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-medium text-dark mb-0">Recently Issued Books</h6>
                    <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:rgba(245,158,11,0.1);color:#F59E0B;font-size:0.68rem;">Last 10</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr style="background-color:#F8FAFC;">
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Book Title</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Member</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Issue Date</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Due Date</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentlyIssuedBooks as $issue)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-medium text-dark" style="font-size:0.85rem;">{{ Str::limit($issue->book->title ?? '—', 25) }}</div>
                                    </td>
                                    <td class="py-3">
                                        <div class="text-dark" style="font-size:0.82rem;">{{ $issue->member->name ?? '—' }}</div>
                                    </td>
                                    <td class="py-3">
                                        <div class="text-muted" style="font-size:0.82rem;">{{ $issue->issue_date ? $issue->issue_date->format('d M Y') : '—' }}</div>
                                    </td>
                                    <td class="py-3">
                                        <div class="text-muted" style="font-size:0.82rem;">{{ $issue->due_date ? $issue->due_date->format('d M Y') : '—' }}</div>
                                    </td>
                                    <td class="py-3">
                                        @if($issue->status === 'returned')
                                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Returned</span>
                                        @elseif($issue->status === 'overdue')
                                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Overdue</span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 fw-medium">Issued</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                            <i class="fas fa-hand-holding fa-2x"></i>
                                        </div>
                                        <h6 class="fw-medium text-dark">No recent issues</h6>
                                        <p class="text-muted small mb-0">Book issues will appear here.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Recently Added Books --}}
        <div class="col-lg-6">
            <div class="card border-0 overflow-hidden" style="border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.04);">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-medium text-dark mb-0">Recently Added Books</h6>
                    <span class="badge rounded-pill px-3 py-2 fw-medium" style="background:rgba(37,99,235,0.1);color:#2563EB;font-size:0.68rem;">Last 10</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr style="background-color:#F8FAFC;">
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Cover</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Title</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Author</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Category</th>
                                <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Copies</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentlyAddedBooks as $book)
                                <tr>
                                    <td class="px-4 py-3">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                                class="rounded" style="width:40px;height:50px;object-fit:cover;">
                                        @else
                                            <div class="rounded d-flex align-items-center justify-content-center"
                                                style="width:40px;height:50px;background:rgba(37,99,235,0.08);color:#2563EB;font-size:0.8rem;">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div class="fw-medium text-dark" style="font-size:0.85rem;">{{ Str::limit($book->title, 22) }}</div>
                                    </td>
                                    <td class="py-3">
                                        <div class="text-muted" style="font-size:0.82rem;">{{ $book->author->name ?? '—' }}</div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium" style="font-size:0.7rem;">{{ $book->category->name ?? '—' }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="fw-semibold text-dark" style="font-size:0.85rem;">{{ $book->total_copies ?? 0 }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                            <i class="fas fa-book fa-2x"></i>
                                        </div>
                                        <h6 class="fw-medium text-dark">No books added yet</h6>
                                        <p class="text-muted small mb-0">New books will appear here.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // ── Issue Trends Line Chart ──
    const issueCtx = document.getElementById('issueTrendChart').getContext('2d');
    const issueData = @json($monthlyIssues);
    const issueGrad = issueCtx.createLinearGradient(0, 0, 0, 300);
    issueGrad.addColorStop(0, 'rgba(37,99,235,0.18)');
    issueGrad.addColorStop(1, 'rgba(37,99,235,0.0)');
    new Chart(issueCtx, {
        type: 'line',
        data: {
            labels: Object.keys(issueData),
            datasets: [{
                label: 'Books Issued',
                data: Object.values(issueData),
                borderColor: '#2563EB',
                backgroundColor: issueGrad,
                borderWidth: 2.5,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#2563EB',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E293B',
                    titleFont: { family: 'Outfit' },
                    bodyFont: { family: 'Outfit' },
                    cornerRadius: 8,
                    padding: 12
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: { font: { family: 'Outfit', size: 11 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Outfit', size: 11 } }
                }
            }
        }
    });

    // ── Books by Category Doughnut Chart ──
    const catCtx = document.getElementById('categoryChart').getContext('2d');
    const catData = @json($booksByCategory);
    const catColors = ['#2563EB', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#14B8A6', '#EC4899', '#06B6D4', '#F97316', '#6366F1'];
    new Chart(catCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(catData),
            datasets: [{
                data: Object.values(catData),
                backgroundColor: catColors.slice(0, Object.keys(catData).length),
                borderWidth: 0,
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 12,
                        font: { size: 10, family: 'Outfit' }
                    }
                },
                tooltip: {
                    backgroundColor: '#1E293B',
                    titleFont: { family: 'Outfit' },
                    bodyFont: { family: 'Outfit' },
                    cornerRadius: 8,
                    padding: 12
                }
            }
        }
    });
</script>
@endpush
