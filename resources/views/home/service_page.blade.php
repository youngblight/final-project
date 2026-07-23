@extends('layouts.home')

@section('content')
<div style="background-color: #f8fafc; color: #1e293b; min-height: 100vh;" class="py-5">
    <div class="container">
        
        <!-- Header Section -->
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3">Huduma Zetu</span>
            <h1 class="display-5 fw-bold text-dark">Huduma Zinazopatikana</h1>
            <p class="text-muted fs-6 max-w-2xl mx-auto">Chagua aina ya ufundi unaoitaji kupata mafundi mahiri na waliothibitishwa walio karibu nawe.</p>
        </div>

        <!-- Grid ya Huduma Kuu 5 -->
        <div class="row g-4 justify-content-center">
            
            <!-- 1. Ufundi Umeme -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-primary-subtle rounded-circle" style="width: 80px; height: 80px; line-height: 50px;">⚡</div>
                        <h4 class="card-title fw-bold text-dark mb-3">Ufundi Umeme</h4>
                        <p class="card-text text-secondary small mb-4">
                            Kuweka wiring mpya majumbani na maofisini, kurekebisha itilafu za umeme, kufunga taa, soketi, breaka, na vifaa vyote vya umeme kwa usalama.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-bold">Tafuta Fundi</a>
                    </div>
                </div>
            </div>

            <!-- 2. Ufundi Bomba (Plumbing) -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-info-subtle rounded-circle" style="width: 80px; height: 80px; line-height: 50px;">🚰</div>
                        <h4 class="card-title fw-bold text-dark mb-3">Ufundi Bomba (Plumbing)</h4>
                        <p class="card-text text-secondary small mb-4">
                            Ukarabati wa mabomba yaliyovuja au kuziba, ufungaji wa mifumo ya maji safi na taka, matangi ya maji, vyoo, na masinki ya jikoni.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-bold">Tafuta Fundi</a>
                    </div>
                </div>
            </div>

            <!-- 3. Ujenzi na Urekebishaji -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-warning-subtle rounded-circle" style="width: 80px; height: 80px; line-height: 50px;">🧱</div>
                        <h4 class="card-title fw-bold text-dark mb-3">Ujenzi na Urekebishaji</h4>
                        <p class="card-text text-secondary small mb-4">
                            Ujenzi wa kuta za tofali, kupiga plasta, kuweka na kurekebisha tiles za sakafu na ukutani, pamoja na marekebisho madogo ya majengo.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-bold">Tafuta Fundi</a>
                    </div>
                </div>
            </div>

            <!-- 4. Ufundi Seremala -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-success-subtle rounded-circle" style="width: 80px; height: 80px; line-height: 50px;">🪑</div>
                        <h4 class="card-title fw-bold text-dark mb-3">Ufundi Seremala</h4>
                        <p class="card-text text-secondary small mb-4">
                            Utengenezaji na ukarabati wa samani za mbao kama makabati ya jikoni na vyumbani, milango ya mbao, vitanda, meza, na zaiforiki.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-bold">Tafuta Fundi</a>
                    </div>
                </div>
            </div>

            <!-- 5. Uchomeleaji (Welding) -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="card-body text-center">
                        <div class="mb-3 fs-1 p-3 d-inline-block bg-danger-subtle rounded-circle" style="width: 80px; height: 80px; line-height: 50px;">👨‍🏭</div>
                        <h4 class="card-title fw-bold text-dark mb-3">Uchomeleaji (Welding)</h4>
                        <p class="card-text text-secondary small mb-4">
                            Utengenezaji na ukarabati wa mageti ya chuma, madirisha na milango ya nondo, grills, pamoja na miundo yote ya vyuma.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary rounded-pill px-4 btn-sm fw-bold">Tafuta Fundi</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Jinsi Inavyofanya Kazi -->
        <div class="my-5 p-4 p-md-5 bg-white rounded-4 shadow-sm">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">Hatua 3 Za Kupata Huduma</h2>
                <p class="text-muted">Ni rahisi na haraka kupata fundi unayemhitaji.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="fs-2 text-primary fw-bold mb-2">1</div>
                        <h5 class="fw-bold text-dark mb-2">Chagua Huduma</h5>
                        <p class="text-secondary small mb-0">Tafuta aina ya ufundi unaoitaji kwenye mfumo wetu.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="fs-2 text-primary fw-bold mb-2">2</div>
                        <h5 class="fw-bold text-dark mb-2">Pata Fundi Karibu Nawe</h5>
                        <p class="text-secondary small mb-0">Mfumo unakuletea mafundi walio karibu kulingana na ramani (geolocation).</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3">
                        <div class="fs-2 text-primary fw-bold mb-2">3</div>
                        <h5 class="fw-bold text-dark mb-2">Chat na Kubaliana Bei</h5>
                        <p class="text-secondary small mb-0">Wasiliana moja kwa moja na fundi, kubaliana bei na anza kazi!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection