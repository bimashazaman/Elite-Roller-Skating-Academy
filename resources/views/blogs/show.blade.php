@extends('layouts.app')

@section('content')
    <!-- Hero Header Section -->
    <div class="blog-hero">
        @if ($blog->featured_image)
            <div class="blog-hero-bg" style="background-image: url('{{ Storage::url($blog->featured_image) }}')"></div>
        @else
            <div class="blog-hero-bg default-bg"></div>
        @endif
        <div class="blog-hero-overlay"></div>
        <div class="container">
            <div class="blog-hero-content">
                <div class="blog-meta">
                    <span class="category"><i class="bi bi-bookmark-fill"></i> {{ $blog->category }}</span>
                    <span class="date"><i class="bi bi-calendar3"></i> {{ $blog->created_at->format('F j, Y') }}</span>
                    @if ($blog->is_featured)
                        <span class="featured"><i class="bi bi-star-fill"></i> Featured</span>
                    @endif
                </div>
                <h1 class="blog-title">{{ $blog->title }}</h1>
                <div class="blog-tags">
                    @if ($blog->tags)
                        @foreach ($blog->tags as $tag)
                            <span class="tag"><i class="bi bi-hash"></i>{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <div class="arrows">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container blog-container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Author Info -->
                <div class="blog-author">
                    <div class="author-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}&background=4682B4&color=fff"
                            alt="{{ $blog->user->name }}">
                    </div>
                    <div class="author-info">
                        <h4>{{ $blog->user->name }}</h4>
                        <p>Author</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="blog-description">
                    <i class="bi bi-quote quote-icon"></i>
                    {{ $blog->description }}
                </div>

                <!-- Table of Contents -->
                <div class="table-of-contents">
                    <h3><i class="bi bi-list-ul"></i> Quick Navigation</h3>
                    <ul class="toc-list">
                        <li><a href="#content">Main Content</a></li>
                        @if ($blog->youtube_link)
                            <li><a href="#video">Video Content</a></li>
                        @endif
                        @if ($blog->gallery_images)
                            <li><a href="#gallery">Image Gallery</a></li>
                        @endif
                        <li><a href="#share">Share Article</a></li>
                    </ul>
                </div>

                <!-- Content -->
                <div id="content" class="blog-content">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <!-- YouTube Video -->
                @if ($blog->youtube_link)
                    <div id="video" class="blog-video">
                        <h3><i class="bi bi-play-circle"></i> Video Content</h3>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ str_replace('watch?v=', 'embed/', $blog->youtube_link) }}" title="YouTube video"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                <!-- Gallery Images -->
                @if ($blog->gallery_images)
                    <div id="gallery" class="blog-gallery">
                        <h3><i class="bi bi-images"></i> Image Gallery</h3>
                        <div class="row g-4">
                            @foreach ($blog->gallery_images as $image)
                                <div class="col-md-4">
                                    <a href="{{ Storage::url($image) }}" class="gallery-item" data-lightbox="blog-gallery">
                                        <img src="{{ Storage::url($image) }}" class="img-fluid rounded"
                                            alt="Gallery image">
                                        <div class="gallery-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Share Section -->
                <div id="share" class="blog-share">
                    <h3><i class="bi bi-share"></i> Share this article</h3>
                    <div class="share-buttons">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                            class="btn btn-twitter" target="_blank">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                            class="btn btn-facebook" target="_blank">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}"
                            class="btn btn-linkedin" target="_blank">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                        <button class="btn btn-copy" onclick="copyToClipboard()">
                            <i class="bi bi-link-45deg"></i> Copy Link
                        </button>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="blog-navigation">
                    <a href="{{ route('blogs.index') }}" class="nav-link back">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back to Blogs</span>
                    </a>
                    <div class="nav-buttons">
                        @if (isset($previousBlog))
                            <a href="{{ route('blogs.show', $previousBlog) }}" class="nav-link prev">
                                <i class="bi bi-chevron-left"></i>
                                <span>Previous Post</span>
                            </a>
                        @endif
                        @if (isset($nextBlog))
                            <a href="{{ route('blogs.show', $nextBlog) }}" class="nav-link next">
                                <span>Next Post</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        /* Hero Section */
        .blog-hero {
            position: relative;
            height: 80vh;
            min-height: 600px;
            margin-top: -24px;
            color: white;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .blog-hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transform: scale(1.1);
            transition: transform 0.3s ease-out;
            animation: subtle-zoom 20s infinite alternate;
        }

        @keyframes subtle-zoom {
            0% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1.2);
            }
        }

        .blog-hero-bg.default-bg {
            background: linear-gradient(135deg, #4682B4, #87CEEB);
        }

        .blog-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.8));
            opacity: 0.8;
        }

        .blog-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 4rem 2rem;
            text-align: center;
        }

        .blog-meta {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .blog-meta span {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .blog-meta span:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        .blog-meta .featured {
            background: rgba(255, 215, 0, 0.3);
        }

        .blog-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
            animation: fadeInUp 1s ease-out;
        }

        .blog-tags {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.3s;
            animation-fill-mode: both;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 1.2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: fadeInUp 1s ease-out 0.6s;
            animation-fill-mode: both;
            z-index: 2;
            cursor: pointer;
            text-align: center;
            width: 30px;
        }

        .mouse {
            width: 30px;
            height: 50px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            position: relative;
            margin: 0 auto 10px;
        }

        .wheel {
            width: 4px;
            height: 8px;
            background: rgba(255, 255, 255, 0.8);
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
            animation: scroll 2s infinite;
        }

        .arrows {
            position: relative;
            width: 20px;
            height: 20px;
            margin: 0 auto;
        }

        .arrows span {
            position: absolute;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 10px;
            height: 10px;
            border-right: 2px solid rgba(255, 255, 255, 0.8);
            border-bottom: 2px solid rgba(255, 255, 255, 0.8);
            animation: arrows 2s infinite;
            margin: 0;
        }

        .arrows span:nth-child(1) {
            top: 0;
        }

        .arrows span:nth-child(2) {
            top: 5px;
            animation-delay: 0.2s;
        }

        .arrows span:nth-child(3) {
            top: 10px;
            animation-delay: 0.4s;
        }

        @keyframes scroll {
            0% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(20px);
            }
        }

        @keyframes arrows {
            0% {
                opacity: 0;
                transform: rotate(45deg) translate(-20px, -20px);
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: rotate(45deg) translate(20px, 20px);
            }
        }

        /* Author Section */
        .blog-author {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 3rem;
            padding: 1.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .author-avatar img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .author-info p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }

        /* Table of Contents */
        .table-of-contents {
            margin-bottom: 3rem;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .table-of-contents h3 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: #333;
        }

        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .toc-list li {
            margin-bottom: 0.5rem;
        }

        .toc-list a {
            display: block;
            padding: 0.8rem 1rem;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .toc-list a:hover {
            background: #f8f9fa;
            color: #4682B4;
            transform: translateX(5px);
        }

        /* Main Content */
        .blog-container {
            padding: 4rem 0;
        }

        .blog-description {
            position: relative;
            font-size: 1.25rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 3rem;
            padding: 2rem 2rem 2rem 3rem;
            background: #f8f9fa;
            border-radius: 15px;
            border-left: 5px solid #4682B4;
        }

        .quote-icon {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.5rem;
            color: #4682B4;
            opacity: 0.5;
        }

        .blog-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
            margin-bottom: 3rem;
        }

        /* Video Section */
        .blog-video {
            margin: 3rem 0;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .blog-video h3 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: #333;
        }

        /* Gallery Section */
        .blog-gallery {
            margin: 3rem 0;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .blog-gallery h3 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: #333;
        }

        .gallery-item {
            position: relative;
            display: block;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-overlay i {
            color: white;
            font-size: 2rem;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Share Section */
        .blog-share {
            margin-top: 4rem;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .blog-share h3 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            color: #333;
        }

        .share-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .share-buttons .btn {
            flex: 1;
            min-width: 120px;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            color: white;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .share-buttons .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-twitter {
            background: #1DA1F2;
        }

        .btn-facebook {
            background: #4267B2;
        }

        .btn-linkedin {
            background: #0077B5;
        }

        .btn-copy {
            background: #6c757d;
        }

        /* Navigation */
        .blog-navigation {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            color: #555;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: #f8f9fa;
            color: #4682B4;
            transform: translateY(-2px);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .blog-hero {
                height: auto;
                min-height: 100vh;
                padding: 6rem 0;
            }

            .blog-hero-content {
                padding: 2rem 1rem;
            }

            .blog-title {
                font-size: 2.5rem;
            }

            .blog-meta {
                flex-direction: column;
                gap: 0.5rem;
            }

            .blog-meta span {
                width: 100%;
                justify-content: center;
            }

            .scroll-indicator {
                bottom: 1rem;
            }

            .share-buttons {
                flex-direction: column;
            }

            .nav-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        // Initialize lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': 'Image %1 of %2'
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Copy URL to clipboard
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                const copyBtn = document.querySelector('.btn-copy');
                const originalText = copyBtn.innerHTML;
                copyBtn.innerHTML = '<i class="bi bi-check2"></i> Copied!';
                setTimeout(() => {
                    copyBtn.innerHTML = originalText;
                }, 2000);
            });
        }

        // Parallax effect for hero background
        window.addEventListener('scroll', () => {
            const hero = document.querySelector('.blog-hero-bg');
            const scrolled = window.pageYOffset;
            hero.style.transform = `translate3d(0, ${scrolled * 0.4}px, 0)`;
        });
    </script>
@endpush
