@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="blogs-hero">
        <div class="container">
            <h1 class="display-4 text-center mb-2">Our Blog</h1>
            <p class="lead text-center mb-0">Stay updated with the latest news, tips, and stories from our skating community
            </p>
        </div>
    </div>

    <div class="container blogs-container">
        <!-- Category Filter -->
        <div class="category-filter mb-4">
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <a href="{{ route('blogs.index') }}"
                    class="category-badge {{ !$category || $category === 'all' ? 'active' : '' }}">
                    All
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('blogs.index', ['category' => $cat]) }}"
                        class="category-badge {{ $category === $cat ? 'active' : '' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <article class="blog-card h-100">
                        <div class="blog-card-image">
                            @if ($blog->featured_image)
                                <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}"
                                    class="img-fluid">
                            @else
                                <div class="placeholder-image">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                            <div class="category-tag">{{ $blog->category }}</div>
                        </div>
                        <div class="blog-card-body">
                            <h2 class="blog-title">{{ $blog->title }}</h2>
                            <p class="blog-excerpt">{{ Str::limit($blog->description, 120) }}</p>

                            @if ($blog->tags)
                                <div class="blog-tags">
                                    @foreach ($blog->tags as $tag)
                                        <span class="tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="blog-card-footer">
                            <div class="meta">
                                <span class="date"><i class="bi bi-calendar3"></i>
                                    {{ $blog->created_at->format('M d, Y') }}</span>
                                @if ($blog->is_featured)
                                    <span class="featured"><i class="bi bi-star-fill"></i> Featured</span>
                                @endif
                            </div>
                            <a href="{{ route('blogs.show', $blog) }}" class="read-more">
                                Read More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-journal-x display-1 text-muted"></i>
                        <h3 class="mt-3">No Blog Posts Available</h3>
                        <p class="text-muted">
                            @if ($category)
                                No posts found in the "{{ $category }}" category.
                                <a href="{{ route('blogs.index') }}" class="text-primary">View all posts</a>
                            @else
                                Check back later for new content!
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
            {{ $blogs->appends(['category' => $category])->links() }}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Hero Section */
        .blogs-hero {
            background: linear-gradient(135deg, #4682B4, #87CEEB);
            padding: 4rem 0;
            margin-bottom: 3rem;
            margin-top: -24px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .blogs-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" stroke="white" stroke-width="0.5" fill="none" opacity="0.2"/></svg>') repeat;
            opacity: 0.1;
        }

        .blogs-hero h1 {
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .blogs-hero .lead {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }

        /* Category Filter */
        .category-filter {
            position: relative;
            margin-top: -2.5rem;
            z-index: 2;
        }

        .category-badge {
            padding: 0.6rem 1.2rem;
            background: white;
            border-radius: 50px;
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .category-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            color: #4682B4;
        }

        .category-badge.active {
            background: #4682B4;
            color: white;
        }

        /* Blog Cards */
        .blog-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: none;
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .blog-card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .blog-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-card-image img {
            transform: scale(1.1);
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-image i {
            font-size: 3rem;
            color: #adb5bd;
        }

        .category-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(70, 130, 180, 0.9);
            color: white;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            backdrop-filter: blur(5px);
        }

        .blog-card-body {
            padding: 1.5rem;
        }

        .blog-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #2c3e50;
            line-height: 1.4;
        }

        .blog-excerpt {
            color: #6c757d;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .blog-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .tag {
            padding: 0.3rem 0.8rem;
            background: #f8f9fa;
            border-radius: 50px;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .blog-card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .meta .featured {
            color: #ffc107;
        }

        .read-more {
            color: #4682B4;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            transition: gap 0.3s ease;
        }

        .read-more:hover {
            gap: 0.5rem;
            color: #3a6d96;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }

        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: #4682B4;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: #4682B4;
            color: white;
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: #4682B4;
            color: white;
        }

        @media (max-width: 768px) {
            .blogs-hero {
                padding: 3rem 0;
            }

            .blogs-hero h1 {
                font-size: 2.5rem;
            }

            .category-filter {
                margin-top: -1.5rem;
            }

            .category-badge {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
@endpush
