<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Fundi Digital</title>
    
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
            font-family: 'Poppins', sans-serif;
        }

        /* BACKGROUND: Inatumia picha yako ya mwanzo */
        .login-standalone-body {
            background-image: url("{{ asset('image_383787.png') }}");
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .custom-card-header { 
            background-color: #d1e0f7 !important; 
            padding: 30px 20px !important;
        }

        .btn-login { 
            background-color: #5a91e6; 
            color: white; 
            border: none; 
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-login:hover { 
            background-color: #4a80d4; 
            color: white; 
            box-shadow: 0 4px 12px rgba(90, 145, 230, 0.3);
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            padding: 11px 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus {
            border-color: #5a91e6;
            box-shadow: 0 0 0 3px rgba(90, 145, 230, 0.15);
        }

        /* Huweka upana mzuri wa kadi ya login kwenye vioo vikubwa */
        .login-card-width {
            max-width: 520px;
            width: 100%;
        }
    </style>
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
                    <h4 class="fw-bold mb-1 text-dark">Welcome Back</h4>
                    <p class="mb-0 text-muted small">Log in to your Fundi Digital account</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    
                    @if (session('status'))
                        <div class="alert alert-success py-2 mb-4 small" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                            <label for="email" class="form-label text-dark">Email Address</label>
                            <input id="email" class="form-control shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email" />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">Password</label>
                            <input id="password" class="form-control shadow-sm" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" style="border-color: #cbd5e1;" name="remember">
                                <label for="remember_me" class="form-check-label text-muted small">Remember me</label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none fw-bold" style="color: #5a91e6;" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-login py-2.5 shadow">
                                Log In
                            </button>
                        </div>

                        <div class="mt-4 text-center">
                            <span class="text-muted small">Don't have an account? </span>
                            <a href="/" class="text-decoration-none fw-bold small" style="color: #5a91e6;">Register here</a>
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