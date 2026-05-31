@extends('layouts.admin')

@section('title', 'Publishers')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">Publishers</h4>
            <p class="text-muted mb-0">Manage library book publishers</p>
        </div>
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addPublisherModal">
            <i class="fas fa-plus me-2"></i>Add Publisher
        </button>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
        <i class="fas fa-check-circle text-success fs-4"></i>
        <div><strong>Success!</strong> {{ session('success') }}</div>
    </div>
    @endif

    <!-- Table Card -->
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color:#F8FAFC;">
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Name</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Email</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Phone</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Books</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publishers as $publisher)
                    <tr>
                        <td style="padding:14px 20px;">
                            <div class="fw-semibold text-dark">{{ $publisher->name }}</div>
                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">{{ $publisher->address }}</small>
                        </td>
                        <td style="padding:14px 20px;">
                            {{ $publisher->email ?: 'N/A' }}
                        </td>
                        <td style="padding:14px 20px;">
                            {{ $publisher->phone ?: 'N/A' }}
                        </td>
                        <td style="padding:14px 20px;">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium">
                                {{ $publisher->books_count ?? 0 }} Books
                            </span>
                        </td>
                        <td style="padding:14px 20px;">
                            @if($publisher->status ?? $publisher->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Active</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:14px 20px;" class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1 edit-publisher-btn"
                                data-bs-toggle="modal" 
                                data-bs-target="#editPublisherModal"
                                data-id="{{ $publisher->id }}"
                                data-name="{{ $publisher->name }}"
                                data-email="{{ $publisher->email }}"
                                data-phone="{{ $publisher->phone }}"
                                data-address="{{ $publisher->address }}"
                                data-status="{{ ($publisher->status ?? $publisher->is_active) ? '1' : '0' }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('library.publishers.destroy', $publisher->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this publisher?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-building fs-4 text-muted"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">No Publishers Found</h6>
                                <p class="text-muted mb-0">Get started by adding a new publisher.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($publishers) && $publishers->hasPages())
        <div class="card-footer bg-white border-top border-light p-3">
            {{ $publishers->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('modals')
<!-- Add Publisher Modal -->
<div class="modal fade" id="addPublisherModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Add Publisher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('library.publishers.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status" id="addPubStatus" value="1" checked>
                            <label class="form-check-label fw-semibold" for="addPubStatus">Active Status</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-sm">Save Publisher</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Publisher Modal -->
<div class="modal fade" id="editPublisherModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Edit Publisher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPublisherForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_pub_name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="edit_pub_email" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" id="edit_pub_phone" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" id="edit_pub_address" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status" id="edit_pub_status" value="1">
                            <label class="form-check-label fw-semibold" for="edit_pub_status">Active Status</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-sm">Update Publisher</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-publisher-btn');
    const editForm = document.getElementById('editPublisherForm');
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            
            editForm.action = `/library/publishers/${id}`;
            document.getElementById('edit_pub_name').value = this.dataset.name;
            document.getElementById('edit_pub_email').value = this.dataset.email || '';
            document.getElementById('edit_pub_phone').value = this.dataset.phone || '';
            document.getElementById('edit_pub_address').value = this.dataset.address || '';
            document.getElementById('edit_pub_status').checked = (this.dataset.status === '1');
        });
    });
});
</script>
@endpush
