@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Create New Blog Post</h2>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Back to Blogs
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                                    required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category"
                                        name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Training" {{ old('category') == 'Training' ? 'selected' : '' }}>
                                            Training</option>
                                        <option value="Competition"
                                            {{ old('category') == 'Competition' ? 'selected' : '' }}>Competition</option>
                                        <option value="Health" {{ old('category') == 'Health' ? 'selected' : '' }}>Health
                                        </option>
                                        <option value="Nutrition" {{ old('category') == 'Nutrition' ? 'selected' : '' }}>
                                            Nutrition</option>
                                        <option value="Equipment" {{ old('category') == 'Equipment' ? 'selected' : '' }}>
                                            Equipment</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror"
                                        id="tags" name="tags" value="{{ old('tags') }}"
                                        placeholder="Enter tags separated by commas">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    <div class="form-text">Recommended size: 1200x800px (Max: 2MB)</div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="gallery_images" class="form-label">Gallery Images</label>
                                    <input type="file" class="form-control @error('gallery_images') is-invalid @enderror"
                                        id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                                    <div class="form-text">You can select multiple images (Max: 2MB each)</div>
                                    @error('gallery_images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="youtube_link" class="form-label">YouTube Link</label>
                                <input type="url" class="form-control @error('youtube_link') is-invalid @enderror"
                                    id="youtube_link" name="youtube_link" value="{{ old('youtube_link') }}"
                                    placeholder="https://www.youtube.com/watch?v=...">
                                @error('youtube_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_published"
                                            name="is_published" value="1"
                                            {{ old('is_published', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">Publish immediately</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">Feature this post</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-light">Reset</button>
                                <button type="submit" class="btn btn-primary">Create Blog Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .form-label {
            font-weight: 500;
        }

        .card-header {
            background: linear-gradient(45deg, #4682B4, #87CEEB);
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Preview image before upload
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can add image preview logic here if needed
                };
                reader.readAsDataURL(file);
            }
        });

        // Convert comma-separated tags into array
        document.querySelector('form').addEventListener('submit', function(e) {
            const tagsInput = document.getElementById('tags');
            if (tagsInput.value) {
                const tagsArray = tagsInput.value.split(',').map(tag => tag.trim());
                tagsInput.value = JSON.stringify(tagsArray);
            }
        });
    </script>
@endpush
