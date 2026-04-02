<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave — EduNex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --indigo: #6366F1;
            --indigo-dark: #4F46E5;
            --pink: #EC4899;
            --emerald: #10B981;
            --amber: #F59E0B;
            --red: #EF4444;
            --bg: #F1F5F9;
            --card: #ffffff;
            --border: #E2E8F0;
            --text: #0F172A;
            --muted: #64748B;
            --radius: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .top-navbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand .brand-badge {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--pink));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 800;
            color: #fff;
        }

        .nav-brand .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
        }

        .page {
            max-width: 600px;
            margin: 0 auto;
            padding: 32px 20px 60px;
        }

        .card-block {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            background: #F8FAFC;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            background: #fff;
            border-color: var(--indigo);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--indigo), #818CF8);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            margin-top: 16px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
            transition: all 0.2s;
        }

        .btn-submit:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3);
        }

        @media (max-width: 640px) {
            .page { padding: 20px 16px 60px; }
            .card-block { padding: 24px 20px; }
            .top-navbar { padding: 0 16px; }
        }
    </style>
</head>
<body>
    <nav class="top-navbar">
        <a href="{{ route('student.dashboard') }}" class="nav-brand">
            <div class="brand-badge text-uppercase">EN</div>
            <div class="brand-name">EDUNEX <span style="font-size: 0.7rem; opacity: 0.6;">STUDENT</span></div>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('student.leaves.index') }}" class="text-muted text-decoration-none small fw-bold">HISTORY</a>
        </div>
    </nav>

    <div class="page">
        <div class="text-center mb-4">
            <h4 class="fw-bold mb-1">Apply for Leave</h4>
            <p class="text-muted small">Submit your leave request for approval.</p>
        </div>

        <div class="card-block">
            <form action="{{ route('student.leaves.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Type of Leave</label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        <option value="Sick Leave" {{ old('type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                        <option value="Casual Leave" {{ old('type') == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                        <option value="Emergency Leave" {{ old('type') == 'Emergency Leave' ? 'selected' : '' }}>Emergency Leave</option>
                        <option value="Personal Leave" {{ old('type') == 'Personal Leave' ? 'selected' : '' }}>Personal Leave</option>
                        <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', date('Y-m-d')) }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', date('Y-m-d')) }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Reason for Leave</label>
                    <textarea name="reason" class="form-control @error('reason') is-invalid @enderror" placeholder="Provide a brief explanation..." rows="4" required>{{ old('reason') }}</textarea>
                    @error('reason')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane me-2"></i> Submit Application
                </button>
                <div class="text-center mt-3">
                    <a href="{{ route('student.leaves.index') }}" class="text-muted small text-decoration-none">Cancel and return</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
