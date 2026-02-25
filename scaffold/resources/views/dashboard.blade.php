@extends('layouts.admin')

@section('title', 'Institute Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-primary me-3">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Total Students</h6>
                    <h3 class="mb-0">{{ $totalStudents ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-success me-3">
                    <i class="fas fa-book-open"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Active Batches</h6>
                    <h3 class="mb-0">{{ $activeBatches ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-info me-3">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0">Monthly Revenue</h6>
                    <h3 class="mb-0">₹{{ number_format($monthlyRevenue ?? 0, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-stat">
            <div class="card-header bg-white">
                <h5 class="mb-0">Revenue Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Revenue Data provided from Controller
    const rawData = @json($revenueData ?? []);
    const labels = Object.keys(rawData);
    const data = Object.values(rawData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue (₹)',
                data: data,
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
