@extends('layouts.home')

@section('content')

<div class="container py-5" style="min-height: 75vh; display: flex; flex-direction: column; justify-content: center;">
    <div class="row justify-content-center my-auto">
        
        {{-- 1. PROFILE CARD --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 text-center p-4 rounded-4 h-100 bg-white">
                {{-- Craftsman Profile Image --}}
                @php
                    $profileImg = $craftsman->profile_photo 
                        ? asset('storage/' . $craftsman->profile_photo) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode($craftsman->full_name) . '&background=0d6efd&color=fff';
                @endphp
                <img src="{{ $profileImg }}" 
                     class="rounded-circle mx-auto mb-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover;" alt="Craftsman Profile">
                
                <h4 class="fw-bold mb-1">{{ $craftsman->full_name }}</h4>
                <p class="text-muted mb-3">{{ $craftsman->skill_category }}</p>
                
                {{-- Star Rating Component --}}
                <div class="mb-3">
                    @php 
                        $rating = 0;
                        if(isset($craftsman->jobs)) {
                            $rating = $craftsman->jobs->whereNotNull('rating')->avg('rating') ?? 0;
                        }
                    @endphp
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star" style="color: {{ $i <= $rating ? '#ffc107' : '#e0e0e0' }};"></i>
                    @endfor
                    <span class="ms-2 text-muted">({{ number_format($rating, 1) }})</span>
                </div>

                <div class="badge bg-success px-3 py-2 rounded-pill text-uppercase mb-3">Verified Professional</div>
                
                @if(!auth()->check() || (auth()->check() && !isset($active_job)))
                    <button class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#orderModal">
                        <i class="fas fa-paper-plane me-2"></i>Request Service Now
                    </button>
                @endif
            </div>
        </div>

        {{-- 2. PROGRESS & CHAT SECTION --}}
        <div class="col-md-8 mb-4">
            @if(auth()->check() && isset($active_job) && $active_job->user_id == auth()->id())
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4 bg-white">
                    <h6 class="text-center fw-bold text-uppercase small mb-4">Service Progress</h6>
                    
                    <div class="d-flex justify-content-between align-items-center position-relative mb-5" style="z-index: 1;">
                        <div style="position: absolute; top: 50%; left: 0; right: 0; height: 2px; background: #e0e0e0; z-index: -1;"></div>
                        
                        <div class="text-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-paper-plane small"></i>
                            </div>
                            <span class="small fw-bold d-block">Sent</span>
                        </div>

                        <div class="text-center">
                            <div class="rounded-circle {{ in_array($active_job->status, ['accepted', 'in_progress', 'completed', 'fully_paid']) ? 'bg-primary text-white' : 'bg-white border text-muted' }} d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-user-check small"></i>
                            </div>
                            <span class="small fw-bold d-block">Accepted</span>
                        </div>

                        <div class="text-center">
                            <div class="rounded-circle {{ in_array($active_job->status, ['in_progress', 'completed', 'fully_paid']) ? 'bg-primary text-white' : 'bg-white border text-muted' }} d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-tools small"></i>
                            </div>
                            <span class="small fw-bold d-block">Ongoing</span>
                        </div>

                        <div class="text-center">
                            <div class="rounded-circle {{ in_array($active_job->status, ['completed', 'fully_paid']) ? 'bg-success text-white' : 'bg-white border text-muted' }} d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-check-double small"></i>
                            </div>
                            <span class="small fw-bold d-block">Finished</span>
                        </div>
                    </div>

                    @if($active_job->fundi_response)
                        <div class="p-3 border-start border-primary border-4 rounded-3 bg-light">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold small text-primary mb-2">Craftsman's Message:</h6>
                                <small class="text-muted">{{ $active_job->updated_at ? $active_job->updated_at->diffForHumans() : '' }}</small>
                            </div>
                            <p class="mb-0 italic">{{ $active_job->fundi_response }}</p>
                            @if($active_job->agreed_price)
                                <div class="mt-2 fw-bold text-success">Cost: Tsh {{ number_format($active_job->agreed_price) }}</div>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info py-2 small">
                            <i class="fas fa-clock me-1"></i> Please wait for the craftsman to accept your request and offer a price estimation.
                        </div>
                    @endif
                </div>

                @if($active_job->status == 'in_progress')
                    <div class="card shadow-sm border-0 rounded-4 p-3 bg-white">
                        <h6 class="fw-bold mb-3"><i class="fas fa-comments me-2 text-primary"></i>Chat with Craftsman</h6>
                        <p class="small text-muted italic">You can now communicate directly to execute and track work milestones through your Dashboard.</p>
                    </div>
                @endif

            @else
                <div class="card shadow-sm border-0 rounded-4 p-5 text-center bg-white h-100 d-flex flex-column justify-content-center" style="min-height: 320px;">
                    <i class="fas fa-briefcase fa-3x text-light mb-3"></i>
                    <h5 class="fw-bold">Start a Project with {{ $craftsman->full_name }}</h5>
                    <p class="text-muted">Click the 'Request Service' button to open a conversation channel with this professional regarding your task requirements.</p>
                </div>
            @endif
        </div>

    </div>
</div>

{{-- SUBMIT JOB REQUEST MODAL --}}
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h5 class="modal-title fw-bold">Describe Your Requirements</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            @if(auth()->check())
                <form action="{{ route('job.request.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="craftsman_id" value="{{ $craftsman->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Service Category</label>
                            <input type="text" class="form-control bg-light border-0 fw-bold" value="{{ $craftsman->skill_category }}" readonly>
                        </div>

                        {{-- SECURITY MIGRATION: Guarding fallback strings against guest crash context --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Your Phone Number</label>
                            <input type="tel" name="customer_phone" class="form-control border-0 bg-light" 
                                   value="{{ auth()->user()->phone ?? auth()->user()->phone_number ?? '' }}" 
                                   placeholder="Example: 0712345678" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Describe Your Issue</label>
                            <textarea name="job_description" class="form-control border-0 bg-light" rows="4" placeholder="Example: My kitchen pipe is leaking, I need an expert plumber to patch it up..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Your Location (Street/Area)</label>
                            <input type="text" name="location" class="form-control border-0 bg-light" placeholder="e.g. Kinondoni, Manyanya Street" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Send Job Request</button>
                    </div>
                </form>
            @else
                {{-- Fallback UI view when the user session is unauthorized (Logged Out) instead of empty container blocks --}}
                <div class="modal-body p-5 text-center">
                    <i class="fas fa-user-lock fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold text-dark">Authentication Required</h5>
                    <p class="text-muted small">You must be signed into an active user account to transmit work milestone requests to this professional.</p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">Login</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .italic { font-style: italic; }
    .bg-light { background-color: #f8f9fa !important; }
    .card { border-radius: 1rem; }
</style>
@endsection