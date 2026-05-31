@extends('layouts.admin')
@section('title', 'Edit Digital Resource')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1" style="color: #1E293B; font-weight: 700;">Edit Resource</h4>
            <p class="text-muted mb-0" style="font-size: 0.875rem;">Update digital file details</p>
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
                    <form action="{{ route('library.digital-resources.update', $resource) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $resource->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Link to Book (Optional)</label>
                                <select name="book_id" class="form-select @error('book_id') is-invalid @enderror">
                                    <option value="">-- Select a physical book to link --</option>
                                    @foreach($books ?? [] as $book)
                                        <option value="{{ $book->id }}" {{ old('book_id', $resource->book_id) == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                                @error('book_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $resource->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-medium">Update File</label>
                                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                <div class="form-text">Leave blank to keep the current file. Current file size: {{ number_format($resource->file_size / 1024 / 1024, 2) }} MB.</div>
                                @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3">Access Settings</h6>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_downloadable" id="is_downloadable" value="1" {{ old('is_downloadable', $resource->is_downloadable) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="is_downloadable">Allow Downloading</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Access Roles</label>
                            @php $roles = is_array($resource->roles) ? $resource->roles : json_decode($resource->roles, true) ?? []; @endphp
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="student" id="role_student" {{ in_array('student', old('roles', $roles)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_student">Students</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="staff" id="role_staff" {{ in_array('staff', old('roles', $roles)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_staff">Staff</label>
                                </div>
                            </div>
                            @error('roles')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('library.digital-resources.index') }}" class="btn btn-light shadow-sm">Cancel</a>
                            <button type="submit" class="btn btn-primary shadow-sm px-4">Update Resource</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
