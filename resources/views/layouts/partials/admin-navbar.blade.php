<nav class="sb-topnav navbar navbar-expand shadow-sm custom-navbar bg-white">
    <a class="navbar-brand ps-3 fw-bold d-flex align-items-center" href="{{ route('admin.dashboard') }}">
        <span class="text-primary">Fundi Digital</span>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-dark" id="sidebarToggle">
        <i class="fas fa-bars fa-lg"></i>
    </button>
    
    <div class="ms-auto"></div>
    
    <ul class="navbar-nav me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw me-2 fs-5"></i>
                <span class="fw-semibold">{{ Auth::user()?->name ?? 'Admin' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user fa-sm fa-fw me-2 text-muted"></i> Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger py-2">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
