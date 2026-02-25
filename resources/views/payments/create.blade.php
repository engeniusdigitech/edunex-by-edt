@extends('layouts.admin')

@section('title', 'Record Payment')

@section('content')
<div class="mb-4">
    <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Ledger</a>
</div>

<div class="card border-0 shadow-sm col-md-8">
    <div class="card-header bg-white">
        <h5>Register New Payment</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Student</label>
                <select name="student_id" class="form-select" required>
                    <option value="">Select Student...</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->phone }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fee Structure Category</label>
                <select name="fee_structure_id" class="form-select" required>
                    <option value="">Select Fee Type...</option>
                    @foreach($feeStructures as $fee)
                        <option value="{{ $fee->id }}">{{ $fee->name }} (Total: ₹{{ $fee->total_amount }})</option>
                    @endforeach
                </select>
                @if($feeStructures->isEmpty())
                    <small class="text-danger mt-1">No fee structures defined. You may need to create one first.</small>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Paid (₹)</label>
                    <input type="number" step="0.01" name="amount_paid" class="form-control" required placeholder="5000.00">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Payment</label>
                    <input type="date" name="payment_date" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label d-block">Payment Method</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" checked>
                    <label class="form-check-label" for="cash">Cash</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                    <label class="form-check-label" for="online">Online (Razorpay Sim)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                    <label class="form-check-label" for="bank_transfer">Bank Transfer</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100"><i class="fas fa-check"></i> Complete Transaction</button>
        </form>
    </div>
</div>
@endsection
