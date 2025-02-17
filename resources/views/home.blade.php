@extends('layouts.app')

@section('content')
    <!-- Hero Section with Dynamic Background -->
    <div class="hero-section">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1 class="hero-title">Elite Roller Skating Academy</h1>
            <p class="hero-subtitle">Unleash Your Inner Champion</p>
            <div class="hero-buttons">
                <a href="{{ route('admission.create') }}" class="btn btn-glow">Start Your Journey</a>
                <a href="#features" class="btn btn-outline-glow">Explore More</a>
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
    </div>

    <!-- Achievement Counter Section -->
    <section class="counter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <div class="counter">500+</div>
                        <div class="counter-text">Champions Trained</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="counter">15+</div>
                        <div class="counter-text">Expert Coaches</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <div class="counter">20+</div>
                        <div class="counter-text">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="counter">100%</div>
                        <div class="counter-text">Satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Blogs Section -->
    @if ($featured_blogs->count() > 0)
        <section class="featured-blogs">
            <div class="container">
                <h2 class="section-title">Skating Stories</h2>
                <div class="row g-4">
                    @foreach ($featured_blogs as $blog)
                        <div class="col-md-4">
                            <a href="{{ route('blogs.show', $blog) }}" class="featured-card-link">
                                <div class="featured-card {{ !$blog->featured_image ? 'no-image' : '' }}">
                                    @if ($blog->featured_image)
                                        <div class="card-image">
                                            <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}"
                                                class="background-image">
                                            <div class="card-overlay"></div>
                                        </div>
                                    @endif
                                    <div class="card-content">
                                        <div class="content-overlay"></div>
                                        <h3>{{ $blog->title }}</h3>
                                        <p>{{ Str::limit($blog->description, 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <h2 class="section-title text-white">The Skating Experience</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h3>Professional Training</h3>
                        <p>Learn from championship-winning coaches and perfect your technique</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h3>World-Class Rink</h3>
                        <p>Train in our state-of-the-art indoor skating rink with premium surfaces</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <h3>Competition Ready</h3>
                        <p>Prepare for national and international competitions with expert guidance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blogs Section -->
    @if ($latest_blogs->count() > 0)
        <section class="latest-blogs">
            <div class="container">
                <br />
                <h2 class="section-title">Latest from the Rink</h2>
                <div class="row g-4">
                    @foreach ($latest_blogs as $blog)
                        <div class="col-md-4">
                            <a href="{{ route('blogs.show', $blog) }}" class="blog-card-link">
                                <div class="blog-card {{ !$blog->featured_image ? 'no-image' : '' }}">
                                    @if ($blog->featured_image)
                                        <div class="card-image">
                                            <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}"
                                                class="background-image">
                                            <div class="card-overlay"></div>
                                        </div>
                                    @endif
                                    <div class="card-content">
                                        <div class="category">{{ $blog->category }}</div>
                                        <h3>{{ $blog->title }}</h3>
                                        <p>{{ Str::limit($blog->description, 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        /* Updated and new styles */
        .hero-section {
            height: 100vh;
            position: relative;
            overflow: hidden;
            margin-top: -24px;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.6)),
                url('https://assets.change.org/photos/6/ep/km/lvePkmAiInKFrwN-800x450-noPad.jpg?1495368188');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            animation: zoomBg 20s infinite alternate;
        }

        @keyframes zoomBg {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 20px;
            max-width: 1000px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero-title {
            font-size: 5.5rem;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 2rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            animation: fadeInDown 1s ease-out;
        }

        .hero-subtitle {
            font-size: 2.2rem;
            color: #fff;
            margin-bottom: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            animation: fadeInUp 1s ease-out 0.5s;
            animation-fill-mode: both;
        }

        .hero-buttons {
            display: flex;
            gap: 2rem;
            animation: fadeInUp 1s ease-out 1s;
            animation-fill-mode: both;
        }

        .btn-outline-glow {
            color: white;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 2px solid #87CEEB;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-glow:hover {
            background: rgba(135, 206, 235, 0.2);
            color: white;
            border-color: #4682B4;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            animation: fadeInUp 1s ease-out 1.5s;
            animation-fill-mode: both;
        }

        .mouse {
            width: 30px;
            height: 50px;
            border: 2px solid #fff;
            border-radius: 20px;
            position: relative;
            margin: 0 auto 10px;
        }

        .wheel {
            width: 4px;
            height: 8px;
            background: #fff;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
            animation: scroll 2s infinite;
        }

        .arrows span {
            display: block;
            width: 10px;
            height: 10px;
            border-right: 2px solid #fff;
            border-bottom: 2px solid #fff;
            transform: rotate(45deg);
            margin: -5px auto;
            animation: arrows 2s infinite;
        }

        .arrows span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .arrows span:nth-child(3) {
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

        /* Counter Section Enhancements */
        .counter-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 4rem 0;
            margin-top: -5rem;
            position: relative;
            z-index: 3;
            box-shadow: 0 -20px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .counter-box {
            text-align: center;
            padding: 2rem;
            transition: transform 0.3s ease;
        }

        .counter-box:hover {
            transform: translateY(-10px);
        }

        .counter-icon {
            font-size: 2.5rem;
            color: #4682B4;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .counter-box:hover .counter-icon {
            transform: scale(1.2);
        }

        /* General Styles */
        body {
            background-color: #f0f8ff;
            font-family: 'Poppins', sans-serif;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 3rem;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Featured Blogs Section */
        .featured-blogs {
            background: linear-gradient(135deg, #f0f8ff 0%, #e1f5fe 100%);
            padding: 6rem 0;
            position: relative;
        }

        .featured-blogs::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('path-to-pattern.png') repeat;
            opacity: 0.1;
        }

        .featured-card {
            position: relative;
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
        }

        .featured-card.no-image {
            background: linear-gradient(135deg, #4682B4 0%, #2c3e50 100%);
        }

        .featured-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .card-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .featured-card:hover .background-image {
            transform: scale(1.1);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.8));
            opacity: 0.8;
            transition: opacity 0.4s ease;
        }

        .featured-card:hover .card-overlay {
            opacity: 0.9;
        }

        .card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2rem;
            color: white;
            z-index: 2;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .no-image .card-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: none;
            text-align: center;
        }

        .no-image .card-content h3 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .no-image .card-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 90%;
            margin: 0 auto;
        }

        /* Features Section */
        .features-section {
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
            padding: 8rem 0;
            position: relative;
            overflow: hidden;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('path-to-pattern.png') repeat;
            opacity: 0.1;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.2);
        }

        .feature-card .icon {
            font-size: 4rem;
            margin-bottom: 2rem;
            color: #fff;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }

        /* Buttons */
        .btn-glow {
            background: linear-gradient(45deg, #87CEEB, #4682B4);
            color: white;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-glow:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .btn-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(45deg);
            animation: glowEffect 3s infinite;
        }

        @keyframes glowEffect {
            0% {
                transform: rotate(45deg) translateX(-100%);
            }

            100% {
                transform: rotate(45deg) translateX(100%);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Card Links */
        .featured-card-link,
        .blog-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        /* Blog Card Styles */
        .blog-card {
            position: relative;
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            background: linear-gradient(135deg, #87CEEB 0%, #4682B4 100%);
        }

        .blog-card.no-image {
            background: linear-gradient(135deg, #4682B4 0%, #2c3e50 100%);
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .blog-card .category {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(135, 206, 235, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 3;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Animate counters
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText.replace('+', '');
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc) + '+';
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target + '+';
                    }
                };

                counter.setAttribute('data-target', counter.innerText.replace('+', ''));
                updateCount();
            });
        });
    </script>
@endpush
