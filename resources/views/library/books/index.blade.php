@extends('layouts.admin')

@section('title', 'Books')

@section('content')

@if(session('success'))
<div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" role="alert">
    <i class="fas fa-check-circle text-success fs-4"></i>
    <div><strong>Success!</strong> {{ session('success') }}</div>
</div>
@endif

{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-medium text-dark mb-1">Books</h4>
        <p class="text-muted small mb-0">Manage your library book collection</p>
    </div>
    <a href="{{ route('library.books.create') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-plus me-2"></i> Add Book
    </a>
</div>

{{-- Filter Bar --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('library.books.index') }}" class="row g-2 align-items-end">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search title, ISBN..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="author_id" class="form-select">
                    <option value="">All Authors</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2 flex-wrap">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter me-1"></i> Filter</button>
                <a href="{{ route('library.books.index') }}" class="btn btn-outline-secondary btn-sm">Clear</a>
                <a href="{{ route('library.books.index', array_merge(request()->query(), ['export' => 'csv'])) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-file-csv me-1"></i> CSV</a>
                <a href="{{ route('library.books.index', array_merge(request()->query(), ['export' => 'excel'])) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-file-excel me-1"></i> Excel</a>
            </div>
        </form>
    </div>
</div>

{{-- Bulk Actions Toolbar --}}
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px;display:none;" id="bulkActionsBar">
    <div class="card-body p-3 d-flex align-items-center gap-3">
        <span class="fw-medium text-dark" style="font-size:0.85rem;"><span id="selectedCount">0</span> selected</span>
        <form method="POST" action="{{ route('library.books.bulk-delete') }}" id="bulkDeleteForm" onsubmit="return confirm('Are you sure you want to delete selected books?')">
            @csrf
            @method('DELETE')
            <input type="hidden" name="ids" id="bulkDeleteIds">
            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i> Delete Selected</button>
        </form>
    </div>
</div>

{{-- Books Table --}}
<div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="background-color:#F8FAFC;">
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;width:40px;">
                        <input type="checkbox" class="form-check-input" id="selectAll">
                    </th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Cover</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Title</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Author</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Category</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Copies</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Status</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 16px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td class="px-4 py-3">
                            <input type="checkbox" class="form-check-input book-checkbox" value="{{ $book->id }}">
                        </td>
                        <td class="py-3">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                    class="rounded" style="width:50px;height:50px;object-fit:cover;">
                            @else
                                <div class="rounded d-flex align-items-center justify-content-center"
                                    style="width:50px;height:50px;background:rgba(37,99,235,0.08);color:#2563EB;font-size:1rem;">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="fw-medium text-dark" style="font-size:0.85rem;">{{ Str::limit($book->title, 30) }}</div>
                            @if($book->isbn)
                                <div class="text-muted" style="font-size:0.72rem;font-family:monospace;">ISBN: {{ $book->isbn }}</div>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="text-dark" style="font-size:0.82rem;">{{ $book->author->name ?? '—' }}</div>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium" style="font-size:0.7rem;">{{ $book->category->name ?? '—' }}</span>
                        </td>
                        <td class="py-3">
                            <span class="fw-semibold {{ ($book->available_copies ?? 0) > 0 ? 'text-success' : 'text-danger' }}" style="font-size:0.85rem;">
                                {{ $book->available_copies ?? 0 }}/{{ $book->total_copies ?? 0 }}
                            </span>
                        </td>
                        <td class="py-3">
                            @if($book->status === 'active' || $book->status === 1)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Active</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3">
                            <div class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('library.books.show', $book) }}" class="btn btn-outline-primary btn-sm" title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('library.books.edit', $book) }}" class="btn btn-outline-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('library.books.print-qr', $book) }}" class="btn btn-outline-secondary btn-sm" title="Print QR" target="_blank"><i class="fas fa-qrcode"></i></a>
                                <a href="{{ route('library.books.print-barcode', $book) }}" class="btn btn-outline-secondary btn-sm" title="Print Barcode" target="_blank"><i class="fas fa-barcode"></i></a>
                                <form action="{{ route('library.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="d-inline-flex border p-4 rounded-circle mb-3 bg-light text-muted">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                            <h6 class="fw-medium text-dark">No books found</h6>
                            <p class="text-muted small mb-0">Start by adding books to your library collection.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-4">
    {{ $books->appends(request()->query())->links() }}
</div>

@endsection

@push('scripts')
<script>
    // Select All Checkbox Logic
    const selectAllCheckbox = document.getElementById('selectAll');
    const bookCheckboxes = document.querySelectorAll('.book-checkbox');
    const bulkActionsBar = document.getElementById('bulkActionsBar');
    const selectedCountEl = document.getElementById('selectedCount');
    const bulkDeleteIds = document.getElementById('bulkDeleteIds');

    function updateBulkActions() {
        const checked = document.querySelectorAll('.book-checkbox:checked');
        const count = checked.length;
        selectedCountEl.textContent = count;
        bulkActionsBar.style.display = count > 0 ? 'block' : 'none';

        const ids = Array.from(checked).map(cb => cb.value);
        bulkDeleteIds.value = JSON.stringify(ids);

        // Update select-all state
        selectAllCheckbox.checked = count > 0 && count === bookCheckboxes.length;
        selectAllCheckbox.indeterminate = count > 0 && count < bookCheckboxes.length;
    }

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            bookCheckboxes.forEach(cb => { cb.checked = this.checked; });
            updateBulkActions();
        });
    }

    bookCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkActions);
    });
</script>
@endpush
