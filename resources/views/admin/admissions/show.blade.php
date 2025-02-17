@extends('layouts.app')

@section('content')
    <div class="admin-admission-details">
        <div class="container">
            <!-- Header Section -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Admission Details</h1>
                    <p class="text-muted">Review application details and manage status</p>
                </div>
                <div class="page-actions">
                    <a href="{{ route('admin.admissions.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i>
                        <span>Back to Admissions</span>
                    </a>
                </div>
            </div>

            <div class="content-grid">
                <!-- Main Details Card -->
                <div class="details-card main-details">
                    <div class="card-header">
                        <div class="applicant-info">
                            <div class="applicant-avatar">
                                {{ strtoupper(substr($admission->full_name, 0, 1)) }}
                            </div>
                            <div>
                                <h2>{{ $admission->full_name }}</h2>
                                <div class="meta-info">
                                    <span class="status {{ $admission->status }}">
                                        <i class="bi bi-circle-fill"></i>
                                        {{ ucfirst($admission->status) }}
                                    </span>
                                    <span class="date">
                                        <i class="bi bi-calendar3"></i>
                                        Applied {{ $admission->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="actions">
                            <form action="{{ route('admin.admissions.status', $admission) }}" method="POST"
                                class="status-form">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="status-select {{ $admission->status }}"
                                    onchange="this.form.submit()">
                                    <option value="pending" {{ $admission->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved" {{ $admission->status == 'approved' ? 'selected' : '' }}>
                                        Approved</option>
                                    <option value="rejected" {{ $admission->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                            </form>
                            <form action="{{ route('admin.admissions.destroy', $admission) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this admission?')">
                                    <i class="bi bi-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="info-grid">
                            <div class="info-section">
                                <h3>Personal Information</h3>
                                <div class="info-group">
                                    <div class="info-item">
                                        <label>Email</label>
                                        <p><i class="bi bi-envelope"></i> {{ $admission->email }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Phone</label>
                                        <p><i class="bi bi-telephone"></i> {{ $admission->phone }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Date of Birth</label>
                                        <p><i class="bi bi-calendar2"></i>
                                            {{ $admission->date_of_birth->format('M d, Y') }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Gender</label>
                                        <p><i class="bi bi-person"></i> {{ ucfirst($admission->gender) }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="info-section">
                                <h3>Address Information</h3>
                                <div class="info-group">
                                    <div class="info-item full-width">
                                        <label>Address</label>
                                        <p><i class="bi bi-geo-alt"></i> {{ $admission->address }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>City</label>
                                        <p><i class="bi bi-building"></i> {{ $admission->city }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>State/Province</label>
                                        <p><i class="bi bi-geo"></i> {{ $admission->state ?: 'N/A' }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Country</label>
                                        <p><i class="bi bi-globe"></i> {{ $admission->country }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Postal Code</label>
                                        <p><i class="bi bi-mailbox"></i> {{ $admission->postal_code ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="info-section">
                                <h3>Sport Information</h3>
                                <div class="info-group">
                                    <div class="info-item">
                                        <label>Sport Interest</label>
                                        <p><i class="bi bi-trophy"></i> {{ $admission->sport_interest }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Experience Level</label>
                                        <p><i class="bi bi-bar-chart"></i> {{ $admission->experience_level }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Preferred Training Time</label>
                                        <p><i class="bi bi-clock"></i>
                                            {{ $admission->preferred_training_time ?: 'Flexible' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="info-section">
                                <h3>Emergency Contact</h3>
                                <div class="info-group">
                                    <div class="info-item">
                                        <label>Contact Name</label>
                                        <p><i class="bi bi-person-check"></i> {{ $admission->emergency_contact_name }}</p>
                                    </div>
                                    <div class="info-item">
                                        <label>Contact Phone</label>
                                        <p><i class="bi bi-telephone"></i> {{ $admission->emergency_contact_phone }}</p>
                                    </div>
                                </div>
                            </div>

                            @if ($admission->medical_conditions)
                                <div class="info-section">
                                    <h3>Medical Information</h3>
                                    <div class="info-group">
                                        <div class="info-item full-width">
                                            <label>Medical Conditions</label>
                                            <p><i class="bi bi-heart-pulse"></i> {{ $admission->medical_conditions }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($admission->additional_notes)
                                <div class="info-section">
                                    <h3>Additional Notes</h3>
                                    <div class="info-group">
                                        <div class="info-item full-width">
                                            <label>Notes</label>
                                            <p><i class="bi bi-journal-text"></i> {{ $admission->additional_notes }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($admission->document_uploads)
                                <div class="info-section">
                                    <h3>Uploaded Documents</h3>
                                    <div class="info-group">
                                        <div class="info-item full-width">
                                            <a href="{{ Storage::url($admission->document_uploads) }}" class="btn-download"
                                                target="_blank">
                                                <i class="bi bi-file-earmark-text"></i>
                                                <span>View Document</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .admin-admission-details {
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

        .btn-back {
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

        .btn-back:hover {
            background: #3a6d96;
            transform: translateY(-2px);
        }

        /* Details Card */
        .details-card {
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
            background: #f8f9fa;
        }

        .applicant-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .applicant-avatar {
            width: 60px;
            height: 60px;
            background: #4682B4;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .applicant-info h2 {
            font-size: 1.5rem;
            margin: 0 0 0.5rem 0;
            color: #2c3e50;
        }

        .meta-info {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
        }

        .status {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-weight: 500;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.approved {
            background: #d4edda;
            color: #155724;
        }

        .status.rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .date {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #6c757d;
        }

        .actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .status-select {
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            border: none;
            font-size: 0.9rem;
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

        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        /* Card Content */
        .card-content {
            padding: 2rem;
        }

        .info-grid {
            display: grid;
            gap: 2rem;
        }

        .info-section {
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
        }

        .info-section h3 {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #4682B4;
            display: inline-block;
        }

        .info-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-item label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
        }

        .info-item p {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            color: #2c3e50;
            font-size: 1rem;
        }

        .info-item i {
            color: #4682B4;
        }

        .btn-download {
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

        .btn-download:hover {
            background: #3a6d96;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                gap: 1rem;
            }

            .actions {
                width: 100%;
                justify-content: flex-end;
            }

            .info-group {
                grid-template-columns: 1fr;
            }

            .meta-info {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
@endpush
