@extends('layouts.admin')

@section('title', 'Add Student')

@section('content')
<div class="mb-4">
    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Directory</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Register New Student</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="John Doe">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="john@example.com">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required placeholder="+91 9876543210">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Enrollment Date</label>
                    <input type="date" name="enrollment_date" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign Batch</label>
                <!-- Usually you'd fetch active batches from the controller -->
                <select name="batch_id" class="form-select" required>
                    <option value="">Select a Batch</option>
                    @foreach(\App\Models\Batch::all() as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }} ({{ $batch->schedule_time }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Student</button>
        </form>
    </div>
</div>
@endsection
