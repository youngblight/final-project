<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Craftsman Registration - Fundi Digital</title>
    
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

        /* BACKGROUND: Inatumia picha yako ili iendane na welcome page */
        .registration-body {
            background-image: url("{{ asset('image_383787.png') }}");
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 50px 0;
        }

        /* Kadi kuu ya usajili */
        .register-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        /* Sehemu ya juu ya kadi yenye Nembo */
        .register-header {
            text-align: center;
            padding: 40px 20px;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .login-logo {
            height: 80px;
            object-fit: contain;
        }

        .register-body-content {
            padding: 40px;
        }

        /* Mitindo ya vichwa vya habari vya sehemu (Sections) */
        .section-title {
            color: #0284c7;
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
            pb: 10px;
        }

        /* Mitindo ya fomu inputs */
        .form-label-custom {
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 6px;
        }

        .form-control-custom {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: 0.3s;
            background-color: #f8fafc;
        }

        .form-control-custom:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
            background-color: #ffffff;
            outline: none;
        }

        /* Kitufe cha kujisajili */
        .btn-register {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            transition: 0.3s;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(2, 132, 199, 0.35);
            color: white;
        }

        .back-to-login {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: 0.2s;
        }

        .back-to-login:hover {
            color: #0284c7;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="registration-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11 col-lg-9">
                
                <div class="register-card">
                    
                    {{-- 1. SEHEMU YA JUU: NEMBO NA KICHWA CHA HABARI --}}
                    <div class="register-header">
                        <img src="https://ui-avatars.com/api/?name=Fundi+Digital&background=0284c7&color=fff&bold=true" class="login-logo mb-2" alt="FD-Logo">
                        <h2 class="fw-bold text-dark mb-1">Craftsman Registration</h2>
                        <p class="text-muted mb-0">Join the <strong>Fundi Digital</strong> network and reach more customers.</p>
                    </div>

                    {{-- 2. SEHEMU YA KATI: FOMU YA USAJILI --}}
                    <div class="register-body-content">
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 p-3" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('craftsmen.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-4">
                                
                                {{-- Kundi la 1: Taarifa Binafsi --}}
                                <div class="col-12">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-user-tie me-2"></i>Professional Profile
                                    </h4>
                                </div>

                                {{-- Picha ya Wasifu (Avatar Upload) --}}
                                <div class="col-12 text-center mb-3">
                                    <div class="position-relative d-inline-block">
                                        <img id="preview" 
                                             src="https://ui-avatars.com/api/?name=Fundi&background=0284c7&color=fff&size=150" 
                                             class="rounded-circle shadow-sm border border-4 border-white" 
                                             style="width: 130px; height: 130px; object-fit: cover; cursor: pointer;"
                                             onclick="document.getElementById('profile_photo').click();"
                                             alt="Profile Preview">
                                        
                                        <label for="profile_photo" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle shadow" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                    </div>
                                    <input type="file" name="profile_photo" id="profile_photo" class="d-none" accept="image/*" onchange="displayImagePreview(this)">
                                    <div class="mt-2 fw-bold text-muted small">Click image to upload (Profile Photo)</div>
                                    @error('profile_photo') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="full_name" class="form-label-custom">Full Name (As per ID)</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control form-control-custom w-100 @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" placeholder="John Doe" required>
                                    @error('full_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label-custom">Phone Number</label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-custom w-100 @error('phone') is-invalid @enderror" placeholder="0712XXXXXX" value="{{ old('phone') }}" required>
                                    @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Kundi la 2: Taarifa za Akaunti --}}
                                <div class="col-12 mt-5">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-lock me-2"></i>Account Credentials
                                    </h4>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label-custom">Username</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-custom w-100 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="johndoe24" required>
                                    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-8">
                                    <label for="email" class="form-label-custom">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-custom w-100 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="john@example.com" required>
                                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label-custom">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-custom w-100 @error('password') is-invalid @enderror" required>
                                    @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label-custom">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-custom w-100" required>
                                </div>

                                {{-- Kundi la 3: Maelezo ya Kazi --}}
                                <div class="col-12 mt-5">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-tools me-2"></i>Work Details
                                    </h4>
                                </div>

                                <div class="col-md-6">
                                    <label for="skill_category" class="form-label-custom">Expertise / Skill</label>
                                    <select name="skill_category" id="skill_category" class="form-select form-control-custom w-100 @error('skill_category') is-invalid @enderror" style="padding: 11px 15px;" required>
                                        <option value="" selected disabled>Select Skill...</option>
                                        <option value="Plumbing">Plumbing</option>
                                        <option value="Electrical">Electrical</option>
                                        <option value="Carpentry">Carpentry</option>
                                        <option value="Masonry">Masonry</option>
                                        <option value="Welding">Welding</option>
                                    </select>
                                    @error('skill_category') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="location_name" class="form-label-custom">Location (Area, City)</label>
                                    <input type="text" name="location_name" id="location_name" class="form-control form-control-custom w-100 @error('location_name') is-invalid @enderror" placeholder="e.g. Makumbusho, Dar" value="{{ old('location_name') }}" required>
                                    @error('location_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Kundi la 4: Nyaraka --}}
                                <div class="col-12 mt-5">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-file-contract me-2"></i>Verification Documents
                                    </h4>
                                </div>

                                <div class="col-12">
                                    <label for="verification_doc" class="form-label-custom">ID Card or Business Certificate (PDF/JPG)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white" style="border-color: #cbd5e1;"><i class="fas fa-upload text-muted"></i></span>
                                        <input type="file" name="verification_doc" id="verification_doc" class="form-control form-control-custom @error('verification_doc') is-invalid @enderror" style="border-left: none;">
                                    </div>
                                    <div class="form-text mt-1 text-muted small">Max size: 3MB (Allowed: JPG, PNG, PDF)</div>
                                    @error('verification_doc') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Kitufe cha Submit --}}
                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-register w-100 mb-3">
                                    REGISTER AS CRAFTSMAN
                                </button>
                                <a href="/" class="back-to-login">
                                    <i class="fas fa-arrow-left me-2"></i>Rudi Kwenye Ukurasa wa Kuingia
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview ya picha baada ya kuichagua
    function displayImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>