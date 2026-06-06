<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Self-Registration - {{ $institute->name }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563EB;
            --primary-glow: rgba(37, 99, 235, 0.15);
            --bg-color: #F8FAFC;
            --text-main: #0F172A;
            --text-muted: #64748B;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 10px;
        }

        .register-container {
            width: 100%;
            max-width: 580px;
            background-color: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .header-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            padding: 32px 24px;
            text-align: center;
            position: relative;
        }

        .header-banner::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: radial-gradient(circle, #2563eb 0%, transparent 70%);
            opacity: 0.5;
        }

        .form-section {
            padding: 32px 24px;
        }

        .form-control, .form-select {
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.25s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px var(--primary-glow);
            background-color: #ffffff;
        }

        .input-group-text {
            background-color: #F1F5F9;
            border: 1.5px solid #E2E8F0;
            border-radius: 12px;
            color: var(--text-muted);
            padding: 12px 16px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
            color: #ffffff;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .required-star {
            color: #EF4444;
        }
    </style>
</head>
<body>

<div class="register-container">
    <!-- Banner Header -->
    <div class="header-banner">
        <i class="fas fa-id-badge fs-1 mb-2 text-primary"></i>
        <h4 class="fw-bold mb-1">{{ $institute->name }}</h4>
        <div class="text-white-50 small">Visitor Entry Registration Form</div>
    </div>

    <!-- Registration Form -->
    <div class="form-section">
        @if ($errors->any())
            <div class="alert alert-danger border-0 rounded-4 p-3 mb-4">
                <div class="fw-bold mb-2 small"><i class="fas fa-exclamation-triangle me-1"></i> Please fix validation errors:</div>
                <ul class="mb-0 small ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('visitors.public-store', $institute->id) }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Full Name <span class="required-star">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="visitor_name" class="form-control" placeholder="Enter your full name" value="{{ old('visitor_name') }}" required>
                </div>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label class="form-label">Phone Number <span class="required-star">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="tel" name="phone_number" class="form-control" placeholder="Enter mobile number" value="{{ old('phone_number') }}" required>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email Address (Optional)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Enter email address" value="{{ old('email') }}">
                </div>
            </div>

            <div class="row">
                <!-- Gate Number -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Entry Gate <span class="required-star">*</span></label>
                    <select name="gate_number" class="form-select" required>
                        <option value="Main Gate" {{ old('gate_number') == 'Main Gate' ? 'selected' : '' }}>Main Entrance Gate</option>
                        <option value="Reception" {{ old('gate_number') == 'Reception' ? 'selected' : '' }}>Reception Desk</option>
                        <option value="Hostel Gate" {{ old('gate_number') == 'Hostel Gate' ? 'selected' : '' }}>Hostel Gate</option>
                        <option value="Admin Block" {{ old('gate_number') == 'Admin Block' ? 'selected' : '' }}>Admin Block Gate</option>
                    </select>
                </div>

                <!-- Vehicle Number -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vehicle Number (Optional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-car"></i></span>
                        <input type="text" name="vehicle_number" class="form-control" placeholder="e.g. DL-3C-1234" value="{{ old('vehicle_number') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- ID Proof Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Proof Type <span class="required-star">*</span></label>
                    <select name="id_proof_type" class="form-select" required>
                        <option value="Aadhaar Card" {{ old('id_proof_type') == 'Aadhaar Card' ? 'selected' : '' }}>Aadhaar Card</option>
                        <option value="PAN Card" {{ old('id_proof_type') == 'PAN Card' ? 'selected' : '' }}>PAN Card</option>
                        <option value="Driving License" {{ old('id_proof_type') == 'Driving License' ? 'selected' : '' }}>Driving License</option>
                        <option value="Passport" {{ old('id_proof_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                        <option value="Other ID" {{ old('id_proof_type') == 'Other ID' ? 'selected' : '' }}>Other Govt ID</option>
                    </select>
                </div>

                <!-- ID Proof Number -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Proof Number (Last 4 digits)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" name="id_proof_number" class="form-control" placeholder="Last 4 digits" maxlength="20" value="{{ old('id_proof_number') }}">
                    </div>
                </div>
            </div>

            <!-- Host Selection (Whom to meet) -->
            <div class="mb-3">
                <label class="form-label">Whom to Meet <span class="required-star">*</span></label>
                <select name="whom_to_meet_id" id="hostSelect" class="form-select mb-2" onchange="toggleCustomHost(this)">
                    <option value="">Select the host person...</option>
                    @foreach($staffMembers as $staff)
                        <option value="{{ $staff->id }}" {{ old('whom_to_meet_id') == $staff->id ? 'selected' : '' }}>
                            {{ $staff->name }} ({{ $staff->role->name }})
                        </option>
                    @endforeach
                    <option value="custom" {{ old('whom_to_meet_id') == 'custom' || old('whom_to_meet_name') ? 'selected' : '' }}>
                        Host Not Listed (Enter Custom Name)
                    </option>
                </select>
                
                <!-- Custom Host Name Field -->
                <div id="customHostGroup" class="input-group mt-2 d-none">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    <input type="text" name="whom_to_meet_name" id="customHostInput" class="form-control" placeholder="Enter name of person to meet" value="{{ old('whom_to_meet_name') }}">
                </div>
            </div>

            <!-- Purpose -->
            <div class="mb-3">
                <label class="form-label">Purpose of Visit <span class="required-star">*</span></label>
                <select name="purpose" class="form-select" required>
                    <option value="Admission Enquiry" {{ old('purpose') == 'Admission Enquiry' ? 'selected' : '' }}>Admission Enquiry</option>
                    <option value="Parent-Teacher Meeting" {{ old('purpose') == 'Parent-Teacher Meeting' ? 'selected' : '' }}>Parent-Teacher Meeting</option>
                    <option value="Official Meeting" {{ old('purpose') == 'Official Meeting' ? 'selected' : '' }}>Official / Business Meeting</option>
                    <option value="Supplier / Delivery" {{ old('purpose') == 'Supplier / Delivery' ? 'selected' : '' }}>Supplier / Logistics Delivery</option>
                    <option value="Maintenance / Service" {{ old('purpose') == 'Maintenance / Service' ? 'selected' : '' }}>Maintenance / Support Service</option>
                    <option value="Other" {{ old('purpose') == 'Other' ? 'selected' : '' }}>Other Purpose</option>
                </select>
            </div>

            <!-- Remarks -->
            <div class="mb-4">
                <label class="form-label">Remarks / Additional Notes</label>
                <textarea name="remarks" class="form-control" rows="2" placeholder="e.g. Carrying laptop, personal bags">{{ old('remarks') }}</textarea>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane me-2"></i>Submit Registration</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleCustomHost(select) {
    const group = document.getElementById('customHostGroup');
    const input = document.getElementById('customHostInput');
    if (select.value === 'custom') {
        group.classList.remove('d-none');
        input.setAttribute('required', 'required');
    } else {
        group.classList.add('d-none');
        input.removeAttribute('required');
        input.value = '';
    }
}

// Run onload check for custom select selection
document.addEventListener('DOMContentLoaded', function() {
    toggleCustomHost(document.getElementById('hostSelect'));
});
</script>

</body>
</html>
