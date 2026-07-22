<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Connection - Ukurasa wa Nyumbani</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold me-4" href="{{ url('/') }}" style="letter-spacing: 1px;">DIGITAL CONNECTION</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="/home">Nyumbani</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Kuhusu Sisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Wasiliana Nasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold px-3" href="#">Huduma Zinazopatikana</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-sm fw-bold px-4 rounded-pill shadow-sm">
                            <i class="fas fa-sign-out-alt me-1"></i> ONDOKA
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        
        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 py-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3 fa-lg text-success"></i>
                        <div>
                            <strong>Hongera!</strong> {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 py-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-3 fa-lg text-danger"></i>
                        <div>
                            <strong>Makosa!</strong> {{ session('error') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        @yield('content')
        
    </main>

    <footer class="bg-dark text-white text-center py-4 mt-auto border-top border-secondary">
        <div class="container">
            <p class="mb-0">&copy; 2026 Digital Connection Project - Siraju Mshamu. Haki zote zimehifadhiwa.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>