@extends('layouts.admin')

@section('title', 'Add Book')

@section('content')

{{-- Back Button --}}
<div class="mb-4">
    <a href="{{ route('library.books.index') }}" class="btn btn-outline-secondary btn-sm btn-modern">
        <i class="fas fa-arrow-left me-2"></i> Back to Books
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-semibold text-dark mb-1">Add New Book</h5>
                <p class="text-muted small mb-0">Fill in the details to add a new book to the library</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('library.books.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Row 1: Title & ISBN --}}
                    <div class="row mb-3">
                        <div class="col-md-8 mb-3 mb-md-0">
                            <label for="title" class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" placeholder="Enter book title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="isbn" class="form-label fw-medium">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                value="{{ old('isbn') }}" placeholder="e.g. 978-3-16-148410-0">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 2: Category, Author, Publisher --}}
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="category_id" class="form-label fw-medium">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="author_id" class="form-label fw-medium">Author <span class="text-danger">*</span></label>
                            <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror" required>
                                <option value="">-- Select Author --</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="publisher_id" class="form-label fw-medium">Publisher</label>
                            <select name="publisher_id" id="publisher_id" class="form-select @error('publisher_id') is-invalid @enderror">
                                <option value="">-- Select Publisher --</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 3: Edition, Language, Rack Number --}}
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="edition" class="form-label fw-medium">Edition</label>
                            <input type="text" name="edition" id="edition" class="form-control @error('edition') is-invalid @enderror"
                                value="{{ old('edition') }}" placeholder="e.g. 3rd Edition">
                            @error('edition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="language" class="form-label fw-medium">Language</label>
                            <input type="text" name="language" id="language" class="form-control @error('language') is-invalid @enderror"
                                value="{{ old('language') }}" placeholder="e.g. English">
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="rack_number" class="form-label fw-medium">Rack Number</label>
                            <input type="text" name="rack_number" id="rack_number" class="form-control @error('rack_number') is-invalid @enderror"
                                value="{{ old('rack_number') }}" placeholder="e.g. A-12">
                            @error('rack_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 4: Description --}}
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="description" class="form-label fw-medium">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="4" placeholder="Enter a brief description of the book...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 5: Total Copies, Cover Image, Status --}}
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="total_copies" class="form-label fw-medium">Total Copies <span class="text-danger">*</span></label>
                            <input type="number" name="total_copies" id="total_copies" class="form-control @error('total_copies') is-invalid @enderror"
                                value="{{ old('total_copies', 1) }}" min="1" required>
                            @error('total_copies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label for="cover_image" class="form-label fw-medium">Cover Image</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror"
                                accept="image/*">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="imagePreview" class="mt-2" style="display:none;">
                                <img id="previewImg" src="" alt="Preview" class="rounded" style="width:80px;height:100px;object-fit:cover;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
                                    {{ old('status', 1) ? 'checked' : '' }} style="width:3em;height:1.5em;">
                                <label class="form-check-label ms-2 fw-medium" for="status">Active</label>
                            </div>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-end pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-modern shadow-sm">
                            <i class="fas fa-save me-2"></i> Save Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Image Preview on File Select
    document.getElementById('cover_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewDiv = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                previewImg.src = ev.target.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewDiv.style.display = 'none';
            previewImg.src = '';
        }
    });
</script>
@endpush
