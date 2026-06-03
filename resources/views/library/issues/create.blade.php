@extends('layouts.admin')

@section('title', 'Issue Book')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <a href="{{ route('library.issues.index') }}" class="btn btn-outline-secondary btn-sm btn-modern me-2">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
        <h4 class="fw-medium text-dark mb-1 d-inline-block align-middle">Issue Book</h4>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="fas fa-check-circle text-success fs-4"></i>
    <div><strong>Success!</strong> {{ session('success') }}</div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-4 p-lg-5">
                <form method="POST" action="{{ route('library.issues.store') }}">
                    @csrf

                    @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0 small">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Hidden member_id populated by JS --}}
                    <input type="hidden" name="member_id" id="member_id">

                    {{-- Member Type Selection --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Member Type <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="member_type" id="memberStudent" value="student" {{ old('member_type', 'student') === 'student' ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="memberStudent">
                                    <i class="fas fa-user-graduate text-primary me-1"></i> Student
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="member_type" id="memberStaff" value="staff" {{ old('member_type') === 'staff' ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="memberStaff">
                                    <i class="fas fa-user-tie text-info me-1"></i> Staff
                                </label>
                            </div>
                        </div>
                        @error('member_type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Student Selection --}}
                    <div id="studentSection" class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="batch_id" class="form-label fw-semibold">Batch <span class="text-danger">*</span></label>
                            <select name="batch_id" id="batch_id" class="form-select @error('batch_id') is-invalid @enderror">
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>{{ $batch->name }}</option>
                                @endforeach
                            </select>
                            @error('batch_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                            <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror">
                                <option value="">Select Student</option>
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Staff Selection --}}
                    <div id="staffSection" class="mb-3" style="display:none;">
                        <label for="staff_id" class="form-label fw-semibold">Staff Member <span class="text-danger">*</span></label>
                        <select name="staff_id" id="staff_id" class="form-select @error('staff_id') is-invalid @enderror">
                            <option value="">Select Staff</option>
                            @foreach($staffMembers as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->name }} ({{ $staff->email }})</option>
                            @endforeach
                        </select>
                        @error('staff_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Book Selection --}}
                    <div class="mb-3">
                        <label for="book_id" class="form-label fw-semibold">Book <span class="text-danger">*</span></label>
                        <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror">
                            <option value="">Select Book</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}
                                    data-available="{{ $book->available_copies }}">
                                    {{ $book->title }} — {{ $book->available_copies }} of {{ $book->total_copies }} available
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="availabilityInfo" class="small mt-1" style="display:none;"></div>
                    </div>

                    {{-- Date Fields --}}
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="issue_date" class="form-label fw-semibold">Issue Date <span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" id="issue_date" class="form-control @error('issue_date') is-invalid @enderror"
                                   value="{{ old('issue_date', date('Y-m-d')) }}">
                            @error('issue_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label fw-semibold">Due Date <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror"
                                   value="{{ old('due_date', date('Y-m-d', strtotime('+' . ($settings->max_borrow_days ?? 14) . ' days'))) }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Remarks --}}
                    <div class="mb-4">
                        <label for="remarks" class="form-label fw-semibold">Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="3" placeholder="Optional notes...">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-modern shadow-sm px-4" id="submitBtn">
                            <i class="fas fa-hand-holding me-2"></i> Issue Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const memberRadios = document.querySelectorAll('input[name="member_type"]');
    const studentSection = document.getElementById('studentSection');
    const staffSection = document.getElementById('staffSection');
    const batchSelect = document.getElementById('batch_id');
    const studentSelect = document.getElementById('student_id');
    const staffSelect = document.getElementById('staff_id');
    const memberIdInput = document.getElementById('member_id');
    const bookSelect = document.getElementById('book_id');
    const availabilityInfo = document.getElementById('availabilityInfo');

    const batchStudents = @json($batches->mapWithKeys(fn($b) => [$b->id => $b->students->map(fn($s) => ['id' => $s->id, 'name' => $s->name])]));

    function syncMemberId() {
        const selected = document.querySelector('input[name="member_type"]:checked')?.value;
        memberIdInput.value = selected === 'staff' ? (staffSelect.value || '') : (studentSelect.value || '');
    }

    function toggleMemberType() {
        const selected = document.querySelector('input[name="member_type"]:checked')?.value;
        if (selected === 'staff') {
            studentSection.style.display = 'none';
            staffSection.style.display = 'block';
            studentSelect.removeAttribute('required');
            batchSelect.removeAttribute('required');
        } else {
            studentSection.style.display = '';
            staffSection.style.display = 'none';
        }
        syncMemberId();
    }

    memberRadios.forEach(radio => radio.addEventListener('change', toggleMemberType));
    toggleMemberType();

    batchSelect.addEventListener('change', function() {
        const batchId = this.value;
        studentSelect.innerHTML = '<option value="">Select Student</option>';
        if (batchId && batchStudents[batchId]) {
            batchStudents[batchId].forEach(function(student) {
                const opt = document.createElement('option');
                opt.value = student.id;
                opt.textContent = student.name;
                studentSelect.appendChild(opt);
            });
        }
        syncMemberId();
    });

    studentSelect.addEventListener('change', syncMemberId);
    staffSelect.addEventListener('change', syncMemberId);

    // Restore old student_id if present
    @if(old('batch_id'))
        batchSelect.dispatchEvent(new Event('change'));
        setTimeout(() => {
            studentSelect.value = '{{ old('student_id') }}';
        }, 100);
    @endif

    // Book availability indicator
    bookSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const available = parseInt(selected.dataset.available);

        if (this.value && !isNaN(available)) {
            availabilityInfo.style.display = 'block';
            if (available > 0) {
                availabilityInfo.className = 'small mt-1 text-success';
                availabilityInfo.innerHTML = '<i class="fas fa-check-circle me-1"></i> ' + available + ' copies available';
            } else {
                availabilityInfo.className = 'small mt-1 text-danger';
                availabilityInfo.innerHTML = '<i class="fas fa-times-circle me-1"></i> No copies available';
            }
        } else {
            availabilityInfo.style.display = 'none';
        }
    });
});
</script>
@endpush
