@extends('layouts.admin')

@section('title', 'Book Authors')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-dark">Book Authors</h4>
            <p class="text-muted mb-0">Manage library book authors</p>
        </div>
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAuthorModal">
            <i class="fas fa-plus me-2"></i>Add Author
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
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Biography</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Books</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                        <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                    <tr>
                        <td style="padding:14px 20px;">
                            <div class="fw-semibold text-dark">{{ $author->name }}</div>
                        </td>
                        <td style="padding:14px 20px;">
                            <span class="text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                {{ $author->biography ?: 'N/A' }}
                            </span>
                        </td>
                        <td style="padding:14px 20px;">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium">
                                {{ $author->books_count ?? 0 }} Books
                            </span>
                        </td>
                        <td style="padding:14px 20px;">
                            @if($author->status ?? $author->is_active)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Active</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:14px 20px;" class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1 edit-author-btn"
                                data-bs-toggle="modal" 
                                data-bs-target="#editAuthorModal"
                                data-id="{{ $author->id }}"
                                data-name="{{ $author->name }}"
                                data-biography="{{ $author->biography }}"
                                data-status="{{ ($author->status ?? $author->is_active) ? '1' : '0' }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('library.authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this author?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: #F1F5F9; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-edit fs-4 text-muted"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">No Authors Found</h6>
                                <p class="text-muted mb-0">Get started by adding a new author.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($authors) && $authors->hasPages())
        <div class="card-footer bg-white border-top border-light p-3">
            {{ $authors->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('modals')
<!-- Add Author Modal -->
<div class="modal fade" id="addAuthorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Add Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('library.authors.store') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Biography</label>
                        <textarea name="biography" rows="4" class="form-control @error('biography') is-invalid @enderror">{{ old('biography') }}</textarea>
                        @error('biography')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status" id="addStatus" value="1" checked>
                            <label class="form-check-label fw-semibold" for="addStatus">Active Status</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-sm">Save Author</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Author Modal -->
<div class="modal fade" id="editAuthorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">Edit Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAuthorForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Biography</label>
                        <textarea name="biography" id="edit_biography" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="status" id="edit_status" value="1">
                            <label class="form-check-label fw-semibold" for="edit_status">Active Status</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-sm">Update Author</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-author-btn');
    const editForm = document.getElementById('editAuthorForm');
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const bio = this.dataset.biography;
            const status = this.dataset.status;
            
            editForm.action = `/library/authors/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_biography').value = bio || '';
            document.getElementById('edit_status').checked = (status === '1');
        });
    });
});
</script>
@endpush
