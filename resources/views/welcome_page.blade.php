<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karibu - Fundi Digital Connection</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

<div class="welcome-body">
    <div class="container">
        <div class="row align-items-center g-5">
            
            {{-- 1. UPANDE WA KUSHOTO: MAELEZO NA HUDUMA --}}
            <div class="col-lg-7 text-start">
                <h1 class="system-title mb-3">FUNDI DIGITAL CONNECTION</h1> 
                <p class="system-desc mb-4">
                    Mfumo wa "Fundi Digital Connection" (FDCS): ni jukwaa la kisasa la mtandaoni linalorahisisha upatikanaji wa mafundi wenye ujuzi nchini. Mfumo huu unawaunganisha wateja na wataalamu wa ndani kwa ajili ya huduma salama, za haraka na za kuaminika zikiwemo;
                </p>

                <ul class="feature-list">
                    <li class="feature-item">
                        <div class="feature-icon-box"><i class="fas fa-user-check"></i></div>
                        <span>Uteuzi wa Mafundi Waliothibitishwa na Kusajiliwa</span>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon-box"><i class="fas fa-shield-alt"></i></div>
                        <span>Malipo Salama kwa Awamu (Kifuta Jasho na Malipo ya Mwisho)</span>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon-box"><i class="fas fa-map-marked-alt"></i></div>
                        <span>Kupata Fundi wa Karibu Zaidi kwa Kutumia Ramani ya Kidijitali</span>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon-box"><i class="fas fa-star-half-alt"></i></div>
                        <span>Kuweka Tathmini (Ratings) na Maoni Baada ya Kazi</span>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon-box"><i class="fas fa-folder-open"></i></div>
                        <span>Kumbukumbu Salama na Historia ya Kazi Zilizopita</span>
                    </li>
                </ul>

                <p class="terms-text mt-4">
                    * Kwa kuingia kwenye mfumo huu unakubali <a href="#">vigezo na masharti</a> ya matumizi. Fundi Digital inahifadhi haki ya kulinda na kutumia taarifa zilizotolewa kwa mujibu vya sheria za Jamhuri ya Muungano wa Tanzania.
                </p>
            </div>

            {{-- 2. UPANDE WA KULIA: FOMU YA KUINGIA (KADI YA LOGIN) --}}
            <div class="col-lg-5">
                <div class="login-box">
                    <div class="login-header">
                        <img src="https://ui-avatars.com/api/?name=Fundi+Digital&background=0284c7&color=fff&bold=true" class="login-logo mb-2" alt="FD-Logo">
                    </div>
                    
                    <div class="login-body">
                        <div class="form-subtitle">Ingia kwa kutumia taarifa zako za siri</div>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="input-group-custom">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Weka Barua Pepe (Email) yako" required autofocus autocomplete="username">
                            </div>
                            
                            <div class="input-group-custom">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Neno la Siri (Password)" required autocomplete="current-password">
                            </div>

                            <div class="form-check mb-4 mt-2">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label text-muted small" for="remember_me">
                                    Nikumbuke kila nikija
                                </label>
                            </div>

                            <button type="submit" class="btn btn-signin">Ingia Kwenye Mfumo</button>
                        </form>
                    </div>
                </div>
                
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Umesahau neno la siri?
                    </a>
                @endif
                <div class="text-center mt-3">
                    <small class="account-check-text">Huna akaunti bado? <a class="register-link" data-bs-toggle="modal" data-bs-target="#registerModal">Jisajili hapa</a></small>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- 3. DIRISHA LA POP-UP LA KUCHAGUA AINA YA USAJILI (REGISTER MODAL) --}}
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden;">
            <div class="modal-header bg-light py-3">
                <h5 class="modal-title fw-bold text-dark w-100 text-center" id="registerModalLabel">Chagua Aina ya Akaunti Unayotaka Kusajili</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <a href="{{ route('register') }}" class="register-choice-card">
                            <div class="choice-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="choice-title">Jisajili kama Mteja</div>
                            <div class="choice-desc">Natafuta fundi mwenye ujuzi kwa ajili ya kupata huduma bora za matengenezo.</div>
                        </a>
                    </div>
                    
                    <div class="col-md-6">
                        <a href="{{ route('craftsmen.register') }}" class="register-choice-card">
                            <div class="choice-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="choice-title">Jisajili kama Fundi</div>
                            <div class="choice-desc">Mimi ni fundi mwenye ujuzi, natafuta fursa na wateja wa kuwapatia huduma zangu.</div>
                        </a>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light py-2">
                <small class="text-muted">Fundi Digital Connection &copy; 2026</small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>