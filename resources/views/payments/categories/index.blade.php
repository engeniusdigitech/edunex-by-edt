@extends('layouts.admin')

@section('title', 'Fee Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h4 class="fw-bold text-dark mb-1">Fee Categories</h4>
        <p class="text-muted small mb-0">Define custom fee types for your institute</p>
    </div>
    <button type="button" class="btn btn-primary btn-modern shadow-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        <i class="fas fa-plus-circle me-2"></i> Add Category
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
                        <th class="ps-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Category Name</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Description</th>
                        <th class="py-3 text-uppercase text-muted fw-semibold border-bottom-0" style="font-size: 0.75rem; letter-spacing: 1px;">Created At</th>
                        <th class="pe-4 py-3 text-uppercase text-muted fw-semibold border-bottom-0 text-end" style="font-size: 0.75rem; letter-spacing: 1px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="ps-4 py-4 fw-bold text-dark">{{ $category->name }}</td>
                        <td class="py-4 text-muted small">{{ $category->description ?? 'No description' }}</td>
                        <td class="py-4 text-muted small">{{ $category->created_at->format('M d, Y') }}</td>
                        <td class="pe-4 py-4 text-end">
                            <button class="btn btn-sm btn-light border rounded-pill px-3 me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editCategoryModal{{ $category->id }}">
                                <i class="fas fa-edit me-1 text-primary"></i> Edit
                            </button>
                            <form action="{{ route('fee-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                                <i class="fas fa-tags fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark">No categories found</h6>
                            <p class="text-muted small mb-0">Add your first fee category to get started.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection

@section('modals')
<!-- Create Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-black">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fee-categories.store') }}" method="POST">
                @csrf
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Category Name</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="e.g. Tuition Fee" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Brief description of this fee type..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 justify-content-center">
                    <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($categories as $category)
<!-- Edit Modal -->
<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-black">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('fee-categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Category Name</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" value="{{ $category->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3">{{ $category->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 justify-content-center">
                    <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Update Category</button>
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
</style>
