@extends('student.layouts.app')

@section('title', 'Library')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold">Library</h4>
        <a href="{{ route('student.library.my-books') }}" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="fas fa-book-reader me-1"></i> My Books
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

    <!-- Search & Filter -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('student.library.index') }}" method="GET" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search title, author, ISBN..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\Library\Category::active()->orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('student.library.index') }}" class="btn btn-light w-100 rounded-pill">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="row g-4">
        @forelse($books as $book)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden library-card">
                    <div class="position-relative">
                        <img src="{{ $book->cover_image_url }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $book->title }}">
                        <div class="position-absolute top-0 end-0 p-2">
                            @if($book->is_available)
                                <span class="badge bg-success shadow-sm rounded-pill"><i class="fas fa-check-circle me-1"></i> Available ({{ $book->available_copies }})</span>
                            @else
                                <span class="badge bg-danger shadow-sm rounded-pill"><i class="fas fa-times-circle me-1"></i> Issued Out</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">{{ $book->category?->name ?? 'Uncategorized' }}</span>
                        </div>
                        <h6 class="card-title fw-bold text-dark mb-1 line-clamp-2">{{ $book->title }}</h6>
                        <p class="card-text text-muted small mb-3">By {{ $book->author?->name ?? 'Unknown Author' }}</p>
                        
                        <div class="mt-auto">
                            <form action="{{ route('student.library.reserve', $book) }}" method="POST">
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
            <div class="col-12">
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-book-open fs-1 mb-3 opacity-50"></i>
                    <h5>No books found</h5>
                    <p>Try adjusting your search filters.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $books->withQueryString()->links() }}
    </div>
</div>

<style>
    .library-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .library-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
