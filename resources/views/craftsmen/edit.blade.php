@extends('layouts.craftsmen')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            {{-- Ujumbe wa Mafanikio (Success Alert) --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="collapse" data-bs-target=".alert" aria-label="Funga"></button>
                </div>
            @endif

            {{-- Ujumbe wa Makosa ya Uthibitishaji (Validation Errors) --}}
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- KADI YA FOMU --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4 border-0">
                    <h5 class="fw-bold mb-0">Hariri Profaili Yako</h5>
                    <p class="small mb-0 text-white-50">Huisha maelezo ya kazi na upatikanaji wa eneo lako</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('craftsmen.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- SEHEMU YA PICHA --}}
                        <div class="mb-4 text-center">
                            <label class="form-label d-block fw-bold small text-muted mb-3">Picha ya Profaili</label>
                            <div class="position-relative d-inline-block">
                                @php
                                    $profileImg = $craftsman->profile_photo 
                                        ? asset('storage/' . $craftsman->profile_photo) 
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($craftsman->full_name) . '&background=0d6efd&color=fff';
                                @endphp
                                <img src="{{ $profileImg }}" 
                                     class="rounded-circle shadow-sm border border-2 border-white" 
                                     style="width: 120px; height: 120px; object-fit: cover;"
                                     alt="Picha ya Profaili">
                            </div>
                            <div class="mt-3 mx-auto" style="max-width: 250px;">
                                <input type="file" name="profile_photo" class="form-control form-control-sm border-0 bg-light rounded-pill">
                                <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Mwisho: 2MB (jpg, jpeg, png)</small>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        {{-- JINA KAMILI --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary" for="full_name">Jina Kamili</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-user"></i></span>
                                <input type="text" name="full_name" id="full_name" class="form-control border-0 bg-light" 
                                       value="{{ old('full_name', $craftsman->full_name) }}" required>
                            </div>
                        </div>

                        {{-- NAMBA YA SIMU --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary" for="phone">Namba ya Simu</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-phone"></i></span>
                                <input type="text" name="phone" id="phone" class="form-control border-0 bg-light" 
                                       value="{{ old('phone', $craftsman->phone) }}" placeholder="Mfano: 0712345678" required>
                            </div>
                        </div>

                        {{-- KATEGORi YA UJUZI --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-secondary" for="skill_category">Aina ya Huduma (Ujuzi)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-tools"></i></span>
                                <input type="text" name="skill_category" id="skill_category" class="form-control border-0 bg-light" 
                                       value="{{ old('skill_category', $craftsman->skill_category) }}" placeholder="Mfano: Fundi Bomba, Fundi Umeme" required>
                            </div>
                        </div>

                        {{-- JINA LA ENEO --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-secondary" for="location_name">Eneo Unalopatikana (Mtaa/Wilaya)</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light text-muted"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" name="location_name" id="location_name" class="form-control border-0 bg-light" 
                                       value="{{ old('location_name', $craftsman->location_name) }}" placeholder="Mfano: Kinondoni, Dar es Salaam" required>
                            </div>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                <i class="fas fa-info-circle me-1"></i> Hakikisha unaandika jina la eneo linalojulikana vizuri ili mfumo uweze kutambua viwianishi (coordinates) vyako kwenye ramani.
                            </small>
                        </div>

                        {{-- VITUFE VYA CHINI --}}
                        <div class="d-grid gap-2 pt-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-2.5 fw-bold shadow-sm border-0">
                                <i class="fas fa-save me-2"></i>Hifadhi Mabadiliko
                            </button>
                            <a  href="{{ route('craftsmen.dashboard') }}" class="btn btn-light rounded-pill py-2.5 fw-light text-muted">
                                Ghairi & Rudi Nyuma
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