<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundi Digital - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('craftsmen/css/style.css') }}" rel="stylesheet" />
    
</head>
<body>

<div class="container-fluid">
    <div class="row">
        {{-- SEHEMU YA PEMBENI (SIDEBAR) --}}
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
            <div class="p-4 text-center">
                <h4 class="fw-bold text-white">Fundi<span class="text-info">Digital</span></h4>
                <hr class="text-secondary">
            </div>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('craftsmen.dashboard') ? 'active' : '' }}" href="{{ route('craftsmen.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashibodi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('craftsmen.job_history.index') ? 'active' : '' }}" href="{{ route('craftsmen.job_history.index') }}">
                        <i class="fas fa-history me-2"></i> Kumbukumbu za Kazi
                    </a>
                </li>
            </ul>
        </nav>

        {{-- SEHEMU KUU YA MAUDHUI --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 p-0 shadow main-wrapper">
            
            {{-- BARRA YA JUU (NAVBAR) --}}
            <nav class="navbar navbar-expand-lg sticky-top navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="navbar-text fw-semibold">
                        <i class="fas fa-hammer me-2 text-info"></i> Panel ya Fundi
                    </span>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3498db&color=fff" class="profile-img-nav me-2">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i> Mipangilio ya Akaunti</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Ondoka</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- ARUFA NA JUMBE ZA MFUMO (NOTIFICATIONS / ALERTS) --}}
            <div class="px-4 pt-4 mb-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 py-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2 fa-lg text-success"></i>
                            <div>
                                <strong>Imefanikiwa!</strong> {{ session('success') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Funga"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 py-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2 fa-lg text-danger"></i>
                            <div>
                                <strong>Kosa!</strong> {{ session('error') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Funga"></button>
                    </div>
                @endif
            </div>

            {{-- MAUDHUI YA UKURASA --}}
            <div class="main-content">
                @yield('content')
            </div>

            {{-- TABAKA YA CHINI (FOOTER) --}}
            <footer class="text-center">
                <div class="container">
                    <small>&copy; 2026 <strong>Fundi Digital</strong>. Imetengenezwa na Siraju Kikula.</small>
                </div>
            </footer>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>