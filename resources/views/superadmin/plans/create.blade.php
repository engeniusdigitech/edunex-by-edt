@extends('layouts.admin')

@section('title', 'Add Plan')

@section('content')
<div class="mb-4">
    <a href="{{ route('superadmin.plans.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back to Plans</a>
</div>

<div class="card col-md-6">
    <div class="card-header bg-white">
        <h5>Create Subscription Plan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('superadmin.plans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Plan Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Pro Monthly">
            </div>
            <div class="mb-3">
                <label class="form-label">Price (₹)</label>
                <input type="number" step="0.01" name="price" class="form-control" required placeholder="999.00">
            </div>
            <div class="mb-3">
                <label class="form-label">Duration (Days)</label>
                <input type="number" name="duration_days" class="form-control" required placeholder="30">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                <label class="form-check-label" for="isActive">
                    Acitve (Available for subscriptions)
                </label>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Plan</button>
        </form>
    </div>
</div>
@endsection
