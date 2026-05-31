@extends('layouts.admin')

@section('title', 'Library')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Library</h4>
    <a href="{{ route('teacher.library.my-books') }}" class="btn btn-primary btn-modern shadow-sm">
        <i class="fas fa-book-reader me-2"></i>My Borrowed Books
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success bg-white border border-success border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4">
        <i class="fas fa-check-circle text-success fs-4"></i>
        <div>{{ session('success') }}</div>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger bg-white border border-danger border-start-0 border-end-0 border-bottom-0 border-top-4 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4">
        <i class="fas fa-exclamation-circle text-danger fs-4"></i>
        <div>{{ session('error') }}</div>
    </div>
@endif

<!-- Filter Bar -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('teacher.library.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Search by title, author, ISBN..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Library\Category::active()->orderBy('name')->get() as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button class="btn btn-primary btn-sm flex-fill">Search</button>
                <a href="{{ route('teacher.library.index') }}" class="btn btn-outline-secondary btn-sm flex-fill">Clear</a>
            </div>
        </form>
    </div>
</div>

<!-- Books Grid -->
<div class="row g-4">
    @forelse($books as $book)
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius:16px; transition: transform 0.2s;">
                <div class="position-relative">
                    <img src="{{ $book->cover_image_url }}" class="card-img-top object-fit-cover" style="height: 220px; border-top-left-radius:16px; border-top-right-radius:16px;" alt="{{ $book->title }}">
                    <div class="position-absolute top-0 end-0 p-2">
                        @if($book->is_available)
                            <span class="badge bg-success shadow-sm rounded-pill"><i class="fas fa-check me-1"></i> Available</span>
                        @else
                            <span class="badge bg-danger shadow-sm rounded-pill"><i class="fas fa-times me-1"></i> Issued Out</span>
                        @endif
                    </div>
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <div class="mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1">{{ $book->category?->name ?? 'Uncategorized' }}</span>
                    </div>
                    <h6 class="card-title fw-bold text-dark mb-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $book->title }}</h6>
                    <p class="card-text text-muted small mb-3">By {{ $book->author?->name ?? 'Unknown Author' }}</p>
                    
                    <div class="mt-auto pt-3 border-top">
                        <form action="{{ route('teacher.library.reserve', $book) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100 rounded-pill" {{ !$book->is_available ? 'disabled' : '' }}>
                                <i class="fas fa-bookmark me-1"></i> Reserve Book
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <i class="fas fa-book-open fs-1 mb-3 opacity-25"></i>
                <h5>No books found</h5>
                <p>Try adjusting your search criteria.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $books->withQueryString()->links() }}
</div>
@endsection
