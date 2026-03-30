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
                <label class="form-label fw-bold"><i class="fas fa-chalkboard-teacher me-1"></i> Class Teacher Appointment</label>
                <div class="border rounded p-3 bg-light mb-4">
                    <p class="small text-muted mb-3">Select batches for which this teacher will be the **Main Class Teacher**. These batches will see this teacher's attendance and class details.</p>
                    @if($unassignedBatches->isEmpty())
                        <div class="alert alert-info py-2 px-3 small mb-0">
                            <i class="fas fa-info-circle me-1"></i> All active batches already have a class teacher assigned.
                        </div>
                    @else
                        <div class="row">
                            @php $managedBatchIds = $staff->managedBatches->pluck('id')->toArray(); @endphp
                            @foreach($unassignedBatches as $batch)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check p-2 border rounded bg-white shadow-sm">
                                        <input class="form-check-input ms-0 me-2" type="checkbox" name="class_teacher_batches[]" value="{{ $batch->id }}" id="class_teacher_{{ $batch->id }}" {{ in_array($batch->id, $managedBatchIds) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="class_teacher_{{ $batch->id }}">
                                            {{ $batch->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <label class="form-label fw-bold"><i class="fas fa-book-reader me-1"></i> Subject & Batch Access</label>
                <div class="border rounded p-3 bg-light mb-3">
                    <p class="small text-muted mb-3">Select batches and specific subjects this teacher is allowed to teach and access.</p>
                    @if($batches->isEmpty())
                        <p class="text-muted mb-0 small">No batches available. Please create batches first.</p>
                    @else
                        <div class="accordion" id="batchAccordion">
                            @foreach($batches as $batch)
                                <div class="accordion-item border-0 mb-2 rounded shadow-sm">
                                    <h2 class="accordion-header" id="headingBatch{{ $batch->id }}">
                                        <div class="accordion-button collapsed bg-white rounded d-flex align-items-center p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBatch{{ $batch->id }}" aria-expanded="false" aria-controls="collapseBatch{{ $batch->id }}">
                                            <div class="form-check me-3" onclick="event.stopPropagation();">
                                                <input class="form-check-input batch-checkbox" type="checkbox" name="batches[]" value="{{ $batch->id }}" id="batch_{{ $batch->id }}" {{ $staff->batches->contains($batch->id) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="batch_{{ $batch->id }}" style="cursor: pointer;">
                                                    {{ $batch->name }}
                                                </label>
                                            </div>
                                            <span class="badge bg-secondary rounded-pill ms-auto">{{ $batch->subjects->count() }} Subjects</span>
                                        </div>
                                    </h2>
                                    <div id="collapseBatch{{ $batch->id }}" class="accordion-collapse collapse" aria-labelledby="headingBatch{{ $batch->id }}" data-bs-parent="#batchAccordion">
                                        <div class="accordion-body bg-light border-top pt-3 pb-2">
                                            @if($batch->subjects->isEmpty())
                                                <p class="text-muted small mb-0 ms-4"><i class="fas fa-info-circle me-1"></i> No active subjects found for this batch.</p>
                                            @else
                                                <div class="row ms-3">
                                                    @foreach($batch->subjects as $subject)
                                                        <div class="col-md-6 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input subject-checkbox" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject_{{ $subject->id }}" data-batch-id="{{ $batch->id }}" {{ $staff->subjects->contains($subject->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="subject_{{ $subject->id }}">
                                                                    {{ $subject->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
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

        // Hierarchical Checkbox Logic
        const subjectCheckboxes = document.querySelectorAll('.subject-checkbox');
        const batchCheckboxes = document.querySelectorAll('.batch-checkbox');

        // When a subject is checked, ensure its parent batch is also checked
        subjectCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    const batchId = this.dataset.batchId;
                    const parentBatchCheckbox = document.getElementById('batch_' + batchId);
                    if (parentBatchCheckbox && !parentBatchCheckbox.checked) {
                        parentBatchCheckbox.checked = true;
                    }
                }
            });
        });

        // When a batch is unchecked, optionally uncheck all its child subjects
        batchCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    const batchId = this.value;
                    const childSubjects = document.querySelectorAll('.subject-checkbox[data-batch-id="' + batchId + '"]');
                    childSubjects.forEach(subject => {
                        subject.checked = false;
                    });
                }
            });
        });
    });
</script>
@endpush
