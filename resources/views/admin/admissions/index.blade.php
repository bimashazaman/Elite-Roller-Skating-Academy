@extends('layouts.app')

@section('content')
    <div class="admin-admissions">
        <div class="container">
            <!-- Header Section -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Admission Management</h1>
                    <p class="text-muted">Manage and process admission applications</p>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admissions->total() }}</h3>
                        <p class="stat-label">Total Applications</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admissions->where('status', 'pending')->count() }}</h3>
                        <p class="stat-label">Pending</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon approved">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admissions->where('status', 'approved')->count() }}</h3>
                        <p class="stat-label">Approved</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon rejected">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-value">{{ $admissions->where('status', 'rejected')->count() }}</h3>
                        <p class="stat-label">Rejected</p>
                    </div>
                </div>
            </div>

            <!-- Admissions List -->
            <div class="admissions-list-section">
                @if ($admissions->count() > 0)
                    <div class="admissions-table">
                        <div class="table-header">
                            <div class="header-cell">Applicant</div>
                            <div class="header-cell">Sport</div>
                            <div class="header-cell">Status</div>
                            <div class="header-cell">Applied Date</div>
                            <div class="header-cell">Actions</div>
                        </div>
                        @foreach ($admissions as $admission)
                            <div class="table-row">
                                <div class="cell applicant-cell">
                                    <div class="applicant-info">
                                        <div class="applicant-avatar">
                                            {{ strtoupper(substr($admission->full_name, 0, 1)) }}
                                        </div>
                                        <div class="applicant-details">
                                            <h3>{{ $admission->full_name }}</h3>
                                            <div class="contact-info">
                                                <span><i class="bi bi-envelope"></i> {{ $admission->email }}</span>
                                                <span><i class="bi bi-telephone"></i> {{ $admission->phone }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell">
                                    <span class="sport-badge">{{ $admission->sport_interest }}</span>
                                    <div class="experience-level">{{ $admission->experience_level }}</div>
                                </div>
                                <div class="cell">
                                    <form action="{{ route('admin.admissions.status', $admission) }}" method="POST"
                                        class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="status-select {{ $admission->status }}"
                                            onchange="this.form.submit()">
                                            <option value="pending"
                                                {{ $admission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved"
                                                {{ $admission->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected"
                                                {{ $admission->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="cell">
                                    <span class="date">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $admission->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <div class="cell actions">
                                    <a href="{{ route('admin.admissions.show', $admission) }}" class="btn-action view"
                                        title="View Details">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <form action="{{ route('admin.admissions.destroy', $admission) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Delete Application"
                                            onclick="return confirm('Are you sure you want to delete this admission?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination-wrapper">
                        {{ $admissions->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-person-x"></i>
                        <h3>No Admissions Yet</h3>
                        <p>There are no admission applications at the moment</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .admin-admissions {
            padding: 2rem 0;
            background: #f8f9fa;
            min-height: calc(100vh - 60px);
        }

        /* Header Section */
        .page-header {
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

        .stat-icon.pending {
            color: #ffc107;
        }

        .stat-icon.approved {
            color: #28a745;
        }

        .stat-icon.rejected {
            color: #dc3545;
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

        /* Admissions Table */
        .admissions-list-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .admissions-table {
            width: 100%;
        }

        .table-header {
            display: grid;
            grid-template-columns: 3fr 2fr 1fr 1fr 1fr;
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
            grid-template-columns: 3fr 2fr 1fr 1fr 1fr;
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

        .applicant-cell {
            overflow: hidden;
        }

        .applicant-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .applicant-avatar {
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

        .applicant-details h3 {
            font-size: 1rem;
            margin: 0 0 0.25rem 0;
            color: #2c3e50;
        }

        .contact-info {
            display: flex;
            gap: 1rem;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .contact-info span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .sport-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: #e9ecef;
            color: #2c3e50;
            border-radius: 50px;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .experience-level {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .status-select {
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            border: none;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .status-select.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-select.approved {
            background: #d4edda;
            color: #155724;
        }

        .status-select.rejected {
            background: #f8d7da;
            color: #721c24;
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
            justify-content: flex-end;
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
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .btn-action.view {
            background: #4682B4;
        }

        .btn-action.view:hover {
            background: #3a6d96;
        }

        .btn-action.delete {
            background: #dc3545;
        }

        .btn-action.delete:hover {
            background: #c82333;
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
                grid-template-columns: 2fr 1.5fr 1fr 1fr 1fr;
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

            .applicant-cell {
                margin-bottom: 1rem;
            }

            .contact-info {
                flex-direction: column;
                gap: 0.5rem;
            }

            .actions {
                justify-content: flex-end;
                margin-top: 1rem;
            }
        }
    </style>
@endpush
