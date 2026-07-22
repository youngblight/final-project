@extends('layouts.home')

@section('title', 'Nyumbani - Fundi Digital')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

<style>
    #map {
        height: 500px;
        width: 100%;
        background-color: #eee;
        border-radius: 0 0 8px 8px;
    }
    .service-card {
        transition: 0.3s;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .hero-section {
        background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), url('https://img.freepik.com/free-photo/construction-worker-tools_23-2148743105.jpg');
        background-size: cover;
        background-position: center;
    }
    
    /* Payment and Rating Styles */
    .payment-card { 
        background: #f8f9fa; 
        border: 1px solid #e2e8f0; 
        color: #334155; 
        border-radius: 15px; 
    }
    .tigo-bg { background-color: #0033a0; color: white; }
    .rating-container { direction: rtl; display: inline-flex; }
    .rating-container input { display: none; }
    .rating-container label { color: #ddd !important; font-size: 40px; padding: 0 5px; cursor: pointer; transition: 0.2s; }
    .rating-container label:hover, .rating-container label:hover ~ label,
    .rating-container input:checked ~ label { color: #ffc107 !important; }
    .star-rating-public { color: #ffc107 !important; font-size: 0.9rem; }
    .star-rating-empty { color: #ccc !important; font-size: 0.9rem; }
    
    /* Comments / Review Styles */
    .review-card { 
        border-left: 3px solid #0d6efd; 
        background: #f8f9fa;
        transition: all 0.2s ease-in-out;
    }
    .review-card:hover {
        background: #f1f5f9;
    }
</style>

@section('content')
    {{-- 1. UJUMBE WA MAFANIKIO NA FOMU YA UKADIRIAJI --}}
    @if(session('payment_success'))
        <div class="container mt-4 text-center">
            <div class="card p-5 shadow rounded-4 border-0">
                <div class="mb-3">
                    <i class="fas fa-check-circle fa-4x text-success"></i>
                </div>
                <h2 class="text-success fw-bold">Malipo Yamepokelewa!</h2>
                <p class="lead text-muted">{{ session('payment_success') }}</p>
                
                @if(session('show_rating'))
                    <hr class="my-4">
                    <div class="rating-section mt-4">
                        <h5 class="fw-bold mb-3 text-dark">Mpe Alama Fundi (Ukadiriaji)</h5>
                        <form action="{{ route('job.rate', session('job_id')) }}" method="POST">
                            @csrf
                            <div class="rating-container mb-3">
                                <input type="radio" name="rating" value="5" id="star5" required><label for="star5"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating" value="4" id="star4"><label for="star4"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating" value="3" id="star3"><label for="star3"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating" value="2" id="star2"><label for="star2"><i class="fas fa-star"></i></label>
                                <input type="radio" name="rating" value="1" id="star1"><label for="star1"><i class="fas fa-star"></i></label>
                            </div>
                            <div class="mb-3">
                                <textarea name="comment" class="form-control rounded-4 mx-auto shadow-sm" style="max-width: 450px;" rows="3" placeholder="Andika maoni yako hapa..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Tuma Maoni</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- 2. SEHEMU YA HERO --}}
    <section class="hero-section text-center py-5 border-bottom">
        <div class="container py-4">
            <h1 class="display-4 fw-bold text-dark">Watafute Mafundi Stadi na Waaminifu Karibu Nawe</h1>
            <p class="lead text-muted">Tunakuunganisha na mafundi bomba, mafundi umeme, waashi, na wengine wengi walio bobea.</p>
            <div class="row justify-content-center mt-4"></div>
        </div>
    </section>

    {{-- 3. LOGIC YA KAZI BINFASI (NOTIFICATIONS / CHAT / HALI YA KAZI & TIGO PESA) --}}
    @if(auth()->check())
        @php
            $active_job = \App\Models\JobRequest::with('craftsmen')
                        ->where('user_id', auth()->id())
                        ->whereIn('status', ['accepted', 'offer_sent', 'in_progress', 'completed']) 
                        ->latest()
                        ->first();
        @endphp

        @if($active_job && !session('payment_success'))
            <div class="container mt-4">

                {{-- SEHEMU MPYA: TAARIFA YA UJUMBE / NOTIFICATION YA CHAT KUTOKA KWA FUNDI --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <div class="position-relative me-3">
                                    <div class="rounded-circle bg-white text-primary p-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                        <i class="fas fa-comments fa-2x"></i>
                                    </div>
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden">Ujumbe Mpya</span>
                                    </span>
                                </div>
                                <div>
                                    <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-1 mb-1" style="font-size: 0.75rem;">
                                        <i class="fas fa-user-circle me-1"></i> Fundi: {{ $active_job->craftsmen->full_name ?? 'Mtaalamu' }}
                                    </span>
                                    <h5 class="fw-bold mb-1">
                                        @if($active_job->status == 'accepted')
                                            Fundi amekubali ombi lako! Mnaweza kuchat sasa.
                                        @elseif($active_job->status == 'offer_sent')
                                            Fundi ametuma Ofa ya Bei! (Tsh {{ number_format($active_job->agreed_price) }})
                                        @elseif($active_job->status == 'in_progress')
                                            Kazi inaendelea. Tumia chat kuwasiliana na fundi.
                                        @elseif($active_job->status == 'completed')
                                            Kazi imekamilika! Angalia maelezo ya mwisho au chati.
                                        @endif
                                    </h5>
                                    @if($active_job->fundi_response)
                                        <p class="mb-0 small text-white-50 text-truncate" style="max-width: 500px;">
                                            <i class="fas fa-quote-left me-1"></i> "{{ $active_job->fundi_response }}"
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <a href="{{ url('/chat/' . $active_job->id) }}" class="btn btn-light btn-lg px-4 rounded-pill fw-bold text-primary shadow-sm">
                                    <i class="fas fa-paper-plane me-2"></i> Fungua Chat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEHEMU YA MALIPO (KAMA FUNDI AMESHAWEKA BEI) --}}
                @if(($active_job->status == 'offer_sent' || $active_job->status == 'accepted' || $active_job->status == 'completed') && $active_job->agreed_price > 0)
                    <div class="card payment-card shadow-lg p-4 mb-4">
                        <div class="d-md-flex align-items-center justify-content-between text-center text-md-start">
                            <div>
                                <h5 class="fw-bold mb-1">
                                    {{ $active_job->status == 'completed' ? 'Kazi Imeisha, Lipa 50% ya Mwisho' : 'Lipa Akaunti ya Kwanza (Kiporo 50%)' }}
                                </h5>
                                <p class="mb-0 opacity-75">Jumla ya Bei Aliyotuma Fundi: <strong>Tsh {{ number_format($active_job->agreed_price) }}</strong></p>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <button class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow" data-bs-toggle="modal" data-bs-target="#tigoModal">
                                    Lipa Tsh {{ number_format($active_job->agreed_price / 2) }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @if($active_job->status == 'in_progress')
                    <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 mb-4 d-flex align-items-center">
                        <div class="spinner-border text-info me-3"></div>
                        <div>
                            <h5 class="fw-bold mb-0">Fundi anashughulikia ombi lako...</h5>
                            <small>Malipo ya awali yamepokelewa. Kazi inaendelea kwa sasa.</small>
                        </div>
                    </div>
                @endif
            </div>

            {{-- TIGO MODAL --}}
            <div class="modal fade" id="tigoModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content rounded-4 border-0 shadow-lg">
                        <div class="modal-header tigo-bg text-white border-0">
                            <h6 class="modal-title w-100 text-center fw-bold">TIGO PESA</h6>
                        </div>
                        <div class="modal-body p-4 text-center">
                            <form action="{{ route('payment.process', $active_job->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" value="Tigo Pesa">
                                <div class="mb-4">
                                    <p class="text-muted small mb-1">Kiasi cha Kulipa</p>
                                    <h3 class="fw-bold text-primary">Tsh {{ number_format($active_job->agreed_price / 2) }}</h3>
                                </div>
                                <input type="number" name="phone_number" class="form-control mb-3 text-center rounded-pill" placeholder="07XXXXXXXX" required>
                                <input type="password" name="pin" class="form-control mb-4 text-center rounded-pill" placeholder="Namba ya Siri" required>
                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">LIPA SASA</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    {{-- 4. SEHEMU YA HUDUMA --}}
    <section class="container mt-5">
        <h2 class="text-center fw-bold mb-4">Huduma Zetu za Kitaalamu</h2>
        <div class="row g-4">
            @forelse($services as $service)
                <div class="col-md-3 col-sm-6">
                    <div class="card text-center shadow-sm border-0 h-100 service-card">
                        <div class="p-3">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top rounded shadow-sm" alt="{{ $service->name }}" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-primary text-white rounded py-4">
                                    <i class="fas {{ $service->icon ?? 'fa-tools' }} fa-3x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body pt-0">
                            <h5 class="fw-bold">{{ $service->name }}</h5>
                            <p class="small text-muted mb-3">
                                <i class="fas fa-users me-1 text-primary"></i> 
                                Mafundi <strong>{{ $service->craftsmen_count ?? 0 }}</strong> Wapo Tayari
                            </p>
                            <a href="{{ route('services.craftsmen', $service->slug) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill">
                                Angalia Mafundi
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Hakuna huduma zilizopatikana kwa sasa.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Sehemu ya Ramani --}}
    <section class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow border-0 overflow-hidden" style="border-radius: 15px;">
                    <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fs-5"><i class="fas fa-map-marker-alt me-2"></i> Mafundi Wanaopatikana Kwenye Eneo Lako</h4>
                        <span class="badge bg-white text-primary">Alama {{ count($craftsmen) }} Zipo Hewani</span>
                    </div>
                    <div class="card-body p-0">
                        <div id="map"></div>
                    </div>
                    <div class="card-footer bg-light text-center py-2">
                        <small class="text-muted italic"><i class="fas fa-info-circle me-1"></i> Bonyeza kwenye alama ili kuona maelezo ya mawasiliano ya fundi.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. MAFUNDI WANAOPENDEDEKEZWA (VIWANGO NA MAONI/COMMENTS SECTION) --}}
    <section class="container mt-5 mb-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0">Mafundi Wanaopendekezwa</h3>
            <span class="badge bg-primary rounded-pill">Wataalamu Wetu</span>
        </div>

        <div class="row g-4">
            @foreach($craftsmen->take(12) as $fundi)
                @php
                    $avgRating = \App\Models\JobRequest::where('craftsman_id', $fundi->id)
                                ->whereNotNull('rating')
                                ->avg('rating') ?? 0;

                    // Inachukua maoni ya hivi karibuni zaidi kutoka kwa mteja mmoja tu
                    $latestReview = \App\Models\JobRequest::where('craftsman_id', $fundi->id)
                                    ->whereNotNull('comment')
                                    ->with('user')
                                    ->latest()
                                    ->first();

                    $picha_ya_fundi = $fundi->profile_image ?? ($fundi->image ?? ($fundi->avatar ?? null));
                @endphp

                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3 d-flex flex-column">
                        
                        {{-- PICHA NA JINA LA FUNDI --}}
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                @if($picha_ya_fundi)
                                    <img src="{{ asset('storage/' . $picha_ya_fundi) }}" 
                                         class="rounded-circle border border-2 border-primary shadow-sm" 
                                         style="width: 55px; height: 55px; object-fit: cover;" 
                                         alt="{{ $fundi->full_name }}">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($fundi->full_name) }}&background=0d6efd&color=fff&bold=true" 
                                         class="rounded-circle border border-2 border-primary shadow-sm" 
                                         style="width: 55px; height: 55px; object-fit: cover;" 
                                         alt="{{ $fundi->full_name }}">
                                @endif
                            </div>
                            <div class="ms-3">
                                <h6 class="fw-bold mb-0 text-dark" style="letter-spacing: 0.5px;">{{ $fundi->full_name }}</h6>
                                <small class="text-muted fw-semibold">{{ $fundi->skill_category }}</small>
                            </div>
                        </div>

                        {{-- WASTANI WA NYOTA --}}
                        <div class="mb-3 mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= round($avgRating) ? 'star-rating-public' : 'star-rating-empty' }}"></i>
                            @endfor
                            <span class="small text-muted ms-1 fw-bold">({{ number_format($avgRating, 1) }})</span>
                        </div>

                        {{-- SEHEMU MPYA: MAONI YA HIVI KARIBUNI YA MTEJA --}}
                        <div class="flex-grow-1">
                            @if($latestReview)
                                <div class="review-card p-3 rounded-3 shadow-sm border-0 bg-light">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($latestReview->user->name ?? 'Mteja') }}&background=6c757d&color=fff&size=32" 
                                             class="rounded-circle me-2" 
                                             style="width: 24px; height: 24px;" 
                                             alt="Mteja">
                                        <div class="lh-1">
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.75rem;">
                                                {{ $latestReview->user->name ?? 'Mteja Aliyethibitishwa' }}
                                            </span>
                                            @if($latestReview->created_at)
                                                <small class="text-muted" style="font-size: 0.65rem;">
                                                    {{ $latestReview->created_at->diffForHumans() }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="small text-secondary mb-0 fst-italic" style="font-size: 0.8rem; line-height: 1.3;">
                                        <i class="fas fa-quote-left text-primary opacity-50 me-1"></i>
                                        {{ Str::limit($latestReview->comment, 75) }}
                                    </p>
                                </div>
                            @else
                                <div class="text-center py-3 bg-light rounded-3">
                                    <i class="far fa-comment-dots text-muted mb-1 d-block" style="font-size: 1.2rem;"></i>
                                    <small class="text-muted italic" style="font-size: 0.75rem;">Bado hajapokea maoni.</small>
                                </div>
                            @endif
                        </div>

                        <div class="mt-auto pt-3">
                            <a href="{{ route('services.craftsmen', Str::slug($fundi->skill_category)) }}" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-bold py-2">Mpe Kazi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Nyaraka za JavaScript --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    window.addEventListener('load', function() {
        var mapContainer = document.getElementById('map');
        if (!mapContainer || typeof L === 'undefined') return;

        var map = L.map('map').setView([-6.7924, 39.2083], 12); 

        // Tiles za CartoDB Voyager
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
        }).addTo(map);

        var craftsmenData = {!! json_encode($craftsmen) !!};

        craftsmenData.forEach(function(fundi) {
            if(fundi.latitude && fundi.longitude) {
                var marker = L.marker([fundi.latitude, fundi.longitude]).addTo(map);
                
                var popupHtml = `
                    <div style="font-family: 'Poppins', sans-serif; min-width: 180px; padding: 5px;">
                        <h6 style="margin: 0 0 5px 0; font-weight: bold; color: #0d6efd;">${fundi.full_name}</h6>
                        
                        <p style="margin: 0 0 4px 0; font-size: 13px;">
                            <span class="badge bg-info text-dark">${fundi.skill_category}</span>
                        </p>
                        
                        <p style="margin: 0 0 8px 0; font-size: 12px; color: #6c757d; font-weight: 500;">
                            <i class="fas fa-map-marker-alt text-danger me-1"></i> ${fundi.location_name ?? 'Eneo Halijatajwa'}
                        </p>
                        
                        <a href="tel:${fundi.phone}" class="btn btn-sm btn-success w-100" style="color:white; text-decoration:none; display:block; text-align:center; padding: 6px; border-radius: 5px; font-weight: bold;">
                           <i class="fas fa-phone-alt me-1"></i> ${fundi.phone}
                        </a>
                    </div>
                `;
                marker.bindPopup(popupHtml);
            }
        });

        setTimeout(function(){ 
            map.invalidateSize();
        }, 500);
    });
</script>
@endsection