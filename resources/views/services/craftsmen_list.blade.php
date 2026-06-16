@extends('layouts.home')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Craftsmen for: {{ $service->name }}</h2>
    
    <div class="row">
        @forelse($craftsmen as $craftsman)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <img src="{{ asset('storage/' . $craftsman->profile_photo) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $craftsman->full_name }}</h5>
                        <p class="text-muted mb-1"><i class="fas fa-map-marker-alt"></i> {{ $craftsman->location_name }}</p>
                        <a href="{{ route('craftsman.public.profile', $craftsman->id) }}" class="btn btn-primary w-100 mt-2">View Profile</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No craftsmen available for this service yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection