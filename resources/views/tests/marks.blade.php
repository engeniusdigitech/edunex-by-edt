@extends('layouts.admin')

@section('title', 'Enter Marks')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('tests.index') }}" class="btn btn-light rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left text-secondary"></i>
    </a>
    <div>
        <h4 class="mb-0 fw-bold">Enter Marks: {{ $test->title }}</h4>
        <p class="text-muted small mb-0 mt-1">
            <span class="badge bg-secondary bg-opacity-10 text-secondary me-2">{{ $test->batch->name }}</span>
            <i class="fas fa-calendar-alt me-1"></i> {{ $test->test_date->format('d M, Y') }} 
            <span class="ms-3"><i class="fas fa-bullseye me-1"></i> Total Marks: <strong>{{ $test->total_marks }}</strong></span>
        </p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-4">
    <div class="p-4 bg-light bg-opacity-50 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-users text-primary me-2"></i> Student List</h5>
        <span class="badge bg-primary rounded-pill px-3 py-2">{{ $test->batch->students->count() }} Students</span>
    </div>
    
    <div class="card-body p-0">
        @if($test->batch->students->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-user-graduate fs-1 text-muted opacity-25 mb-3"></i>
                <h6 class="fw-semibold text-secondary">No students found in this batch.</h6>
            </div>
        @else
            <form action="{{ route('tests.store_marks', $test) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 px-4 py-3" style="width: 60px;">#</th>
                                <th class="border-0 px-4 py-3">Student Name</th>
                                <th class="border-0 px-4 py-3" style="width: 250px;">Score (Max: {{ $test->total_marks }})</th>
                                <th class="border-0 px-4 py-3">Remarks / Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($test->batch->students as $index => $student)
                                @php
                                    $existingScore = $scores->get($student->id);
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 text-muted fw-semibold">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 fw-bold text-dark">
                                        {{ $student->name }}
                                        <div class="small fw-normal text-muted">{{ $student->email }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="input-group">
                                            <input type="number" 
                                                   name="scores[{{ $student->id }}][score]" 
                                                   class="form-control text-center fw-bold" 
                                                   value="{{ old('scores.'.$student->id.'.score', $existingScore?->score) }}" 
                                                   min="0" 
                                                   max="{{ $test->total_marks }}" 
                                                   step="0.01"
                                                   aria-label="Score">
                                            <span class="input-group-text bg-light border-start-0 text-muted">/ {{ $test->total_marks }}</span>
                                        </div>
                                        @error('scores.'.$student->id.'.score')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" 
                                               name="scores[{{ $student->id }}][remarks]" 
                                               class="form-control bg-light border-0" 
                                               value="{{ old('scores.'.$student->id.'.remarks', $existingScore?->remarks) }}" 
                                               placeholder="Optional notes...">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 bg-light bg-opacity-50 border-top text-end">
                    <button type="submit" class="btn btn-primary-glow btn-modern px-5 py-2 fs-6">
                        <i class="fas fa-save me-2"></i> Save All Marks
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
