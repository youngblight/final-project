<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Dashboard | Fundi Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            /* Prevent horizontal scrolling layout shifting issues */
            overflow-x: hidden;
        }

        /* 1. Fixed top navigation bar configuration */
        .custom-navbar.sb-topnav {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1039; /* Keeps the navbar stacked on top of all other elements */
            height: 56px;
        }

        #layoutSidenav_content {
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* Offset main content downward by 56px so it isn't hidden under the fixed navbar */
            padding-top: 56px; 
        }

        /* 2. DESKTOP VIEWPORTS (Large Screen Configurations) */
        @media (min-width: 992px) {
            /* Force the left sidebar layout wrapper to stay sticky/fixed while scrolling */
            #layoutSidenav_nav {
                position: fixed;
                top: 56px; /* Aligns perfectly right underneath the top navigation bar */
                left: 0;
                width: 225px;
                height: calc(100vh - 56px); /* Dynamic calculation to fill remaining viewport height */
                z-index: 1035;
                transition: transform 0.3s ease-in-out;
                /* Enables scrolling inside the sidebar independently if navigation links overflow */
                overflow-y: auto; 
            }

            #layoutSidenav_content {
                margin-left: 225px;
                width: calc(100% - 225px);
            }
        }

        /* 3. SIDEBAR TOGGLED: Slides sidebar completely out of desktop viewport view and expands main panel */
        .sb-sidenav-toggled #layoutSidenav_nav {
            transform: translateX(-225px);
        }

        .sb-sidenav-toggled #layoutSidenav_content {
            margin-left: 0 !important;
            width: 100% !important;
        }

        /* 4. MOBILE VIEWPORTS (Small Screen Configurations) */
        @media (max-width: 991.98px) {
            #layoutSidenav_nav {
                position: fixed;
                top: 56px;
                left: 0;
                width: 225px;
                height: calc(100vh - 56px);
                /* High z-index overlay to safely sit above mobile layout layers when toggled open */
                z-index: 1040; 
                transform: translateX(-225px);
                transition: transform 0.3s ease-in-out;
            }
            
            #layoutSidenav_content {
                margin-left: 0;
                width: 100%;
            }

            .sb-sidenav-toggled #layoutSidenav_nav {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="sb-nav-fixed">
    
    @include('layouts.partials.admin-navbar') 

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('layouts.partials.admin-sidebar') 
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 pt-4">
                    @yield('content')
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto border-top">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small text-muted">
                        <div class="text-center w-100">
                            Copyright &copy; **Digital Connection** 2026 | Siraju Mshamu
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            
            /* Check local storage parameters to retain user toggle states across page reloads */
            if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                document.body.classList.add('sb-sidenav-toggled');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }
        });
    </script>
</body>
</html>