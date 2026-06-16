@extends('layouts.admin')

@section('content')
<style>
    /* Inafunga Navbar na Sidebar isicheze */
    .sb-topnav { position: fixed !important; top: 0; right: 0; left: 0; z-index: 1030; }
    #layoutSidenav_nav { position: fixed !important; top: 56px; height: calc(100vh - 56px); z-index: 1038; }
    #layoutSidenav_content { padding-top: 56px; height: 100vh; overflow-y: auto; }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
</style>

<div class="container-fluid px-4 py-4">
    {{-- Header Section --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-dark display-6">Craftsmen Profile</h1>
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

    <div class="row justify-content-center pb-5">
        <div class="col-md-9"> {{-- Nimepanua kidogo ili table ikae vizuri --}}
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
                                {{-- Tumia optional kuzuia null error --}}
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

                {{-- Admin Controls --}}
                <div class="mt-4 d-flex justify-content-center gap-3">
                    @if($craftsman->status == 'pending')
                    <form action="{{ route('admin.craftsmen.approve', $craftsman->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-success px-5 rounded-pill shadow fw-bold">Approve Profile</button>
                    </form>
                    @endif
                    <button class="btn btn-outline-danger px-4 rounded-pill" onclick="return confirm('Futa fundi huyu?')">Delete Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection