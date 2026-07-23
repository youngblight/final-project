@extends('layouts.home')

@section('content')
<!-- Wrapper yenye Background laini kwa ajili ya usomaji mzuri -->
<div style="background-color: #f8fafc; color: #1e293b; min-height: 100vh;" class="py-5">
    <div class="container">
        
        <!-- Hero Section -->
        <div class="row align-items-center mb-5 p-4 bg-white rounded-4 shadow-sm">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3">Kuhusu Sisi</span>
                <h1 class="display-5 fw-bold text-dark mb-3">Kuhusu Fundi Digital</h1>
                <p class="lead text-secondary mb-3 fs-5" style="line-height: 1.7;">
                    Fundi Digital ni jukwaa la kidijitali linalokutanisha wateja na mafundi mahiri, waliothibitishwa na walio karibu nawe kwa urahisi, haraka na usalama wa hali ya juu.
                </p>
                <p class="text-muted" style="line-height: 1.6;">
                    Lengo letu kuu ni kuondoa changamoto ya kutafuta mafundi waaminifu na kutoa fursa za ajira kwa mafundi wa fani mbalimbali nchini kupitia teknolojia ya ramani na mifumo ya kisasa ya mawasiliano.
                </p>
            </div>
        </div>

        <!-- Huduma Zetu / Mambo Tunayodeal Nayo -->
        <div class="text-center my-5">
            <h2 class="fw-bold text-dark mb-2">Huduma na Mambo Tunayoyashughulikia</h2>
            <p class="text-muted fs-6">Mfumo wetu unahusisha huduma mbalimbali za ujenzi, ukarabati na matengenezo:</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Huduma 1: Umeme -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-primary-subtle rounded-circle" style="width: 75px; height: 75px; line-height: 45px;">⚡</div>
                        <h5 class="card-title fw-bold text-dark mb-2">Ufundi Umeme</h5>
                        <p class="card-text text-secondary small">Matengenezo ya mifumo ya umeme wa majumbani na maofisini, kuweka wiring mpya, na kurekebisha itilafu za umeme.</p>
                    </div>
                </div>
            </div>

            <!-- Huduma 2: Bomba na Maji -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-info-subtle rounded-circle" style="width: 75px; height: 75px; line-height: 45px;">🚰</div>
                        <h5 class="card-title fw-bold text-dark mb-2">Ufundi Bomba (Plumbing)</h5>
                        <p class="card-text text-secondary small">Ukarabati wa mabomba yaliyovuja, ufungaji wa mifumo ya maji safi na maji taka, pamoja na miundombinu ya vyoo na jikoni.</p>
                    </div>
                </div>
            </div>

            <!-- Huduma 3: Ujenzi na Ukarabati -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-warning-subtle rounded-circle" style="width: 75px; height: 75px; line-height: 45px;">🧱</div>
                        <h5 class="card-title fw-bold text-dark mb-2">Ujenzi na Urekebishaji</h5>
                        <p class="card-text text-secondary small">Mafundi wa masonry/kuta, kupiga plasta, kuweka na kurekebisha madirisha, milango na sakafu za aina zote.</p>
                    </div>
                </div>
            </div>

            <!-- Huduma 4: Seremala na Samani -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-success-subtle rounded-circle" style="width: 75px; height: 75px; line-height: 45px;">🪑</div>
                        <h5 class="card-title fw-bold text-dark mb-2">Ufundi Seremala</h5>
                        <p class="card-text text-secondary small">Utengenezaji na ukarabati wa samani za mbao kama makabati ya jikoni, vitanda, meza, na milango.</p>
                    </div>
                </div>
            </div>

            <!-- Huduma 5: Uchomeleaji (Welding) -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-danger-subtle rounded-circle" style="width: 75px; height: 75px; line-height: 45px;">👨‍🏭</div>
                        <h5 class="card-title fw-bold text-dark mb-2">Uchomeleaji (Welding)</h5>
                        <p class="card-text text-secondary small">Matengenezo na utengenezaji wa mageti, madirisha ya nondo, milango ya chuma na miundo mbalimbali ya chuma.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kwanini Uchague Fundi Digital -->
        <div class="my-5 p-4 p-md-5 bg-white rounded-4 shadow-sm">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Kwa Nini Utumie Mfumo Wa Fundi Digital?</h2>
                <p class="text-muted">Tumerahisisha kila hatua ili upate huduma bora na za kuaminika.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-light rounded-4 h-100 border-0">
                        <h5 class="fw-bold text-primary mb-2">📍 Geolocation & Ramani</h5>
                        <p class="text-secondary small mb-0">Pata fundi aliye karibu zaidi na eneo ulipo ili kupunguza muda na gharama za usafiri.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-light rounded-4 h-100 border-0">
                        <h5 class="fw-bold text-success mb-2">🛡️ Uhakiki wa Mafundi</h5>
                        <p class="text-secondary small mb-0">Mafundi wote wanasajiliwa kwa kukaguliwa vitambulisho vyao pamoja na ujuzi wao kwa usalama wako.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 bg-light rounded-4 h-100 border-0">
                        <h5 class="fw-bold text-primary mb-2">💬 Mawasiliano na Bei</h5>
                        <p class="text-secondary small mb-0">Mnaweza kuchat moja kwa moja na kukubaliana bei kabla ya kazi kuanza.</p>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</div>
@endsection