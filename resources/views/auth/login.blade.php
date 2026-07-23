<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingia - Fundi Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/css/styles.css') }}">

</head>
<body>

<div class="login-standalone-body">
    <div class="container d-flex justify-content-center">
        <div class="login-card-width">
            
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-center custom-card-header border-0">
                    <div class="mb-2">
                        <img src="https://ui-avatars.com/api/?name=Fundi+Digital&background=0284c7&color=fff&bold=true" class="login-logo mb-2" alt="FD-Logo">
                    </div>
                    <h4 class="fw-bold mb-1 text-dark">Karibu Tena</h4>
                    <p class="mb-0 text-muted small">Ingia kwenye akaunti yako ya Fundi Digital</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    {{-- UJUMBE WA BLOCKED / MAKOSA YA SESSION --}}
                    @if (session('error'))
                        <div class="alert alert-danger py-2 mb-4 small text-center" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ session('error') }}
                        </div>
                    @endif

                    {{-- UJUMBE WA MAFANIKIO --}}
                    @if (session('status'))
                        <div class="alert alert-success py-2 mb-4 small" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- MAKOSA YA FORM VALIDATION --}}
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 mb-4">
                            <ul class="mb-0 small ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label text-dark">Barua Pepe (Email)</label>
                            <input id="email" class="form-control shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Weka barua pepe yako" />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">Nenosiri (Password)</label>
                            <input id="password" class="form-control shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="Weka nenosiri yako" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" style="border-color: #cbd5e1;" name="remember">
                                <label for="remember_me" class="form-check-label text-muted small">Nikumbuke</label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none fw-bold" style="color: #5a91e6;" href="{{ route('password.request') }}">
                                    Umesahau nenosiri?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-login py-2.5 shadow">
                                Ingia
                            </button>
                        </div>

                        <div class="mt-4 text-center">
                            <span class="text-muted small">Huna akaunti bado? </span>
                            <a href="/" class="text-decoration-none fw-bold small" style="color: #5a91e6;">Jisajili hapa</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="text-center text-muted mt-4 small">
                &copy; 2026 Digital Connections
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>