@extends('layouts.app')

@section('content')
    <div class="admin-dashboard">
        <div class="container">


            <!-- Statistics Cards -->
            <div class="stats-grid mb-5">
                <div class="stat-card total-blogs">
                    <div class="stat-icon">
                        <i class="bi bi-file-text"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['total_blogs'] }}</h3>
                        <p class="stat-label">Total Blogs</p>
                    </div>
                    <div class="stat-chart"></div>
                </div>

                <div class="stat-card published-blogs">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['published_blogs'] }}</h3>
                        <p class="stat-label">Published Blogs</p>
                    </div>
                    <div class="stat-chart"></div>
                </div>

                <div class="stat-card draft-blogs">
                    <div class="stat-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['draft_blogs'] }}</h3>
                        <p class="stat-label">Draft Blogs</p>
                    </div>
                    <div class="stat-chart"></div>
                </div>

                <div class="stat-card total-admissions">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $stats['total_admissions'] }}</h3>
                        <p class="stat-label">Total Admissions</p>
                    </div>
                    <div class="stat-chart"></div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions mb-5">
                <h2 class="section-title">Quick Actions</h2>
                <div class="action-buttons">
                    <a href="{{ route('admin.blogs.create') }}" class="action-button create-blog">
                        <i class="bi bi-plus-circle"></i>
                        <span>New Blog Post</span>
                    </a>
                    <a href="{{ route('blogs.index') }}" class="action-button view-blogs">
                        <i class="bi bi-collection"></i>
                        <span>View All Blogs</span>
                    </a>
                    <a href="{{ route('admin.admissions.index') }}" class="action-button manage-admissions">
                        <i class="bi bi-person-plus"></i>
                        <span>Manage Admissions</span>
                    </a>
                </div>
            </div>

            <div class="content-grid">
                <!-- Recent Blog Posts -->
                <div class="content-card recent-blogs">
                    <div class="card-header">
                        <h2>Recent Blog Posts</h2>
                        <a href="{{ route('blogs.index') }}" class="view-all">View All</a>
                    </div>
                    <div class="card-content">
                        @if ($recent_blogs->count() > 0)
                            <div class="blog-list">
                                @foreach ($recent_blogs as $blog)
                                    <div class="blog-item">
                                        <div class="blog-info">
                                            <h3>{{ $blog->title }}</h3>
                                            <p>{{ Str::limit($blog->description, 100) }}</p>
                                            <div class="blog-meta">
                                                <span class="date">
                                                    <i class="bi bi-calendar3"></i>
                                                    {{ $blog->created_at->diffForHumans() }}
                                                </span>
                                                <span class="status {{ $blog->is_published ? 'published' : 'draft' }}">
                                                    <i class="bi bi-circle-fill"></i>
                                                    {{ $blog->is_published ? 'Published' : 'Draft' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="blog-actions">
                                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn-edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('blogs.show', $blog) }}" class="btn-view">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-journal-x"></i>
                                <p>No blog posts yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Admissions -->
                <div class="content-card recent-admissions">
                    <div class="card-header">
                        <h2>Recent Admissions</h2>
                        <a href="{{ route('admin.admissions.index') }}" class="view-all">View All</a>
                    </div>
                    <div class="card-content">
                        @if ($recent_admissions->count() > 0)
                            <div class="admission-list">
                                @foreach ($recent_admissions as $admission)
                                    <div class="admission-item">
                                        <div class="admission-info">
                                            <div class="student-avatar">
                                                {{ strtoupper(substr($admission->full_name, 0, 1)) }}
                                            </div>
                                            <div class="student-details">
                                                <h3>{{ $admission->full_name }}</h3>
                                                <p>{{ $admission->sport_interest }}</p>
                                                <div class="admission-meta">
                                                    <span class="date">
                                                        <i class="bi bi-calendar3"></i>
                                                        {{ $admission->created_at->diffForHumans() }}
                                                    </span>
                                                    <span class="status {{ $admission->status }}">
                                                        <i class="bi bi-circle-fill"></i>
                                                        {{ ucfirst($admission->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="admission-actions">
                                            <a href="{{ route('admin.admissions.show', $admission) }}" class="btn-view">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-person-x"></i>
                                <p>No admissions yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .admin-dashboard {
            padding: 2rem 0;
            background: #f8f9fa;
        }

        .welcome-section {
            text-align: center;
            padding: 3rem 0;
        }

        .welcome-section h1 {
            background: linear-gradient(45deg, #4682B4, #87CEEB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #4682B4;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .stat-label {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }

        /* Quick Actions */
        .quick-actions {
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-button {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem;
            background: white;
            border-radius: 12px;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            color: #4682B4;
        }

        .action-button i {
            font-size: 1.5rem;
            color: #4682B4;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #2c3e50;
        }

        .view-all {
            color: #4682B4;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .view-all:hover {
            color: #3a6d96;
        }

        .card-content {
            padding: 1.5rem;
        }

        /* Blog List */
        .blog-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .blog-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .blog-item:hover {
            transform: translateX(5px);
        }

        .blog-info {
            flex: 1;
        }

        .blog-info h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .blog-info p {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .blog-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .blog-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .blog-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit,
        .btn-view {
            padding: 0.5rem;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .btn-edit {
            background: #4682B4;
        }

        .btn-view {
            background: #6c757d;
        }

        .btn-edit:hover,
        .btn-view:hover {
            transform: scale(1.1);
        }

        /* Admission List */
        .admission-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .admission-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .admission-item:hover {
            transform: translateX(5px);
        }

        .admission-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            background: #4682B4;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .student-details h3 {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
            color: #2c3e50;
        }

        .student-details p {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .admission-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .status {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .status.pending {
            color: #ffc107;
        }

        .status.approved {
            color: #28a745;
        }

        .status.rejected {
            color: #dc3545;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush
