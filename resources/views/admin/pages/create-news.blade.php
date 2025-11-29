@extends('admin.layouts.master')

@section('admin_content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Add New News</h4>
        <a href="{{ route('admin.manage-news') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to News List
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Title -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">News Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}"
                            placeholder="Enter news title"
                            required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror">
                            <option value="">Select Category</option>
                            <option value="Politics" {{ old('category') == 'Politics' ? 'selected' : '' }}>Politics</option>
                            <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Technology" {{ old('category') == 'Technology' ? 'selected' : '' }}>Technology</option>
                            <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                            <option value="Business" {{ old('category') == 'Business' ? 'selected' : '' }}>Business</option>
                            <option value="Health" {{ old('category') == 'Health' ? 'selected' : '' }}>Health</option>
                            <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="World" {{ old('category') == 'World' ? 'selected' : '' }}>World</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Featured Image</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/*"
                            onchange="previewImage(event)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max size: 2MB (JPG, PNG, GIF)</small>
                    </div>

                    <!-- Image Preview -->
                    <div class="col-md-12 mb-3">
                        <img id="imagePreview" src="" alt="Image Preview"
                             class="img-thumbnail d-none" style="max-width: 300px;">
                    </div>

                    <!-- Content -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">News Content <span class="text-danger">*</span></label>
                        <textarea
                            name="content"
                            rows="10"
                            class="form-control @error('content') is-invalid @enderror"
                            placeholder="Write your news content here..."
                            required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Publish News
                        </button>
                        <a href="{{ route('admin.manage-news') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
