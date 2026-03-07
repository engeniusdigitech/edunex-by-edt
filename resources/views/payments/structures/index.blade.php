@extends('layouts.admin')

@section('title', 'Fee Structures')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Fee Structures</h4>
        <p class="text-muted small mb-0">Manage exact fee amounts tied to categories</p>
    </div>
    <button type="button" class="btn btn-primary btn-modern shadow-sm" data-bs-toggle="modal" data-bs-target="#createStructureModal">
        <i class="fas fa-plus-circle me-2"></i> Create Structure
    </button>
</div>

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 mb-4">
    <i class="fas fa-check-circle text-success me-2"></i> {{ session('success') }}
</div>
@endif

<div class="card border-0 bg-white shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-decoration-none">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Fee Name</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Category</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Amount</th>
                        <th class="pe-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-end" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($structures as $structure)
                    <tr>
                        <td class="ps-4 py-4 fw-bold text-dark">{{ $structure->name }}</td>
                        <td class="py-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-1">
                                {{ $structure->category->name ?? 'General' }}
                            </span>
                        </td>
                        <td class="py-4 fw-black text-dark fs-5" style="font-family: monospace;">₹{{ number_format($structure->total_amount, 2) }}</td>
                        <td class="pe-4 py-4 text-end">
                            <button class="btn btn-sm btn-light border rounded-pill px-3 me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editStructureModal{{ $structure->id }}">
                                <i class="fas fa-edit me-1 text-primary"></i> Edit
                            </button>
                            <form action="{{ route('fee-structures.destroy', $structure) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this structure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3">
                                    <i class="fas fa-trash me-1 text-danger"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-sitemap fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No structures found</h6>
                            <p class="text-muted small mb-0">Create your first fee structure to start collecting payments.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $structures->links() }}
</div>
@endsection

@section('modals')
<!-- Create Modal -->
<div class="modal fade" id="createStructureModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-black">Create New Structure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fee-structures.store') }}" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Fee Category</label>
                        <select name="fee_category_id" class="form-select rounded-3" required>
                            <option value="">Select Category...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @if($categories->isEmpty())
                            <small class="text-danger">Please create a <a href="{{ route('fee-categories.index') }}">Fee Category</a> first.</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Structure Name</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="e.g. FY 2024 - Std 10 Tuition" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Total Amount (₹)</label>
                        <input type="number" step="0.01" name="total_amount" class="form-control rounded-3" placeholder="25000.00" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Optional details..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 justify-content-center">
                    <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Save Structure</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($structures as $structure)
<!-- Edit Modal -->
<div class="modal fade" id="editStructureModal{{ $structure->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-black">Edit Structure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fee-structures.update', $structure) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Fee Category</label>
                        <select name="fee_category_id" class="form-select rounded-3" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $structure->fee_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Structure Name</label>
                        <input type="text" name="name" class="form-control rounded-3" value="{{ $structure->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Total Amount (₹)</label>
                        <input type="number" step="0.01" name="total_amount" class="form-control rounded-3" value="{{ $structure->total_amount }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3">{{ $structure->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 justify-content-center">
                    <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Update Structure</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

<style>
    .btn-modern { border-radius: 50px; padding: 10px 24px; font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .btn-modern:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2); }
    .fw-black { font-weight: 900; }
</style>
