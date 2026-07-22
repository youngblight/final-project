@extends('layouts.home')

@section('content')

{{-- Ongeza Bootstrap JS ikiwa layout haina ili Modal ifanye kazi --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container py-5" style="min-height: 75vh; display: flex; flex-direction: column; justify-content: center;">

    <div class="row justify-content-center my-auto">
        
        {{-- 1. PROFILE CARD --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 text-center p-4 rounded-4 h-100 bg-white">
                @php
                    $profileImg = $craftsman->profile_photo 
                        ? asset('storage/' . $craftsman->profile_photo) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode($craftsman->full_name) . '&background=0d6efd&color=fff';
                @endphp
                <img src="{{ $profileImg }}" 
                     class="rounded-circle mx-auto mb-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover;" alt="Profaili ya Fundi">
                
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

                <div class="badge bg-success px-3 py-2 rounded-pill text-uppercase mb-3">Fundi Aliyethibitishwa</div>
                
                @if(!auth()->check() || (auth()->check() && !isset($active_job)))
                    <button class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#orderModal">
                        <i class="fas fa-paper-plane me-2"></i>Omba Huduma Sasa
                    </button>
                @endif
            </div>
        </div>

        {{-- 2. PROGRESS & CHAT SECTION --}}
        <div class="col-md-8 mb-4">
            @if(auth()->check() && isset($active_job) && $active_job->user_id == auth()->id())
                {{-- Hatua za Huduma --}}
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4 bg-white">
                    <h6 class="text-center fw-bold text-uppercase small mb-4">Hatua za Huduma</h6>
                    
                    <div class="d-flex justify-content-between align-items-center position-relative mb-4" style="z-index: 1;">
                        <div style="position: absolute; top: 50%; left: 0; right: 0; height: 2px; background: #e0e0e0; z-index: -1;"></div>
                        
                        <div class="text-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-paper-plane small"></i>
                            </div>
                            <span class="small fw-bold d-block">Imetumwa</span>
                        </div>

                        <div class="text-center">
                            <div class="rounded-circle {{ in_array($active_job->status, ['accepted', 'in_progress', 'completed', 'fully_paid']) ? 'bg-primary text-white' : 'bg-white border text-muted' }} d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-user-check small"></i>
                            </div>
                            <span class="small fw-bold d-block">Imekubaliwa</span>
                        </div>

                        <div class="text-center">
                            <div class="rounded-circle {{ in_array($active_job->status, ['in_progress', 'completed', 'fully_paid']) ? 'bg-primary text-white' : 'bg-white border text-muted' }} d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-tools small"></i>
                            </div>
                            <span class="small fw-bold d-block">Inatekelezwa</span>
                        </div>

                        <div class="text-center">
                            <div class="rounded-circle {{ in_array($active_job->status, ['completed', 'fully_paid']) ? 'bg-success text-white' : 'bg-white border text-muted' }} d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 40px; height: 40px;">
                                <i class="fas fa-check-double small"></i>
                            </div>
                            <span class="small fw-bold d-block">Imekamilika</span>
                        </div>
                    </div>
                </div>

                {{-- MAZUNGUMZO YA CHAT --}}
                <div class="card shadow-sm border-0 rounded-4 bg-white overflow-hidden">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-comments text-primary me-2"></i>Mazungumzo na {{ $craftsman->full_name }}
                        </h6>
                        <span class="badge bg-light text-success border border-success-subtle rounded-pill">Muda Wowote</span>
                    </div>

                    <div class="card-body chat-box-area bg-light p-3" id="chatWindow" style="height: 350px; overflow-y: auto;">
                        @if(isset($messages) && $messages->count() > 0)
                            @foreach($messages as $msg)
                                <div class="d-flex mb-3 {{ $msg->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                                    <div class="p-3 rounded-3 max-width-70 shadow-xs {{ $msg->sender_id == auth()->id() ? 'bg-primary text-white rounded-tr-0' : 'bg-white text-dark border rounded-tl-0' }}">
                                        <p class="mb-1 small">{{ $msg->message }}</p>
                                        <div class="text-end" style="font-size: 0.7rem; opacity: 0.8;">
                                            {{ $msg->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex mb-3 justify-content-start">
                                <div class="p-3 rounded-3 bg-white border text-dark max-width-70 rounded-tl-0">
                                    <p class="mb-0 small">Habari, hapa unaweza kuwasiliana na fundi wako moja kwa moja muda wowote kuhusu kazi hii.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer bg-white border-top p-3">
                        <form action="{{ route('chat.send') }}" method="POST" id="chatForm">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $active_job->id }}">
                            <input type="hidden" name="receiver_id" value="{{ $craftsman->user_id }}">
                            
                            <div class="input-group">
                                <input type="text" name="message" class="form-control border bg-light rounded-start-pill px-3" placeholder="Andika ujumbe wako hapa..." required autocomplete="off">
                                <button type="submit" class="btn btn-primary rounded-end-pill px-4">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            @else
                <div class="card shadow-sm border-0 rounded-4 p-5 text-center bg-white h-100 d-flex flex-column justify-content-center" style="min-height: 320px;">
                    <i class="fas fa-briefcase fa-3x text-light mb-3"></i>
                    <h5 class="fw-bold">Anza Kazi na {{ $craftsman->full_name }}</h5>
                    <p class="text-muted">Bonyeza kitufe cha 'Omba Huduma Sasa' ili kufungua uwanja wa mazungumzo na fundi huyu kuhusu mahitaji ya kazi yako.</p>
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
                <h5 class="modal-title fw-bold">Eleza Mahitaji Yako</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            @if(auth()->check())
                <form action="{{ route('job.request.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <input type="hidden" name="craftsman_id" value="{{ $craftsman->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Aina ya Huduma</label>
                            <input type="text" class="form-control bg-light border-0 fw-bold" value="{{ $craftsman->skill_category }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Namba Yako ya Simu</label>
                            <input type="tel" name="customer_phone" class="form-control border-0 bg-light" 
                                   value="{{ auth()->user()->phone_number ?? auth()->user()->phone ?? '' }}" 
                                   placeholder="Mfano: 0712345678" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Eleza Tatizo Lako</label>
                            <textarea name="job_description" class="form-control border-0 bg-light" rows="4" placeholder="Mfano: Bomba la jikoni linavuja..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Eneo Ulipo (Mtaa/Kata)</label>
                            <input type="text" name="location" class="form-control border-0 bg-light" placeholder="Mf. Kinondoni, Mtaa wa Manyanya" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Ghairi</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Tuma Ombi la Kazi</button>
                    </div>
                </form>
            @else
                <div class="modal-body p-5 text-center">
                    <i class="fas fa-user-lock fa-3x text-warning mb-3"></i>
                    <h5 class="fw-bold text-dark">Unatakiwa Kuingia Kwanza</h5>
                    <p class="text-muted small">Ni lazima uingie kwenye akaunti yako ili uweze kutuma maombi ya kazi kwa fundi huyu.</p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">Ingia (Login)</a>
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
    .max-width-70 { max-width: 75%; }
    .rounded-tr-0 { border-top-right-radius: 0 !important; }
    .rounded-tl-0 { border-top-left-radius: 0 !important; }
    .shadow-xs { box-shadow: 0 .125rem .25rem rgba(0,0,0,.04)!important; }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var chatWindow = document.getElementById('chatWindow');
        if(chatWindow) {
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    });
</script>
@endsection