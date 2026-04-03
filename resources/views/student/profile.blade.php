<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile — {{ $student->institute->name }}</title>
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

        .brand-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.1;
        }

        .brand-sub {
            font-size: 0.62rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .container-tight {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--indigo), var(--indigo-dark));
            border-radius: var(--radius);
            padding: 40px;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::after {
            content: "\f19d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 10rem;
            opacity: 0.1;
            transform: rotate(-15deg);
        }

        .profile-img-container {
            width: 120px;
            height: 120px;
            position: relative;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            border-radius: 30px;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .img-edit-btn {
            position: absolute;
            bottom: -5px;
            right: -5px;
            width: 32px;
            height: 32px;
            background: #fff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--indigo);
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }

        .img-edit-btn:hover {
            transform: scale(1.1);
        }

        .card-custom {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid var(--border);
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
            background: #fcfdfe;
        }

        .form-control:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background: #fff;
        }

        .back-btn {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: var(--indigo);
        }

        .btn-save {
            background: var(--indigo);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            color: #fff;
            transition: all 0.2s;
        }

        .btn-save:hover {
            background: var(--indigo-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .batch-info-tag {
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body>
    <header class="top-navbar">
        <a href="{{ route('student.dashboard') }}" class="nav-brand">
            @if($student->institute && $student->institute->logo)
                <img src="{{ asset('storage/' . $student->institute->logo) }}" alt="Logo" style="max-height: 36px; border-radius: 8px;">
            @else
                <div class="brand-name">{{ $student->institute->name ?? 'EduNex' }}</div>
            @endif
            <div>
                <div class="brand-name">My Profile</div>
                <div class="brand-sub">View your identity</div>
            </div>
        </a>
        <div class="nav-right">
            <a href="{{ route('student.dashboard') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold">
                <i class="fas fa-home me-1"></i> Dashboard
            </a>
        </div>
    </header>

    <div class="container-tight">
        <a href="{{ route('student.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="profile-header">
            <div class="d-flex align-items-center gap-4 flex-wrap flex-sm-nowrap">
                <div class="profile-img-container">
                    <img src="{{ $student->profile_image_url }}" alt="Profile" class="profile-img" id="display-img">
                </div>
                <div>
                    <h2 class="mb-2 fw-bold">{{ $student->name }}</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <div class="batch-info-tag">
                            <i class="fas fa-users"></i> {{ $student->batch->name ?? 'No Batch' }}
                        </div>
                        <div class="batch-info-tag">
                            <i class="fas fa-id-card"></i> ID: #{{ str_pad($student->id, 5, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_image" id="profile_image_input" class="d-none" accept="image/*">
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control bg-light" value="{{ $student->email }}" disabled>
                            <p class="text-muted mt-2 mb-0" style="font-size: 0.75rem;">Email cannot be changed.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Enrolled Since</label>
                            <input type="text" class="form-control bg-light" value="{{ $student->enrollment_date->format('d M Y') }}" disabled>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="opacity: 0.1;">

                <div class="d-flex justify-content-center align-items-center p-3 bg-light rounded-4 border">
                    <p class="text-muted mb-0 small fw-medium text-center">
                        <i class="fas fa-info-circle me-1"></i> Profile editing is managed by the administration. Please contact your coordinator for any changes.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('profile_image_input').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('display-img').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</body>

</html>
