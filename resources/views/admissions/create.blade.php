@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Admission Application</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admission.store') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Personal Information -->
                            <h4 class="mb-3">Personal Information</h4>

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth *</label>
                                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                        id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender *</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                        name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address Information -->
                            <h4 class="mb-3 mt-4">Address Information</h4>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address *</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                    required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City *</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" value="{{ old('city') }}" required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                                        id="state" name="state" value="{{ old('state') }}">
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">Country *</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                                        id="country" name="country" value="{{ old('country') }}" required>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                        id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sports Information -->
                            <h4 class="mb-3 mt-4">Sports Information</h4>

                            <div class="mb-3">
                                <label for="sport_interest" class="form-label">Sport of Interest *</label>
                                <input type="text" class="form-control @error('sport_interest') is-invalid @enderror"
                                    id="sport_interest" name="sport_interest" value="{{ old('sport_interest') }}"
                                    required>
                                @error('sport_interest')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="experience_level" class="form-label">Experience Level *</label>
                                <select class="form-select @error('experience_level') is-invalid @enderror"
                                    id="experience_level" name="experience_level" required>
                                    <option value="">Select Experience Level</option>
                                    <option value="Beginner"
                                        {{ old('experience_level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="Intermediate"
                                        {{ old('experience_level') == 'Intermediate' ? 'selected' : '' }}>Intermediate
                                    </option>
                                    <option value="Advanced"
                                        {{ old('experience_level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                    <option value="Professional"
                                        {{ old('experience_level') == 'Professional' ? 'selected' : '' }}>Professional
                                    </option>
                                </select>
                                @error('experience_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="preferred_training_time" class="form-label">Preferred Training Time</label>
                                <select class="form-select @error('preferred_training_time') is-invalid @enderror"
                                    id="preferred_training_time" name="preferred_training_time">
                                    <option value="">Select Preferred Time</option>
                                    <option value="Morning"
                                        {{ old('preferred_training_time') == 'Morning' ? 'selected' : '' }}>Morning
                                    </option>
                                    <option value="Afternoon"
                                        {{ old('preferred_training_time') == 'Afternoon' ? 'selected' : '' }}>Afternoon
                                    </option>
                                    <option value="Evening"
                                        {{ old('preferred_training_time') == 'Evening' ? 'selected' : '' }}>Evening
                                    </option>
                                </select>
                                @error('preferred_training_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Medical Information -->
                            <h4 class="mb-3 mt-4">Medical Information</h4>

                            <div class="mb-3">
                                <label for="medical_conditions" class="form-label">Medical Conditions</label>
                                <textarea class="form-control @error('medical_conditions') is-invalid @enderror" id="medical_conditions"
                                    name="medical_conditions" rows="3"
                                    placeholder="Please list any medical conditions or allergies we should be aware of">{{ old('medical_conditions') }}</textarea>
                                @error('medical_conditions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Emergency Contact -->
                            <h4 class="mb-3 mt-4">Emergency Contact</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_name" class="form-label">Emergency Contact Name
                                        *</label>
                                    <input type="text"
                                        class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                        id="emergency_contact_name" name="emergency_contact_name"
                                        value="{{ old('emergency_contact_name') }}" required>
                                    @error('emergency_contact_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone
                                        *</label>
                                    <input type="tel"
                                        class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                        id="emergency_contact_phone" name="emergency_contact_phone"
                                        value="{{ old('emergency_contact_phone') }}" required>
                                    @error('emergency_contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <h4 class="mb-3 mt-4">Additional Information</h4>

                            <div class="mb-3">
                                <label for="additional_notes" class="form-label">Additional Notes</label>
                                <textarea class="form-control @error('additional_notes') is-invalid @enderror" id="additional_notes"
                                    name="additional_notes" rows="3" placeholder="Any additional information you'd like to share">{{ old('additional_notes') }}</textarea>
                                @error('additional_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="document_uploads" class="form-label">Upload Documents</label>
                                <input type="file"
                                    class="form-control @error('document_uploads') is-invalid @enderror"
                                    id="document_uploads" name="document_uploads">
                                <div class="form-text">Upload any relevant documents (PDF, DOC, DOCX - Max 2MB)</div>
                                @error('document_uploads')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
