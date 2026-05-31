@extends('layouts.admin')
@section('title', 'Library Settings')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="mb-4">
        <h4 class="mb-1" style="color: #1E293B; font-weight: 700;">Library Settings</h4>
        <p class="text-muted mb-0" style="font-size: 0.875rem;">Configure general library rules, limits, and operational settings</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
        <i class="fas fa-check-circle text-success fs-4"></i>
        <div><strong>Success!</strong> {{ session('success') }}</div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius:16px;">
                <div class="card-body p-4">
                    <form action="{{ route('library.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h6 class="fw-bold mb-3 pb-2 border-bottom text-primary">Borrowing Rules</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Max Books per Student</label>
                                <input type="number" name="max_books_student" class="form-control @error('max_books_student') is-invalid @enderror" value="{{ old('max_books_student', $settings->max_books_student ?? 3) }}" min="1">
                                @error('max_books_student')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Max Books per Staff</label>
                                <input type="number" name="max_books_staff" class="form-control @error('max_books_staff') is-invalid @enderror" value="{{ old('max_books_staff', $settings->max_books_staff ?? 5) }}" min="1">
                                @error('max_books_staff')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Max Borrow Days (Student)</label>
                                <div class="input-group">
                                    <input type="number" name="max_borrow_days_student" class="form-control @error('max_borrow_days_student') is-invalid @enderror" value="{{ old('max_borrow_days_student', $settings->max_borrow_days_student ?? 14) }}" min="1">
                                    <span class="input-group-text bg-light">Days</span>
                                    @error('max_borrow_days_student')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Max Borrow Days (Staff)</label>
                                <div class="input-group">
                                    <input type="number" name="max_borrow_days_staff" class="form-control @error('max_borrow_days_staff') is-invalid @enderror" value="{{ old('max_borrow_days_staff', $settings->max_borrow_days_staff ?? 30) }}" min="1">
                                    <span class="input-group-text bg-light">Days</span>
                                    @error('max_borrow_days_staff')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 mt-4 pb-2 border-bottom text-primary">Fines & Reservations</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Fine Per Day (Overdue)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">{{ currencySymbol() ?? '$' }}</span>
                                    <input type="number" step="0.01" name="fine_per_day" class="form-control @error('fine_per_day') is-invalid @enderror" value="{{ old('fine_per_day', $settings->fine_per_day ?? 1.00) }}" min="0">
                                    @error('fine_per_day')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">Reservation Expiry Days</label>
                                <div class="input-group">
                                    <input type="number" name="reservation_expiry_days" class="form-control @error('reservation_expiry_days') is-invalid @enderror" value="{{ old('reservation_expiry_days', $settings->reservation_expiry_days ?? 2) }}" min="1">
                                    <span class="input-group-text bg-light">Days</span>
                                    @error('reservation_expiry_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-text">How long a reserved book is held before returning to shelf.</div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 mt-4 pb-2 border-bottom text-primary">Library Operational Days</h6>
                        
                        <div class="mb-4">
                            <label class="form-label fw-medium d-block">Working Days</label>
                            @php $workingDays = is_array($settings->working_days ?? null) ? $settings->working_days : json_decode($settings->working_days ?? '["Mon","Tue","Wed","Thu","Fri"]', true) ?? []; @endphp
                            <div class="d-flex flex-wrap gap-3">
                                @foreach(['Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday'] as $short => $full)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="working_days[]" value="{{ $short }}" id="day_{{ $short }}" {{ in_array($short, old('working_days', $workingDays)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="day_{{ $short }}">{{ $full }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('working_days')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            <div class="form-text mt-2">Only working days are counted when calculating overdue fines (optional).</div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary shadow-sm px-4">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius:16px; background-color: #F8FAFC;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>About Settings</h6>
                    <p class="text-muted small mb-3">Library rules help automate daily operations like calculating fines and monitoring limits.</p>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.8;">
                        <li><strong>Limits:</strong> Restrict how many books a user can hold at once.</li>
                        <li><strong>Borrow Days:</strong> Maximum duration a user can keep a book before it becomes overdue.</li>
                        <li><strong>Fines:</strong> Automatically calculated when an overdue book is returned. You can optionally waive fines during return.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
