<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <!-- Part of Dashboard -->
            <div class="sb-sidenav-menu-heading">Main</div>
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            
            <!-- Part of Management -->
            <div class="sb-sidenav-menu-heading">Management</div>
            
            <!-- User Roles Dropdown -->
            <a class="nav-link {{ request()->is('admin/role*') ? '' : 'collapsed' }} {{ request()->is('admin/role*') ? 'active' : '' }}" 
               href="#" 
               data-bs-toggle="collapse" 
               data-bs-target="#collapseUsers" 
               aria-expanded="{{ request()->is('admin/role*') ? 'true' : 'false' }}" 
               aria-controls="collapseUsers">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                User Management
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ request()->is('admin/role*') ? 'show' : '' }}" 
                 id="collapseUsers" 
                 aria-labelledby="headingOne" 
                 data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                   <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-circle-notch fa-xs me-2"></i> All Users
                   </a>
                </nav>
            </div>

            <!-- Service Categories -->
            <a class="nav-link" href="/admin/services">
                <div class="sb-nav-link-icon"><i class="fas fa-hammer"></i></div>
                Service Categories
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name ?? 'Admin' }}
    </div>
</nav>