@extends('layouts.admin')

@section('title', 'Edit Principal')

@section('content')
<div class="mb-4">
    <a href="{{ route('principals.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Principals</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Edit Principal: {{ $principal->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('principals.update', $principal) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $principal->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address (Used for Login)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $principal->email) }}" required>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label text-primary fw-bold mb-0">Assign Batches & Subjects</label>
                    <button type="button" id="toggleAll" class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.7rem;">Select All</button>
                </div>
                <div class="border rounded p-3 bg-light mb-3">
                    @if($batches->isEmpty())
                        <p class="text-muted mb-0 small">No batches available. Please create batches first.</p>
                    @else
                        <div class="accordion" id="batchAccordion">
                            @foreach($batches as $batch)
                                <div class="accordion-item border-0 mb-2 rounded shadow-sm">
                                    <h2 class="accordion-header" id="headingBatch{{ $batch->id }}">
                                        <div class="accordion-button collapsed bg-white rounded d-flex align-items-center p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBatch{{ $batch->id }}" aria-expanded="false" aria-controls="collapseBatch{{ $batch->id }}">
                                            <div class="form-check me-3" onclick="event.stopPropagation();">
                                                <input class="form-check-input batch-checkbox" type="checkbox" name="batches[]" value="{{ $batch->id }}" id="batch_{{ $batch->id }}" {{ $principal->batches->contains($batch->id) ? 'checked' : '' }}>
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
                                                                <input class="form-check-input subject-checkbox" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject_{{ $subject->id }}" data-batch-id="{{ $batch->id }}" {{ $principal->subjects->contains($subject->id) ? 'checked' : '' }} onclick="return false;" style="opacity: 0.7;">
                                                                <label class="form-check-label text-muted" for="subject_{{ $subject->id }}">
                                                                    {{ $subject->name }} <small>(Locked)</small>
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

            <button type="submit" class="btn btn-primary btn-modern"><i class="fas fa-save me-2"></i> Update Principal</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subjectCheckboxes = document.querySelectorAll('.subject-checkbox');
        const batchCheckboxes = document.querySelectorAll('.batch-checkbox');

        const toggleAllBtn = document.getElementById('toggleAll');

        let allSelected = false; // Initial state depends on existing selections
        toggleAllBtn.addEventListener('click', function() {
            allSelected = !allSelected;
            if (allSelected) {
                subjectCheckboxes.forEach(cb => cb.checked = true);
                batchCheckboxes.forEach(cb => cb.checked = true);
                this.innerText = 'Deselect All';
            } else {
                subjectCheckboxes.forEach(cb => cb.checked = false);
                batchCheckboxes.forEach(cb => cb.checked = false);
                this.innerText = 'Select All';
            }
        });

        // Subjects are locked, so we don't need the change listener for them to update batch
        
        batchCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const batchId = this.value;
                const childSubjects = document.querySelectorAll('.subject-checkbox[data-batch-id="' + batchId + '"]');
                if (this.checked) {
                    childSubjects.forEach(subject => {
                        subject.checked = true;
                    });
                } else {
                    childSubjects.forEach(subject => {
                        subject.checked = false;
                    });
                }
            });
        });
    });
</script>
@endpush
