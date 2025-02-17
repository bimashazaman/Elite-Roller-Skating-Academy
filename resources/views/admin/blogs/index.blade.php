@extends('layouts.app')

@section('content')
    <div class="admin-blogs">
        <div class="container">
            <!-- Header Section -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Blog Management</h1>
                    <p class="text-muted">Manage and organize your blog posts</p>
                </div>
                <div class="page-actions">
                    <a href="{{ route('blogs.create') }}" class="btn-create">
                        <i class="bi bi-plus-circle"></i>
                        <span>Create New Blog</span>
                    </a>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $blogs->total() }}</h3>
                        <p class="stat-label">Total Blogs</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $blogs->where('is_published', true)->count() }}</h3>
                        <p class="stat-label">Published</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $blogs->where('is_published', false)->count() }}</h3>
                        <p class="stat-label">Drafts</p>
                    </div>
                </div>
            </div>

            <!-- Blog List -->
            <div class="blog-list-section">
                @if ($blogs->count() > 0)
                    <div class="blog-table">
                        <div class="table-header">
                            <div class="header-cell">Title</div>
                            <div class="header-cell">Category</div>
                            <div class="header-cell">Status</div>
                            <div class="header-cell">Created</div>
                            <div class="header-cell">Actions</div>
                        </div>
                        @foreach ($blogs as $blog)
                            <div class="table-row">
                                <div class="cell title-cell">
                                    <div class="blog-title">
                                        @if ($blog->featured_image)
                                            <div class="blog-image">
                                                <img src="{{ Storage::url($blog->featured_image) }}"
                                                    alt="{{ $blog->title }}">
                                            </div>
                                        @else
                                            <div class="blog-image placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div class="blog-info">
                                            <h3>{{ $blog->title }}</h3>
                                            <p>{{ Str::limit($blog->description, 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell">
                                    <span class="category-badge">{{ $blog->category }}</span>
                                </div>
                                <div class="cell">
                                    <span class="status-badge {{ $blog->is_published ? 'published' : 'draft' }}">
                                        <i class="bi bi-circle-fill"></i>
                                        {{ $blog->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                <div class="cell">
                                    <span class="date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <div class="cell actions">
                                    <a href="{{ route('blogs.edit', $blog) }}" class="btn-action edit" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('blogs.show', $blog) }}" class="btn-action view" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this blog?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-wrapper">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-journal-x"></i>
                        <h3>No Blog Posts Yet</h3>
                        <p>Get started by creating your first blog post</p>
                        <a href="{{ route('blogs.create') }}" class="btn-create">
                            <i class="bi bi-plus-circle"></i>
                            <span>Create New Blog</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .admin-blogs {
            padding: 2rem 0;
            background: #f8f9fa;
            min-height: calc(100vh - 60px);
        }

        /* Header Section */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #4682B4, #87CEEB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: #4682B4;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-create:hover {
            background: #3a6d96;
            transform: translateY(-2px);
        }

        /* Stats Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2rem;
            color: #4682B4;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: #2c3e50;
        }

        .stat-label {
            color: #6c757d;
            margin: 0;
        }

        /* Blog Table */
        .blog-list-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .blog-table {
            width: 100%;
        }

        .table-header {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
            padding: 1rem;
            background: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .header-cell {
            font-weight: 600;
            color: #2c3e50;
        }

        .table-row {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
            padding: 1rem;
            align-items: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: background-color 0.3s ease;
        }

        .table-row:hover {
            background-color: #f8f9fa;
        }

        .cell {
            padding: 0.5rem;
        }

        .title-cell {
            overflow: hidden;
        }

        .blog-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .blog-image {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            overflow: hidden;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-image.placeholder {
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
        }

        .blog-info h3 {
            font-size: 1rem;
            margin: 0 0 0.25rem 0;
            color: #2c3e50;
        }

        .blog-info p {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 0;
        }

        .category-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: #e9ecef;
            color: #2c3e50;
            border-radius: 50px;
            font-size: 0.875rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.875rem;
        }

        .status-badge.published {
            background: #d4edda;
            color: #28a745;
        }

        .status-badge.draft {
            background: #fff3cd;
            color: #ffc107;
        }

        .date {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .btn-action.edit {
            background: #4682B4;
        }

        .btn-action.view {
            background: #6c757d;
        }

        .btn-action.delete {
            background: #dc3545;
            border: none;
            cursor: pointer;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #adb5bd;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 1024px) {

            .table-header,
            .table-row {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-section {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }

            .table-header {
                display: none;
            }

            .table-row {
                display: block;
                padding: 1rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .cell {
                padding: 0.5rem 0;
            }

            .title-cell {
                margin-bottom: 1rem;
            }

            .actions {
                justify-content: flex-end;
                margin-top: 1rem;
            }
        }
    </style>
@endpush
