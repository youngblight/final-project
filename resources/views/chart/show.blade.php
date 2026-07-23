@extends('layouts.home')

@section('content')
<!-- Tunajihami kwa kuweka Bootstrap na FontAwesome CDN kwa ajili ya faili hili tu ikiwa kwenye layout hazipo -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Mfumo mzima wa chati hapa chini umewekewa CSS za ulinzi -->
            <div class="card shadow border-0 chat-wrapper">
                
                {{-- Kichwa cha Chati --}}
                <div class="card-header bg-primary text-white p-3 d-flex justify-content-between align-items-center header-custom">
                    <div>
                        <h5 class="mb-0 fw-bold header-title">Kazi #{{ $job->id }}</h5>
                        <small class="text-white-50"><i class="fas fa-circle text-success me-1" style="font-size: 0.6rem;"></i> Mazungumzo ya Moja kwa Moja</small>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold shadow-sm back-btn">
                        <i class="fas fa-arrow-left me-1"></i> Rudi
                    </a>
                </div>
                
                {{-- Eneo la Kusomea Ujumbe --}}
                <div class="card-body p-4 chat-body-box" id="chat-box">
                    @forelse($messages as $msg)
                        <div class="mb-3 d-flex {{ $msg->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="message-bubble {{ $msg->sender_id == auth()->id() ? 'msg-sent text-white' : 'msg-received text-dark' }}">
                                <p class="mb-1 message-text">{{ $msg->message }}</p>
                                <div class="text-end mt-1 bubble-time">
                                    <small class="{{ $msg->sender_id == auth()->id() ? 'text-white-50' : 'text-muted' }}">
                                        {{ $msg->created_at ? $msg->created_at->format('H:i') : now()->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted no-messages">
                            <div class="rounded-circle bg-light p-4 mb-3">
                                <i class="fas fa-comments fa-2x text-secondary"></i>
                            </div>
                            <h6 class="fw-bold">Hakuna ujumbe bado.</h6>
                            <p class="small text-center px-4">Anza mazungumzo na mteja/fundi hapa chini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Fomu ya Kutuma Ujumbe Mpya --}}
                <div class="card-footer bg-white border-top p-3 footer-custom">
                    <form action="{{ route('chat.send') }}" method="POST" class="w-100">
                        @csrf
                        {{-- ID muhimu zinazotumwa kimya kimya --}}
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                        
                        <div class="d-flex align-items-center w-100">
                            <div class="flex-grow-1 me-2">
                                <input type="text" name="message" class="form-control rounded-pill bg-light border-0 px-4 py-2 chat-input" placeholder="Andika ujumbe wako..." required autocomplete="off">
                            </div>
                            <div class="flex-shrink-0">
                                <button type="submit" class="btn btn-primary rounded-circle shadow d-flex align-items-center justify-content-center send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Javascript fupi ya kufanya chati ishushe chini yenyewe ukifungua --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var chatBox = document.getElementById("chat-box");
        if(chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
</script>


@endsection