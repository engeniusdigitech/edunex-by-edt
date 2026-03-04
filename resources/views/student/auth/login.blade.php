<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - EduNex</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary"><i class="fas fa-user-graduate"></i> Student Portal</h2>
                        <p class="text-muted">Sign in to view your attendance and payments</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger pb-0">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('student.login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-secondary fw-semibold">Student Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-start-0 bg-light" value="{{ old('email') }}" required autofocus placeholder="student@example.com">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0 bg-light" required placeholder="••••••••">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" for="remember">Remember me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold text-uppercase rounded-3 shadow-sm">
                            Access Portal <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                </div>
                <div class="text-center mt-3 text-white-50">
                    <small>&copy; {{ date('Y') }} EduNex Systems</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
