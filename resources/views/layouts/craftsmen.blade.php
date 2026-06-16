<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundi Digital - @yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --dark-blue: #2c3e50;
            --accent-blue: #3498db;
            --light-gray: #f4f7f6;
        }

        body { background-color: var(--light-gray); font-family: 'Segoe UI', sans-serif; }
        
        .sidebar { min-height: 100vh; background: var(--dark-blue); color: white; }
        .sidebar .nav-link { color: #bdc3c7; padding: 15px 20px; transition: 0.3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #34495e; color: var(--accent-blue); border-left: 4px solid var(--accent-blue); }
        
        .navbar { 
            background: var(--dark-blue) !important; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.2); 
            border-bottom: 1px solid #34495e;
        }
        .navbar .navbar-text, .navbar .dropdown-toggle { color: #ecf0f1 !important; }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content { flex-grow: 1; padding: 30px; }

        footer { 
            background: var(--dark-blue); 
            color: #bdc3c7; 
            padding: 15px 0;
            border-top: 1px solid #34495e;
        }
        
        .profile-img-nav { width: 35px; height: 35px; object-fit: cover; border-radius: 50%; border: 2px solid var(--accent-blue); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
            <div class="p-4 text-center">
                <h4 class="fw-bold text-white">Fundi<span class="text-info">Digital</span></h4>
                <hr class="text-secondary">
            </div>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('craftsmen.dashboard') ? 'active' : '' }}" href="{{ route('craftsmen.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/craftsmen/craftsman/job-history"><i class="fas fa-history me-2"></i> Job History</a>
                </li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 p-0 shadow main-wrapper">
            
            <nav class="navbar navbar-expand-lg sticky-top navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="navbar-text fw-semibold">
                        <i class="fas fa-hammer me-2 text-info"></i> Craftsman Panel
                    </span>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3498db&color=fff" class="profile-img-nav me-2">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i> Account Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="px-4 pt-4 mb-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 py-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2 fa-lg text-success"></i>
                            <div>
                                <strong>Success!</strong> {{ session('success') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 py-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2 fa-lg text-danger"></i>
                            <div>
                                <strong>Error!</strong> {{ session('error') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            <div class="main-content">
                @yield('content')
            </div>

            <footer class="text-center">
                <div class="container">
                    <small>&copy; 2026 <strong>Fundi Digital</strong>. Developed by Siraju Kikula.</small>
                </div>
            </footer>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>