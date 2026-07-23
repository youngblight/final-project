<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengeneza Akaunti - Fundi Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="customer-register-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 wide-card">
                
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header text-center fw-bold text-dark custom-card-header border-0">
                        <div class="mb-2">
                            <img src="https://ui-avatars.com/api/?name=Fundi+Digital&background=0284c7&color=fff&bold=true" class="login-logo mb-2" alt="FD-Logo">
                        </div>
                        <h4 class="mb-1 fw-bold">Tengeneza Akaunti</h4>
                        <p class="mb-0 text-muted small">Jiunge na Fundi Digital kama Mteja</p>
                    </div>

                    <div class="card-body p-4 p-md-5"> 
                        
                        @if ($errors->any())
                            <div class="alert alert-danger py-2 mb-3">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label for="name" class="form-label">Majina Kamili</label>
                                        <input type="text" name="name" class="form-control shadow-sm" id="name" placeholder="Ingiza majina yako kamili" value="{{ old('name') }}" required autofocus>
                                    </div>

                                    <div class="mb-1 mt-3">
                                        <label for="email" class="form-label">Barua Pepe (Email)</label>
                                        <input type="email" name="email" class="form-control shadow-sm" id="email" placeholder="jina435@gmail.com" value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label for="password" class="form-label">Nenosiri (Password)</label>
                                        <input type="password" name="password" class="form-control shadow-sm" id="password" placeholder="••••••••" required autocomplete="new-password">
                                    </div>

                                    <div class="mb-1 mt-3">
                                        <label for="password_confirmation" class="form-label">Thibitisha Nenosiri</label>
                                        <input type="password" name="password_confirmation" class="form-control shadow-sm" id="password_confirmation" placeholder="••••••••" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info py-2 mt-4 mb-2 d-flex align-items-center" style="font-size: 0.85rem; border-radius: 8px;">
                                <i class="fas fa-info-circle me-2"></i> Hakikisha nenosiri lako ni imara kwa usalama wa akaunti yako.
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-register py-2.5 fw-bold shadow">
                                    Jisajili Sasa
                                </button>
                            </div>

                            <div class="mt-4 text-center">
                                <span class="text-muted">Tayari una akaunti? </span>
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #5a91e6;">Ingia hapa</a>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>