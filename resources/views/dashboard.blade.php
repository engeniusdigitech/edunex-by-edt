@extends('layouts.admin')

@section('title', 'Institute Dashboard')

@section('content')
<div class="row mb-5 g-4">
    <div class="col-md-4">
        <div class="card card-stat h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-box me-4" style="background: linear-gradient(135deg, #4F46E5, #818CF8); box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Total Students</h6>
                    <h2 class="mb-0 fw-black text-dark" style="font-weight: 800;">{{ $totalStudents ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-box me-4" style="background: linear-gradient(135deg, #10B981, #34D399); box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);">
                    <i class="fas fa-book-open"></i>
                </div>
                <div>
                    <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Active Batches</h6>
                    <h2 class="mb-0 fw-black text-dark" style="font-weight: 800;">{{ $activeBatches ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-box me-4" style="background: linear-gradient(135deg, #F59E0B, #FBBF24); box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div>
                    <h6 class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 1px;">Monthly Revenue</h6>
                    <h2 class="mb-0 fw-black text-dark" style="font-weight: 800;">₹{{ number_format($monthlyRevenue ?? 0, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-stat border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0 text-dark">Revenue Overview</h5>
            </div>
            <div class="card-body p-4">
                <canvas id="revenueChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0 text-dark">Students by Batch</h5>
            </div>
            <div class="card-body p-4 d-flex align-items-center justify-content-center" style="min-height: 250px;">
                <canvas id="batchChart"></canvas>
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

    // Create gradient for chart fill
    const gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
    gradientFill.addColorStop(0, 'rgba(79, 70, 229, 0.5)'); // primary blue, slightly transparent
    gradientFill.addColorStop(1, 'rgba(79, 70, 229, 0.0)'); // fade to transparent

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue (₹)',
                data: data,
                borderColor: '#4F46E5', // Matches primary brand color
                backgroundColor: gradientFill,
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#4F46E5',
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
                legend: {
                    display: false // Hide legend to match modern minimal look
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Batch Data Donut Chart
    const batchCtx = document.getElementById('batchChart').getContext('2d');
    const rawBatchData = @json($studentsPerBatch ?? []);
    const batchLabels = Object.keys(rawBatchData);
    const batchData = Object.values(rawBatchData);
    
    // Modern color palette for donut chart
    const donutColors = [
        '#4F46E5', '#10B981', '#F59E0B', '#EC4899', '#8B5CF6', '#06B6D4'
    ];

    new Chart(batchCtx, {
        type: 'doughnut',
        data: {
            labels: batchLabels,
            datasets: [{
                data: batchData,
                backgroundColor: donutColors,
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            family: "'Outfit', sans-serif"
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
