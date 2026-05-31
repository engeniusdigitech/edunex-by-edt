@extends('layouts.admin')
@section('title', 'Upload Digital Resource')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: #1E293B; font-weight: 700;">Upload Resource</h4>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Add a new digital file to the library</p>
        </div>
        <div>
            <a href="{{ route('library.digital-resources.index') }}" class="btn btn-outline-secondary btn-modern shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius:16px;">
                <div class="card-body p-4">
                    <form action="{{ route('library.digital-resources.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Link to Book (Optional)</label>
                                <select name="book_id" class="form-select @error('book_id') is-invalid @enderror">
                                    <option value="">-- Select a physical book to link --</option>
                                    @foreach($books ?? [] as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">If this resource is a digital copy of an existing physical book.</div>
                                @error('book_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">File Upload <span class="text-danger">*</span></label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                                <div class="form-text">Supported formats: PDF, MP4, MP3, ZIP. Max size: 50MB.</div>
                                @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3">Access Settings</h6>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_downloadable" id="is_downloadable" value="1" {{ old('is_downloadable', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="is_downloadable">Allow Downloading</label>
                            </div>
                            <div class="form-text">If disabled, users can only preview the file online (if supported).</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Access Roles</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="student" id="role_student" {{ in_array('student', old('roles', ['student'])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_student">Students</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="staff" id="role_staff" {{ in_array('staff', old('roles', ['staff'])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_staff">Staff</label>
                                </div>
                            </div>
                            @error('roles')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('library.digital-resources.index') }}" class="btn btn-light shadow-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary shadow-sm px-4">Upload Resource</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius:16px; background-color: #F8FAFC;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Help Tips</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.8;">
                        <li>Ensure files are optimized before uploading.</li>
                        <li>PDF files support in-browser preview.</li>
                        <li>Video/Audio files must be in web-friendly formats (MP4, MP3).</li>
                        <li>Archive files (ZIP) will only be downloadable.</li>
                        <li>If you link to a book, the resource will appear on the book's details page.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
