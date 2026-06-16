@extends('layouts.craftsmen')

@section('content')
<div class="d-flex flex-column min-vh-100">
    <div class="container py-5 flex-grow-1">
        
        {{-- SECTION 1: HEADER STATS --}}
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 bg-primary text-white p-3 rounded-4" style="background: linear-gradient(135deg, #0d6efd, #0b5ed7) !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="fas fa-briefcase fa-xl"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 small">Total Jobs</h6>
                            <h4 class="fw-bold mb-0">{{ isset($jobs) ? $jobs->count() : 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 bg-warning text-dark p-3 rounded-4" style="background: linear-gradient(135deg, #ffc107, #ffca2c) !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-50 p-3 me-3">
                            <i class="fas fa-tasks fa-xl"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 small">Ongoing</h6>
                            <h4 class="fw-bold mb-0">{{ isset($jobs) ? $jobs->whereIn('status', ['accepted', 'in_progress'])->count() : 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 bg-success text-white p-3 rounded-4" style="background: linear-gradient(135deg, #198754, #157347) !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="fas fa-check-double fa-xl"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 small">Completed</h6>
                            <h4 class="fw-bold mb-0">{{ isset($jobs) ? $jobs->whereIn('status', ['completed', 'fully_paid'])->count() : 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0 bg-info text-white p-3 rounded-4" style="background: linear-gradient(135deg, #0dcaf0, #31d2f2) !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                            <i class="fas fa-star fa-xl"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 small">Rating</h6>
                            <h4 class="fw-bold mb-0">{{ (isset($jobs) && $jobs->whereNotNull('rating')->count() > 0) ? number_format($jobs->whereNotNull('rating')->avg('rating'), 1) : '0.0' }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 2: PROFILE & ASSIGNMENTS GRID --}}
        <div class="row">
            
            {{-- LEFT COLUMN: Profile Card --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 mb-4 overflow-hidden bg-white">
                    
                    @php
                        $role = Auth::user()->role ?? 'user'; 
                        $gradient = 'linear-gradient(135deg, #212529, #343a40)'; 
                        if($role === 'craftsmen') $gradient = 'linear-gradient(135deg, #0d6efd, #111936)'; 
                        if($role === 'admin') $gradient = 'linear-gradient(135deg, #dc3545, #b02a37)'; 
                        if($role === 'user') $gradient = 'linear-gradient(135deg, #198754, #146c43)'; 
                    @endphp

                    <div class="text-white p-4 text-center position-relative" style="background: {{ $gradient }} !important;">
                        
                        <div class="position-absolute top-0 end-0 mt-3 me-3">
                            @if($role === 'craftsmen')
                                <a href="{{ route('craftsmen.profile.edit') }}" class="btn btn-sm rounded-circle shadow-sm bg-white bg-opacity-25 text-white border-0" title="Edit Profile" style="width: 32px; height: 32px; line-height: 32px; padding: 0;">
                                    <i class="fas fa-edit" style="font-size: 0.85rem;"></i>
                                </a>
                            @endif
                        </div>

                        <div class="mb-3">
                            @php
                                $profileImg = 'https://www.w3schools.com/howto/img_avatar.png';
                                if ($role === 'craftsmen' && Auth::user()->craftsmen && Auth::user()->craftsmen->profile_photo) {
                                    $profileImg = asset('storage/' . Auth::user()->craftsmen->profile_photo);
                                }
                            @endphp
                            <img src="{{ $profileImg }}" 
                                 class="rounded-circle border border-3 border-white shadow" 
                                 style="width: 105px; height: 105px; object-fit: cover;"
                                 alt="Profile">
                        </div>

                        <h5 class="fw-bold mb-1 text-white text-capitalize">
                            {{ $role === 'craftsmen' ? (Auth::user()->craftsmen?->full_name ?? Auth::user()->name) : Auth::user()->name }}
                        </h5>
                        
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 text-white small text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            @if($role === 'craftsmen')
                                <i class="fas fa-tools me-1"></i> {{ Auth::user()->craftsmen?->skill_category ?? 'Expert' }}
                            @elseif($role === 'admin')
                                <i class="fas fa-user-shield me-1"></i> Admin
                            @else
                                <i class="fas fa-user me-1"></i> Client
                            @endif
                        </span>
                    </div>

                    <div class="card-body p-4 bg-white">
                        <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size: 0.72rem; letter-spacing: 1px;">Account Details</h6>
                        
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center p-2 rounded-3 hover-bg-light">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2.5 me-3 text-center d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-phone-alt small"></i>
                                </div>
                                <div>
                                    <div class="text-muted small mb-0" style="font-size: 0.72rem;">Phone Number</div>
                                    <div class="fw-semibold text-dark small">
                                        {{ $role === 'craftsmen' ? (Auth::user()->craftsmen?->phone_number ?? Auth::user()->phone_number ?? 'N/A') : (Auth::user()->phone_number ?? 'N/A') }}
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center p-2 rounded-3 hover-bg-light" style="max-width: 100%;">
                                <div class="rounded-circle bg-success bg-opacity-10 text-success p-2.5 me-3 text-center d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-map-marker-alt small"></i>
                                </div>
                                <div class="text-truncate" style="max-width: calc(100% - 55px);">
                                    <div class="text-muted small mb-0" style="font-size: 0.72rem;">Location</div>
                                    <div class="fw-semibold text-dark small text-truncate">
                                        {{ $role === 'craftsmen' ? (Auth::user()->craftsmen?->location ?? 'Not set') : 'Tanzania' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Assignments Management Table --}}
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Recent Assignments</h5>
                        @if(isset($jobs))
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2 border small fw-semibold">Active: {{ $jobs->whereNotIn('status', ['fully_paid'])->count() }}</span>
                        @endif
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small">
                                <tr>
                                    <th class="ps-4 py-3" style="font-size: 0.75rem;">CUSTOMER</th>
                                    <th class="py-3" style="font-size: 0.75rem;">JOB DESCRIPTION</th>
                                    <th class="py-3" style="font-size: 0.75rem;">STATUS</th>
                                    <th class="text-end pe-4 py-3" style="font-size: 0.75rem;">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($jobs) && $jobs->count() > 0)
                                    @foreach($jobs as $job)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="fw-bold text-dark small text-capitalize">
                                                {{ $job->user->name ?? 'Unknown Client' }}
                                            </div>
                                            <div class="text-muted small mb-0.5" style="font-size: 0.78rem;">
                                                <i class="fas fa-phone-alt me-1" style="font-size: 0.7rem;"></i>
                                                <span class="fw-bold text-dark">{{ $job->customer_phone ?? $job->user->phone_number ?? 'No Phone' }}</span>
                                            </div>
                                            <div class="text-primary small" style="font-size: 0.75rem;">
                                                <i class="fas fa-map-marker-alt me-1" style="font-size: 0.7rem;"></i>{{ $job->location ?? 'Not specified' }}
                                            </div>
                                        </td>
                                        
                                       
                                        <td class="py-3">
                                            <div class="small text-dark" style="min-width: 220px; white-space: normal; word-break: break-word;">
                                                {{ $job->job_description }}
                                            </div>
                                            @if($job->agreed_price)
                                                <div class="fw-bold text-success mt-1" style="font-size: 0.8rem;">
                                                    Tsh {{ number_format($job->agreed_price) }}
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <td class="py-3">
                                            @if($job->status == 'pending')
                                                <span class="badge bg-warning text-dark rounded-pill fw-semibold px-2.5 py-1.5" style="font-size: 0.7rem;">New Request</span>
                                            @elseif($job->status == 'accepted')
                                                <span class="badge bg-danger rounded-pill fw-semibold px-2.5 py-1.5" style="font-size: 0.7rem;">Waiting Deposit</span>
                                            @elseif($job->status == 'in_progress')
                                                <span class="badge bg-info text-white rounded-pill fw-semibold px-2.5 py-1.5" style="font-size: 0.7rem;">In Progress</span>
                                            @elseif($job->status == 'completed')
                                                <span class="badge bg-secondary rounded-pill fw-semibold px-2.5 py-1.5" style="font-size: 0.7rem;">Awaiting Final Pay</span>
                                            @elseif($job->status == 'fully_paid')
                                                <span class="badge bg-success rounded-pill fw-semibold px-2.5 py-1.5" style="font-size: 0.7rem;">Completed</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4 py-3">
                                            @if($job->status == 'pending')
                                                <button class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" style="font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#respondModal{{ $job->id }}">
                                                    Respond
                                                </button>
                                            @elseif($job->status == 'in_progress')
                                                <a href="{{ url('/chat/' . $job->id) }}" class="btn btn-sm btn-outline-info rounded-circle me-1" style="width: 30px; height: 30px; line-height: 28px; padding: 0;">
                                                    <i class="fas fa-comment"></i>
                                                </a>
                                                <form action="{{ route('job.updateStatus', $job->id) }}" method="POST" class="d-inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">Finish</button>
                                                </form>
                                            @else
                                                <a href="tel:{{ $job->customer_phone ?? $job->user->phone_number ?? '#' }}" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 30px; height: 30px; line-height: 28px; padding: 0;" title="Call Customer">
                                                    <i class="fas fa-phone-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

        
                                    <div class="modal fade" id="respondModal{{ $job->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <form action="{{ route('job.respond', $job->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header border-0 pb-0">
                                                        <h5 class="modal-title fw-bold">Job Response</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body py-3">
                                                        
                                                        
                                                        <div class="bg-light p-3 rounded-3 mb-3 border-start border-primary border-3">
                                                            <label class="fw-bold text-muted small mb-1 text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Full Job Description</label>
                                                            <p class="small text-dark mb-0 style-description" style="white-space: pre-line; word-break: break-word;">{{ $job->job_description }}</p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small">Price Offer (Tsh)</label>
                                                            <input type="number" name="agreed_price" class="form-control border-0 bg-light rounded-3" placeholder="Enter amount..." required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label fw-bold small">Message</label>
                                                            <textarea name="fundi_response" class="form-control border-0 bg-light rounded-3" rows="3" placeholder="Tell the customer about your offer..." required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0">
                                                        <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill fw-bold">Submit Offer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted small">
                                            <i class="fas fa-folder-open fa-2x mb-2 opacity-25"></i><br>
                                            No job requests available at this time.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .min-vh-100 { min-height: 100vh !important; }
    .flex-grow-1 { flex-grow: 1 !important; }
    .rounded-4 { border-radius: 1rem !important; }
    .hover-bg-light:hover { background-color: #f8f9fa !important; }
    .table-hover tbody tr:hover { background-color: rgba(13, 110, 253, 0.015) !important; }
    .style-description { line-height: 1.5; }
</style>
@endsection