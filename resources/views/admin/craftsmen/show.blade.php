@extends('layouts.admin')

@section('content')
<style>
    /* Inafunga Navbar na Sidebar isicheze */
    .sb-topnav { position: fixed !important; top: 0; right: 0; left: 0; z-index: 1030; }
    #layoutSidenav_nav { position: fixed !important; top: 56px; height: calc(100vh - 56px); z-index: 1038; }
    #layoutSidenav_content { padding-top: 56px; height: 100vh; overflow-y: auto; }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
</style>

<div class="container-fluid px-4 py-4">
    {{-- Header Section --}}
    <div class="text-center mb-4">
        <h1 class="fw-bold text-dark display-6">Craftsman Profile</h1>
        <p class="text-muted small">Viewing detailed information for <strong>{{ $craftsman->full_name }}</strong></p>
        
        <div class="d-flex justify-content-center mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light border px-4 py-2 rounded-pill shadow-sm">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.craftsmen.details') }}" class="text-decoration-none">Craftsmen</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Session Alerts --}}
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center pb-5">
        <div class="col-md-9">
            <div class="card shadow-sm border-0 p-4 rounded-4">
                {{-- Profile Info --}}
                <div class="text-center mb-4">
                    @if($craftsman->profile_photo)
                        <img src="{{ asset('storage/' . $craftsman->profile_photo) }}" class="rounded-circle shadow border border-4 border-white" style="width: 130px; height: 130px; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($craftsman->full_name) }}&background=random&size=130" class="rounded-circle shadow border border-4 border-white">
                    @endif

                    <h2 class="fw-bold mt-3 mb-1 text-dark">{{ $craftsman->full_name }}</h2>
                    <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">{{ $craftsman->skill_category }}</span>
                    
                    {{-- Display Block Status Badge --}}
                    @if(optional($craftsman->user)->is_blocked)
                        <div class="mt-2">
                            <span class="badge bg-danger-soft text-danger border border-danger px-3 py-1 rounded-pill">
                                <i class="fas fa-ban me-1"></i> Account Blocked
                            </span>
                        </div>
                    @endif
                </div>
                
                <hr class="text-muted opacity-25">

                {{-- PAYMENT HISTORY SECTION --}}
                <div class="mt-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-history me-2 text-primary"></i>Recent Payments (Audit Trail)</h6>
                    <div class="table-responsive">
                        <table class="table table-hover border align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="small py-3">Date</th>
                                    <th class="small py-3">Transaction ID</th>
                                    <th class="small py-3">Method</th>
                                    <th class="small py-3">Amount</th>
                                    <th class="small py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($craftsman->jobRequests ?? [] as $job)
                                    @if($job->payment)
                                    <tr>
                                        <td class="small">{{ $job->payment->created_at->format('d M, Y') }}</td>
                                        <td class="small text-uppercase fw-bold text-primary">{{ $job->payment->transaction_id }}</td>
                                        <td class="small">{{ $job->payment->payment_method }}</td>
                                        <td class="small fw-bold">Tsh {{ number_format($job->payment->amount) }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-soft text-success border border-success rounded-pill px-3 py-2" style="font-size: 10px;">
                                                {{ strtoupper($job->payment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted small py-4">
                                            <i class="fas fa-info-circle me-1"></i> No payments recorded for this craftsman yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="text-muted opacity-25 mt-4">

                {{-- REVIEWS & COMMENTS MODERATION SECTION --}}
                <div class="mt-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fas fa-comments me-2 text-warning"></i>Customer Reviews & Ratings</h6>
                    <div class="list-group list-group-flush border rounded-3 overflow-hidden">
                        @php
                            $hasReviews = false;
                        @endphp
                        @foreach($craftsman->jobRequests ?? [] as $job)
                            @if($job->rating || $job->comment)
                                @php $hasReviews = true; @endphp
                                <div class="list-group-item p-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <strong class="text-dark">{{ $job->user->name ?? 'Customer' }}</strong>
                                            @if($job->rating)
                                                <span class="badge bg-warning text-dark"><i class="fas fa-star text-white"></i> {{ $job->rating }}</span>
                                            @endif
                                            <small class="text-muted">({{ $job->updated_at->format('d M, Y') }})</small>
                                        </div>
                                        <p class="mb-0 text-muted small">{{ $job->comment ?? 'No comment provided.' }}</p>
                                    </div>
                                    
                                    {{-- Delete Comment Button --}}
                                    <form action="{{ route('admin.comments.delete', $job->id) }}" method="POST" onsubmit="return confirm('Je, una uhakika unataka kufuta maoni haya?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Futa Maoni">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endforeach

                        @if(!$hasReviews)
                            <div class="list-group-item text-center text-muted small py-4">
                                <i class="fas fa-comment-slash me-1"></i> No reviews or comments recorded for this craftsman yet.
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="text-muted opacity-25 mt-4">

                {{-- ADMIN CONTROLS --}}
                <div class="mt-4 d-flex justify-content-center align-items-center gap-3 flex-wrap">
                    @if($craftsman->status == 'pending')
                        <form action="{{ route('admin.craftsmen.approve', $craftsman->id) }}" method="POST">
                            @csrf 
                            @method('PATCH')
                            <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-check me-1"></i> Approve Profile
                            </button>
                        </form>
                    @endif

                    {{-- Block / Unblock User Form --}}
                    @if($craftsman->user)
                        <form action="{{ route('admin.users.block', $craftsman->user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $craftsman->user->is_blocked ? 'btn-outline-success' : 'btn-warning' }} px-4 rounded-pill shadow-sm">
                                <i class="fas {{ $craftsman->user->is_blocked ? 'fa-unlock' : 'fa-ban' }} me-1"></i>
                                {{ $craftsman->user->is_blocked ? 'Fungulia Account' : 'Block User' }}
                            </button>
                        </form>
                    @endif

                    {{-- Delete Profile Form --}}
                    @if($craftsman->user)
                        <form action="{{ route('admin.users.destroy', $craftsman->user->id) }}" method="POST" onsubmit="return confirm('Je, una uhakika unataka kumfuta fundi huyu kikamilifu?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger px-4 rounded-pill">
                                <i class="fas fa-trash me-1"></i> Delete Profile
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection