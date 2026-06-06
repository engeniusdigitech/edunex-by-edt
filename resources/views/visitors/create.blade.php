@extends('layouts.admin')

@section('title', 'Gate Entry Check-in')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold text-dark mb-0"><i class="fas fa-sign-in-alt text-primary me-2"></i>Gate Entry Check-in</h5>
                        <p class="text-muted small mb-0">Log guest credentials and issue dynamic gate passes</p>
                    </div>
                    <a href="{{ route('visitors.index') }}" class="btn btn-outline-secondary rounded-pill btn-sm px-3">
                        <i class="fas fa-arrow-left me-1"></i>Back to Logs
                    </a>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('visitors.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3 mb-3">
                        <!-- Visitor Name -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Visitor's Full Name</label>
                            <input type="text" name="visitor_name" class="form-control @error('visitor_name') is-invalid @enderror" value="{{ old('visitor_name') }}" placeholder="e.g. Rajesh Sharma" required>
                            @error('visitor_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Contact Mobile Number</label>
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="e.g. 9812345678" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Email -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Email Address (Optional)</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="e.g. guest@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Purpose -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Purpose of Visit</label>
                            <select name="purpose" class="form-select @error('purpose') is-invalid @enderror" required>
                                <option value="">-- Select Purpose --</option>
                                <option value="Admission Enquiry" {{ old('purpose') === 'Admission Enquiry' ? 'selected' : '' }}>Admission Enquiry</option>
                                <option value="Parent-Teacher Meeting" {{ old('purpose') === 'Parent-Teacher Meeting' ? 'selected' : '' }}>Parent-Teacher Meeting</option>
                                <option value="Official Meeting" {{ old('purpose') === 'Official Meeting' ? 'selected' : '' }}>Official Meeting / Audit</option>
                                <option value="Supplier / Delivery" {{ old('purpose') === 'Supplier / Delivery' ? 'selected' : '' }}>Supplier / Vendor Delivery</option>
                                <option value="Maintenance / Service" {{ old('purpose') === 'Maintenance / Service' ? 'selected' : '' }}>Maintenance / Support</option>
                                <option value="Personal / Meeting Staff" {{ old('purpose') === 'Personal / Meeting Staff' ? 'selected' : '' }}>Personal Meet with Warden/Staff</option>
                            </select>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3 bg-light p-3 rounded-4 border border-light-subtle">
                        <div class="col-12"><span class="fw-bold text-dark text-xs text-uppercase tracking-wider">Host Details (Whom to Meet)</span></div>
                        
                        <!-- Select Staff -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Select Institutional Host</label>
                            <select name="whom_to_meet_id" id="whom_to_meet_id" class="form-select @error('whom_to_meet_id') is-invalid @enderror">
                                <option value="">-- Select from user list --</option>
                                @foreach($staffMembers as $staff)
                                    <option value="{{ $staff->id }}" {{ old('whom_to_meet_id') == $staff->id ? 'selected' : '' }}>
                                        {{ $staff->name }} ({{ $staff->role->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('whom_to_meet_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Custom Host -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Or Custom Host Name</label>
                            <input type="text" name="whom_to_meet_name" id="whom_to_meet_name" class="form-control @error('whom_to_meet_name') is-invalid @enderror" value="{{ old('whom_to_meet_name') }}" placeholder="e.g. Warden Block A, Mess Manager">
                            @error('whom_to_meet_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Gate Number -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Gate Entry Point</label>
                            <select name="gate_number" class="form-select @error('gate_number') is-invalid @enderror" required>
                                <option value="Main Security Gate" {{ old('gate_number') === 'Main Security Gate' ? 'selected' : '' }}>Main Security Gate (Gate 1)</option>
                                <option value="Hostel Gate A" {{ old('gate_number') === 'Hostel Gate A' ? 'selected' : '' }}>Hostel Rear Entrance (Gate 2)</option>
                                <option value="Sports Complex Gate" {{ old('gate_number') === 'Sports Complex Gate' ? 'selected' : '' }}>Sports Complex Entrance (Gate 3)</option>
                            </select>
                            @error('gate_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Number -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">Vehicle Plate Number (Optional)</label>
                            <input type="text" name="vehicle_number" class="form-control @error('vehicle_number') is-invalid @enderror" value="{{ old('vehicle_number') }}" placeholder="e.g. DL-3C-AB-9922">
                            @error('vehicle_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- ID proof type -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">ID Proof Submitted</label>
                            <select name="id_proof_type" class="form-select @error('id_proof_type') is-invalid @enderror" required>
                                <option value="Aadhaar Card" {{ old('id_proof_type') === 'Aadhaar Card' ? 'selected' : '' }}>Aadhaar Card</option>
                                <option value="PAN Card" {{ old('id_proof_type') === 'PAN Card' ? 'selected' : '' }}>PAN Card</option>
                                <option value="Driving License" {{ old('id_proof_type') === 'Driving License' ? 'selected' : '' }}>Driving License</option>
                                <option value="Passport" {{ old('id_proof_type') === 'Passport' ? 'selected' : '' }}>Passport</option>
                                <option value="Student/Staff Card" {{ old('id_proof_type') === 'Student/Staff Card' ? 'selected' : '' }}>Student/Staff Card</option>
                            </select>
                            @error('id_proof_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ID proof number -->
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-muted small fw-semibold">ID Proof Reference Number</label>
                            <input type="text" name="id_proof_number" class="form-control @error('id_proof_number') is-invalid @enderror" value="{{ old('id_proof_number') }}" placeholder="e.g. Last 4 digits or ID code">
                            @error('id_proof_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold">Remarks / Package items logged</label>
                        <textarea name="remarks" rows="2" class="form-control @error('remarks') is-invalid @enderror" placeholder="Carry-in bags, laptops, or general notes...">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5 shadow-sm">
                        <i class="fas fa-sign-in-alt me-1"></i>Authorize Entry &amp; Issue Pass
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
