<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usajili wa Fundi - Fundi Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/css/styles.css') }}">
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
                        <h2 class="fw-bold text-dark mb-1">Usajili wa Fundi</h2>
                        <p class="text-muted mb-0">Jiunge na mtandao wa <strong>Fundi Digital</strong> na uwafikie wateja wengi zaidi.</p>
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
                                        <i class="fas fa-user-tie me-2"></i>Taarifa za Kazi na Wasifu
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
                                             alt="Onyesho la Picha">
                                        
                                        <label for="profile_photo" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle shadow" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                    </div>
                                    <input type="file" name="profile_photo" id="profile_photo" class="d-none" accept="image/*" onchange="displayImagePreview(this)">
                                    <div class="mt-2 fw-bold text-muted small">Bonyeza picha ili kupakia (Picha ya Wasifu)</div>
                                    @error('profile_photo') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="full_name" class="form-label-custom">Jina Buledi (Kama lilivyo kwenye Kitambulisho)</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control form-control-custom w-100 @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" placeholder="Mf. Juma Hamisi" required>
                                    @error('full_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label-custom">Nambari ya Simu</label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-custom w-100 @error('phone') is-invalid @enderror" placeholder="0712XXXXXX" value="{{ old('phone') }}" required>
                                    @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Kundi la 2: Taarifa za Akaunti --}}
                                <div class="col-12 mt-5">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-lock me-2"></i>Taarifa za Akaunti
                                    </h4>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label-custom">Jina la Mtumiaji (Username)</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-custom w-100 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="juma24" required>
                                    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-8">
                                    <label for="email" class="form-label-custom">Barua Pepe (Email)</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-custom w-100 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="juma@example.com" required>
                                    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label-custom">Nenosiri (Password)</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-custom w-100 @error('password') is-invalid @enderror" required>
                                    @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label-custom">Thibitisha Nenosiri</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-custom w-100" required>
                                </div>

                                {{-- Kundi la 3: Maelezo ya Kazi --}}
                                <div class="col-12 mt-5">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-tools me-2"></i>Taarifa za Kazi na Ujuzi
                                    </h4>
                                </div>

                                <div class="col-md-6">
                                    <label for="skill_category" class="form-label-custom">Aina ya Ujuzi / Kazi</label>
                                    <select name="skill_category" id="skill_category" class="form-select form-control-custom w-100 @error('skill_category') is-invalid @enderror" style="padding: 11px 15px;" required>
                                        <option value="" selected disabled>Chagua Ujuzi...</option>
                                        <option value="Plumbing">Ufundi Bomba (Plumbing)</option>
                                        <option value="Electrical">Ufundi Umeme (Electrical)</option>
                                        <option value="Carpentry">Ufundi Mbao (Carpentry)</option>
                                        <option value="Masonry">Ujenzi (Masonry)</option>
                                        <option value="Welding">Uchomeleaji (Welding)</option>
                                    </select>
                                    @error('skill_category') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="location_name" class="form-label-custom">Eneo (Kata/Mtaa, Mkoa)</label>
                                    <input type="text" name="location_name" id="location_name" class="form-control form-control-custom w-100 @error('location_name') is-invalid @enderror" placeholder="Mf. Makumbusho, Dar es Salaam" value="{{ old('location_name') }}" required>
                                    @error('location_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                {{-- Kundi la 4: Nyaraka --}}
                                <div class="col-12 mt-5">
                                    <h4 class="section-title pb-2">
                                        <i class="fas fa-file-contract me-2"></i>Nyaraka za Uhakiki
                                    </h4>
                                </div>

                                <div class="col-12">
                                    <label for="verification_doc" class="form-label-custom">Kitambulisho au Cheti cha Biashara (PDF/JPG)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white" style="border-color: #cbd5e1;"><i class="fas fa-upload text-muted"></i></span>
                                        <input type="file" name="verification_doc" id="verification_doc" class="form-control form-control-custom @error('verification_doc') is-invalid @enderror" style="border-left: none;">
                                    </div>
                                    <div class="form-text mt-1 text-muted small">Ukubwa wa juu zaidi: 3MB (Zinazokubaliwa: JPG, PNG, PDF)</div>
                                    @error('verification_doc') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Kitufe cha Submit --}}
                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-register w-100 mb-3">
                                    JISAJILI KAMA FUNDI
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