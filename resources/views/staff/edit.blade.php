@extends('layouts.admin')

@section('title', 'Edit Staff Member')

@section('content')
<div class="mb-4">
    <a href="{{ route('staff.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Staff Directory</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Edit Staff Member: {{ $staff->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('staff.update', $staff) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $staff->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address (Used for Login)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $staff->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role_id" class="form-select" required id="roleSelect">
                    <option value="">Select Role...</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $staff->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" id="teacherOptionsContainer" style="{{ $staff->isTeacher() ? '' : 'display: none;' }}">
                <label class="form-label">Assign Subjects & Batches (For Teachers)</label>
                <div class="border rounded p-3 bg-light mb-3">
                    <h6 class="text-secondary fw-bold mb-3">Subjects</h6>
                    @if($subjects->isEmpty())
                        <p class="text-muted mb-0 small">No subjects available. Please create subjects first.</p>
                    @else
                        <div class="row">
                            @foreach($subjects as $subject)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject_{{ $subject->id }}" {{ $staff->subjects->contains($subject->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="subject_{{ $subject->id }}">
                                            {{ $subject->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="border rounded p-3 bg-light">
                    <h6 class="text-secondary fw-bold mb-3">Batches</h6>
                    @if($batches->isEmpty())
                        <p class="text-muted mb-0 small">No batches available. Please create batches first.</p>
                    @else
                        <div class="row">
                            @foreach($batches as $batch)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="batches[]" value="{{ $batch->id }}" id="batch_{{ $batch->id }}" {{ $staff->batches->contains($batch->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="batch_{{ $batch->id }}">
                                            {{ $batch->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <hr>
            <h6 class="mb-3">Change Password <small class="text-muted fw-normal">(Leave blank to keep current)</small></h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Staff Member</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('roleSelect');
        const teacherOptionsContainer = document.getElementById('teacherOptionsContainer');
        
        function toggleSubjects() {
            if (!roleSelect || roleSelect.selectedIndex === -1) return;
            
            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            if (!selectedOption) return;
            
            const selectedText = selectedOption.text.trim();
            
            if (selectedText === 'Teacher') {
                teacherOptionsContainer.style.display = 'block';
            } else {
                teacherOptionsContainer.style.display = 'none';
            }
        }

        roleSelect.addEventListener('change', toggleSubjects);
        toggleSubjects(); // Initialize on load
    });
</script>
@endpush
