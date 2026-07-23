@extends('layouts.home')

@section('content')
<!-- Wrapper yenye Background laini kwa ajili ya usomaji mzuri -->
<div style="background-color: #f8fafc; color: #1e293b; min-height: 100vh;" class="py-5">
    <div class="container">
        
        <!-- Header Section -->
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3">Mawasiliano</span>
            <h1 class="display-5 fw-bold text-dark">Wasiliana Nasi</h1>
            <p class="text-muted fs-6 max-w-2xl mx-auto">Una swali, maoni, au unahitaji msaada wowote? Wasiliana na timu ya Fundi Digital hapa chini.</p>
        </div>

        <div class="row g-4">
            <!-- Maelezo ya Mawasiliano (Chapu Chapu) -->
            <div class="col-lg-5">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold text-dark mb-4">Njia za Mawasiliano</h3>

                    <!-- Simu -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="fs-3 p-3 bg-primary-subtle rounded-circle me-3 text-primary d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            📞
                        </div>
                        <div>
                            <span class="text-muted small d-block">Piga Simu / WhatsApp</span>
                            <a href="tel:0785572965" class="fw-bold text-dark text-decoration-none fs-5">0785 572 965</a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="fs-3 p-3 bg-success-subtle rounded-circle me-3 text-success d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                            ✉️
                        </div>
                        <div>
                            <span class="text-muted small d-block">Barua Pepe (Email)</span>
                            <a href="mailto:fundidigital333@gmail.com" class="fw-bold text-dark text-decoration-none fs-6">fundidigital333@gmail.com</a>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Social Media Links -->
                    <h5 class="fw-bold text-dark mb-3">Tufuate Kwenye Mtandao</h5>
                    <div class="d-flex gap-3 flex-wrap">
                        <!-- Facebook -->
                        <a href="https://facebook.com" target="_blank" class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border">
                            <span>📘</span> <span class="fw-medium small text-dark">Facebook</span>
                        </a>
                        <!-- Instagram -->
                        <a href="https://instagram.com" target="_blank" class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border">
                            <span>📸</span> <span class="fw-medium small text-dark">Instagram</span>
                        </a>
                        <!-- TikTok -->
                        <a href="https://tiktok.com" target="_blank" class="btn btn-light rounded-pill px-3 py-2 d-flex align-items-center gap-2 border">
                            <span>🎵</span> <span class="fw-medium small text-dark">TikTok</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fomu ya Kutuma Ujumbe (Contact Form) -->
            <div class="col-lg-7">
                <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm">
                    <h3 class="fw-bold text-dark mb-3">Tuma Ujumbe Wako</h3>
                    <p class="text-muted small mb-4">Jaza fomu hii kwa maswali au msaada wowote, nasi tutakujibu haraka iwezekanavyo.</p>

                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-medium text-dark">Jina Yako</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0 fs-6" id="name" name="name" placeholder="Mfano: Juma Ally" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium text-dark">Barua Pepe (Email)</label>
                                <input type="email" class="form-control form-control-lg bg-light border-0 fs-6" id="email" name="email" placeholder="juma@example.com" required>
                            </div>
                            <div class="col-md-12">
                                <label for="subject" class="form-label fw-medium text-dark">Kichwa cha Ujumbe</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0 fs-6" id="subject" name="subject" placeholder="Mfano: Msaada wa Usajili" required>
                            </div>
                            <div class="col-md-12">
                                <label for="message" class="form-label fw-medium text-dark">Ujumbe Wako</label>
                                <textarea class="form-control form-control-lg bg-light border-0 fs-6" id="message" name="message" rows="4" placeholder="Andika ujumbe wako hapa..." required></textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4 fw-bold rounded-pill w-100">Tuma Ujumbe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection