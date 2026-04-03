@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
<div class="row g-4">
    <div class="col-xl-4">
        <!-- Profile Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="bg-primary bg-opacity-10 py-5 text-center px-4">
                    <div class="position-relative d-inline-block mb-4">
                        <img src="{{ auth()->user()->profile_image_url }}" 
                             alt="Profile" 
                             id="profile-preview"
                             class="rounded-circle shadow-sm border border-4 border-white"
                             style="width: 140px; height: 140px; object-fit: cover;">
                        
                        @if(!auth()->user()->isTeacher() && !auth()->user()->isReceptionist())
                            <label for="profile_image_input" 
                                   class="position-absolute bottom-0 end-0 bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center p-2 mb-1 me-1 cursor-pointer hover-translate transition-all"
                                   style="width: 36px; height: 36px;">
                                <i class="fas fa-camera text-primary small"></i>
                            </label>
                        @endif
                    </div>
                    <h4 class="fw-bold mb-1 text-dark">{{ auth()->user()->name }}</h4>
                    <div class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill mb-0">
                        <i class="fas fa-shield-alt me-1"></i> {{ auth()->user()->role->name }}
                    </div>
                </div>
                
                <div class="p-4 bg-white">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-light p-3 rounded-3 text-secondary">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-muted small mb-0 fw-semibold text-uppercase">Email Address</p>
                            <p class="text-dark fw-bold mb-0 text-truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-0">
                        <div class="bg-light p-3 rounded-3 text-secondary">
                            <i class="fas fa-calendar-check fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0 fw-semibold text-uppercase">Member Since</p>
                            <p class="text-dark fw-bold mb-0">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        @if(session('status') === 'profile-updated')
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                <i class="fas fa-check-circle me-2"></i> Profile details updated successfully.
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                <ul class="mb-0 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('patch')
            <input type="file" name="profile_image" id="profile_image_input" class="d-none" accept="image/*">

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-4 border-0">
                    <h5 class="fw-bold mb-0"><i class="fas fa-user-edit text-primary me-2"></i> Personal Details</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                   class="form-control border-0 bg-light py-2 rounded-3 shadow-none fw-semibold" required
                                   {{ (auth()->user()->isTeacher() || auth()->user()->isReceptionist()) ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                   class="form-control border-0 bg-light py-2 rounded-3 shadow-none fw-semibold" required
                                   {{ (auth()->user()->isTeacher() || auth()->user()->isReceptionist()) ? 'readonly' : '' }}>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->isTeacher())
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white py-4 border-0">
                        <h5 class="fw-bold mb-0 text-indigo"><i class="fas fa-graduation-cap me-2"></i> Academic Assignments</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        @if(auth()->user()->isClassTeacher())
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Primary Responsibility</label>
                                @foreach(auth()->user()->managedBatches as $batch)
                                    <div class="d-flex align-items-center justify-content-between bg-primary bg-opacity-10 p-3 rounded-4 mb-2">
                                        <div>
                                            <span class="badge bg-primary mb-1">Class Teacher</span>
                                            <h6 class="fw-bold mb-0 text-dark">{{ $batch->name }}</h6>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="fab fa-whatsapp me-1"></i> Chat Class
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="row g-4 mt-1">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Allotted Subjects</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse(auth()->user()->subjects as $subject)
                                        <span class="badge bg-light text-dark border py-2 px-3 rounded-3 fw-semibold">
                                            <i class="fas fa-book text-muted me-1"></i> {{ $subject->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted small italic">No subjects assigned yet.</span>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Allotted Classes/Batches</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse(auth()->user()->batches as $batch)
                                        <span class="badge bg-light text-dark border py-2 px-3 rounded-3 fw-semibold">
                                            <i class="fas fa-users text-muted me-1"></i> {{ $batch->name }}
                                        </span>
                                    @empty
                                        <span class="text-muted small italic">No classes assigned yet.</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(!auth()->user()->isTeacher() && !auth()->user()->isReceptionist())
                <div class="d-flex justify-content-end gap-3 mb-5">
                    <button type="submit" class="btn btn-primary btn-modern px-5 py-2 shadow-sm rounded-3">
                        <i class="fas fa-save me-2"></i> Update Profile
                    </button>
                </div>
            @endif
        </form>

        {{-- Security Section --}}
        @if(!auth()->user()->isTeacher() && !auth()->user()->isReceptionist())
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-4 border-0">
                    <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-lock me-2"></i> Account Security</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <p class="text-muted small">Update your password to keep your account secure. Ensure you use a strong, unique password.</p>
                    <form method="post" action="{{ route('password.update') }}" class="row g-4">
                        @csrf
                        @method('put')
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Current Password</label>
                            <input type="password" name="current_password" class="form-control border-0 bg-light py-2 rounded-3 shadow-none">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">New Password</label>
                            <input type="password" name="password" class="form-control border-0 bg-light py-2 rounded-3 shadow-none">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control border-0 bg-light py-2 rounded-3 shadow-none">
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-danger btn-modern px-5 py-2 rounded-3 shadow-none">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('profile_image_input').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endpush

<style>
    .cursor-pointer { cursor: pointer; }
    .transition-all { transition: all 0.3s ease; }
    .hover-translate:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important; }
    .bg-light { background-color: #F8FAFC !important; }
</style>
@endsection
