@extends('layouts.admin')

@section('title', 'Fee Defaulters Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="fas fa-exclamation-triangle text-danger me-2"></i> Fee Defaulters</h4>
        <p class="text-muted small mb-0">Monitor unpaid fees and send automated reminders</p>
    </div>
    @if(count($defaulters) > 0)
    <a href="{{ route('reports.defaulters.pdf') }}" class="btn btn-danger btn-modern shadow-sm">
        <i class="fas fa-file-pdf me-2"></i> Download PDF
    </a>
    @endif
</div>

<div class="card border-0 bg-white">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 px-4">
        <h5 class="fw-bold text-dark mb-0">Defaulters List for {{ date('F Y', strtotime($currentMonth . '-01')) }}</h5>
        <p class="text-muted small mt-1 mb-0">Students who have not recorded a payment in the current month.</p>
    </div>
    <div class="card-body p-0">
        @if(count($defaulters) > 0)
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F8FAFC;">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Student Details</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Batch Assignment</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Contact Information</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Current Status</th>
                        <th class="pe-4 py-3 text-end text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($defaulters as $student)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 text-danger border rounded-circle d-flex justify-content-center align-items-center me-3 fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                    {{ substr($student->name, 0, 2) }}
                                </div>
                                <div class="fw-bold text-dark">{{ $student->name }}</div>
                            </div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-light text-secondary border px-3 py-1 rounded-pill">{{ $student->batch->name ?? 'Unassigned' }}</span>
                        </td>
                        <td class="py-3">
                            <div class="small text-dark mb-1"><i class="far fa-envelope text-muted me-1"></i> <a href="mailto:{{ $student->email }}" class="text-decoration-none text-dark">{{ $student->email }}</a></div>
                            <div class="small text-dark"><i class="fas fa-phone-alt text-muted me-1"></i> {{ $student->phone ?? 'Not provided' }}</div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-bold">Unpaid</span>
                        </td>
                        <td class="py-3 text-end pe-4">
                            @php
                                $instituteName = urlencode($student->institute->name ?? 'EduNex');
                                $studentName = urlencode($student->name);
                                $message = "Dear {$studentName},%0A%0AThis is a gentle reminder from *{$instituteName}* that your fee payment for the current month is pending.%0A%0APlease clear your dues at your earliest convenience to maintain uninterrupted access to your classes.%0A%0AThank you!";
                                $phone = preg_replace('/[^0-9]/', '', $student->phone);
                                $whatsappUrl = $phone ? "https://wa.me/{$phone}?text={$message}" : "#";
                            @endphp
                            
                            @if($phone)
                            <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 py-2 shadow-sm me-2 fw-medium">
                                <i class="fab fa-whatsapp me-1"></i> WhatsApp
                            </a>
                            @else
                            <button class="btn btn-sm btn-light text-muted border rounded-pill px-3 py-2 shadow-sm me-2 fw-medium" disabled>
                                <i class="fab fa-whatsapp me-1"></i> Missing Phone
                            </button>
                            @endif
                            
                            <form action="{{ route('reports.notify', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 shadow-sm fw-medium">
                                    <i class="fas fa-bell me-1"></i> Send Alert
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-5 text-center text-muted">
            <div class="d-inline-flex border border-success p-4 rounded-circle mb-3 bg-success bg-opacity-10 text-success">
                <i class="fas fa-check-double fa-2x"></i>
            </div>
            <h5 class="fw-bold text-dark">All Clear!</h5>
            <p class="text-muted small mb-0">Every active student has made a payment this month.</p>
        </div>
        @endif
    </div>
</div>
@endsection
