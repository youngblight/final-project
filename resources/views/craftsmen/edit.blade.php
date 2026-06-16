@extends('layouts.craftsmen')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            {{-- Success Message (Success Alert) --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="collapse" data-bs-target=".alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Validation Errors Message --}}
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM CARD --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4 border-0">
                    <h5 class="fw-bold mb-0">Edit Your Profile</h5>
                    <p class="small mb-0 text-white-50">Update your work details and location availability</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('craftsmen.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- PHOTO SECTION --}}
                        <div class="mb-4 text-center">
                            <label class="form-label d-block fw-bold small text-muted mb-3">Profile Picture</label>
                            <div class="position-relative d-inline-block">
                                @php
                                    $profileImg = $craftsman->profile_photo 
                                        ? asset('storage/' . $craftsman->profile_photo) 
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($craftsman->full_name) . '&background=0d6efd&color=fff';
                                @endphp
                                <img src="{{ $profileImg }}" 
                                     class="rounded-circle shadow-sm border border-2 border-white" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                            <div class="mt-3 mx-auto" style="max-width: 250px;">
                                <input type="file" name="profile_photo" class="form-control form-control-sm border-0 bg-light rounded-pill">
                                <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Max: 2MB (jpg, jpeg, png)</small>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        {{-- FULL NAME --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary" for="full_name">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-user"></i></span>
                                <input type="text" name="full_name" id="full_name" class="form-control border-0 bg-light" 
                                       value="{{ old('full_name', $craftsman->full_name) }}" required>
                            </div>
                        </div>

                        {{-- PHONE NUMBER --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary" for="phone">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-phone"></i></span>
                                <input type="text" name="phone" id="phone" class="form-control border-0 bg-light" 
                                       value="{{ old('phone', $craftsman->phone) }}" placeholder="e.g. 0712345678" required>
                            </div>
                        </div>

                        {{-- SKILL CATEGORY --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary" for="skill_category">Service Type (Skill)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-tools"></i></span>
                                <input type="text" name="skill_category" id="skill_category" class="form-control border-0 bg-light" 
                                       value="{{ old('skill_category', $craftsman->skill_category) }}" placeholder="Example: Plumber, Electrician" required>
                            </div>
                        </div>

                        {{-- LOCATION NAME --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary" for="location_name">Your Location (Street/Area)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" name="location_name" id="location_name" class="form-control border-0 bg-light" 
                                       value="{{ old('location_name', $craftsman->location_name) }}" placeholder="Example: Kinondoni, Dar es Salaam" required>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                <i class="fas fa-info-circle me-1"></i> Make sure to write a well-known area name so the system can recognize your coordinates on the map.
                            </small>
                        </div>

                        {{-- BOTTOM BUTTONS --}}
                        <div class="d-grid gap-2 pt-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-2.5 fw-bold shadow-sm border-0">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                            <a href="{{ url('/dashboard') }}" class="btn btn-light rounded-pill py-2.5 fw-light text-muted">
                                Cancel & Go Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .bg-light { background-color: #f8f9fa !important; }
    .form-control:focus, .input-group-text:focus {
        background-color: #f1f3f5 !important;
        box-shadow: none;
    }
    .input-group-text {
        border-top-left-radius: 50rem;
        border-bottom-left-radius: 50rem;
    }
    .form-control {
        border-top-right-radius: 50rem;
        border-bottom-right-radius: 50rem;
    }
</style>
@endsection