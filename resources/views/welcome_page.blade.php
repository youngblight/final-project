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

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        /* BACKGROUND: Inatumia picha yako nyeupe/hafifu */
        .welcome-body {
            background-image: url("image_383787.png");
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: #1e293b;
            font-family: 'Poppins', sans-serif;
            padding: 40px 0;
        }

        /* Upande wa Kushoto: Orodha ya Huduma */
        .system-title {
            font-size: 2.6rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #0f2027;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        .system-desc {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.7;
        }
        .feature-list {
            list-style: none;
            padding-left: 0;
        }
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            font-size: 1.05rem;
            color: #334155;
        }
        
        .feature-icon-box {
            width: 40px;
            height: 40px;
            background-color: #0284c7;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 6px rgba(2, 132, 199, 0.2);
        }

        /* Upande wa Kulia: Kadi ya Kuingia (Login Box) */
        .login-box {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            color: #333333;
            border: 1px solid #e2e8f0;
        }
        .login-header {
            text-align: center;
            padding: 35px 20px 15px 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        .login-logo {
            height: 80px;
            object-fit: contain;
        }
        .login-body {
            padding: 30px 40px 40px 40px;
            background-color: #f8fafc;
        }
        .form-subtitle {
            text-align: center;
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 25px;
            font-weight: 500;
        }
        .input-group-custom {
            background: #ffffff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            padding: 5px 15px;
            border: 1px solid #cbd5e1;
            transition: 0.3s;
        }
        .input-group-custom:focus-within {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }
        .input-group-custom i {
            color: #94a3b8;
            margin-right: 10px;
            width: 16px;
            text-align: center;
        }
        .input-group-custom input {
            border: none;
            background: transparent;
            width: 100%;
            padding: 10px 5px;
            font-size: 0.95rem;
            color: #1e293b;
        }
        .input-group-custom input:focus {
            outline: none;
        }

        .btn-signin {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            border: none;
            color: white;
            width: 100%;
            padding: 13px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
        }
        .btn-signin:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(2, 132, 199, 0.3);
            color: white;
        }
        
        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #475569;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: 0.2s;
        }
        .forgot-link:hover {
            color: #0284c7;
            text-decoration: underline;
        }
        .terms-text {
            font-size: 0.8rem;
            color: #64748b;
            line-height: 1.6;
        }
        .terms-text a {
            color: #0284c7;
            text-decoration: none;
            font-weight: 500;
        }
        .terms-text a:hover {
            text-decoration: underline;
        }
        .account-check-text {
            color: #475569;
        }
        .register-link {
            color: #0284c7;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
            cursor: pointer;
        }
        .register-link:hover {
            color: #0369a1;
            text-decoration: underline;
        }

        /* MTANDAO WA DIRISHA LA USAJILI (Modal Custom Styling) */
        .register-choice-card {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px 20px;
            text-align: center;
            transition: 0.3s;
            text-decoration: none;
            display: block;
            color: #1e293b;
            margin-bottom: 15px;
        }
        .register-choice-card:hover {
            border-color: #0284c7;
            background-color: #f0f9ff;
            transform: translateY(-3px);
            color: #0284c7;
        }
        .choice-icon {
            font-size: 2.5rem;
            color: #0284c7;
            margin-bottom: 15px;
        }
        .choice-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .choice-desc {
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
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