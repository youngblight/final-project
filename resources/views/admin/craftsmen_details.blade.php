@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mt-4 fw-bold text-dark">Craftsmen Management</h1>
            <p class="text-muted small">Manage and verify all service providers in the system.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light border px-3 py-2 rounded-pill shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Craftsmen</li>
            </ol>
        </nav>
    </div>

    {{-- Main Content Card --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
            <div class="fw-bold text-uppercase text-secondary small">
                <i class="fas fa-list-ul me-2 text-primary"></i> Registered Craftsmen List
            </div>
            <span class="badge bg-primary rounded-pill">{{ count($craftsmen) }} Total</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0 py-3">Full Name</th>
                            <th class="border-0 py-3">Contact Info</th>
                            <th class="border-0 py-3">Category</th>
                            <th class="border-0 py-3">Location</th>
                            <th class="text-center border-0 py-3">Document</th>
                            <th class="text-center border-0 py-3">GIS Status</th>
                            <th class="text-center border-0 py-3">Approval</th>
                            <th class="text-center pe-4 border-0 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($craftsmen as $fundi)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-container me-3">
                                            <img src="{{ $fundi->profile_photo ? asset('storage/' . $fundi->profile_photo) : asset('images/default-avatar.png') }}"
                                                 alt="Profile"
                                                 class="rounded-circle border shadow-sm"
                                                 style="width: 45px; height: 45px; object-fit: cover;">
                                        </div>
                                        <div>
                                            <a href="{{ route('craftsman.public.profile', $fundi->id) }}" class="text-decoration-none" target="_blank">
                                       <div class="fw-bold text-dark mb-0 hover-link-primary">{{ $fundi->full_name }}</div>
                                            </a>
                                            <small class="text-muted italic">Registered: {{ $fundi->created_at->format('d M, Y') }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="small">
                                        <span class="d-block"><i class="fas fa-phone-alt text-muted me-2"></i>{{ $fundi->phone }}</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-info-soft text-info border-0 px-3 py-2 rounded-pill">
                                        {{ $fundi->skill_category }}
                                    </span>
                                </td>

                                <td>
                                    <div class="small text-muted text-truncate" style="max-width: 150px;">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                        {{ $fundi->location_name }}
                                    </div>
                                </td>

                                <td class="text-center">
                                    @if($fundi->verification_doc)
                                        <a href="{{ asset('storage/' . $fundi->verification_doc) }}" target="_blank" class="d-inline-block">
                                            <img src="{{ asset('storage/' . $fundi->verification_doc) }}"
                                                 alt="Doc"
                                                 class="img-thumbnail hover-zoom"
                                                 style="width: 45px; height: 35px; object-fit: cover;">
                                        </a>
                                    @else
                                        <span class="text-muted x-small">N/A</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($fundi->latitude && $fundi->longitude)
                                        <span class="text-success small fw-bold">
                                            <i class="fas fa-satellite me-1"></i> Mapped
                                        </span>
                                    @else
                                        <span class="text-warning x-small">
                                            <i class="fas fa-exclamation-triangle me-1"></i> No GPS
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($fundi->status == 'pending')
                                        <form action="{{ route('admin.craftsmen.approve', $fundi->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm fw-bold">
                                                Approve
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-success-soft text-success px-3 py-2 border-0 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Verified
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle border shadow-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                            <li>
                                           <a class="dropdown-item py-2" href="{{ route('admin.craftsmen.show', $fundi->id) }}">
                                            <i class="fas fa-eye me-2 text-primary"></i> View Profile
                                            </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button class="dropdown-item py-2 text-danger" onclick="return confirm('Delete this craftsman?')">
                                                    <i class="fas fa-trash-alt me-2"></i> Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-users-slash fa-3x text-light mb-3"></i>
                                        <p class="text-muted fw-light">No registered craftsmen found in the system.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Clean UI Extensions */
    :root {
        --bs-info-soft: #e0f7fa;
        --bs-success-soft: #e8f5e9;
        --bs-danger-soft: #ffebee;
    }

    .bg-info-soft { background-color: var(--bs-info-soft) !important; }
    .bg-success-soft { background-color: var(--bs-success-soft) !important; }
    .bg-danger-soft { background-color: var(--bs-danger-soft) !important; }

    .x-small { font-size: 0.7rem; }
    
    .table thead th {
        font-size: 0.75rem;
        letter-spacing: 0.05rem;
        font-weight: 700;
        color: #6c757d;
    }

    .hover-zoom {
        transition: transform 0.2s ease;
        border-radius: 4px;
    }

    .hover-zoom:hover {
        transform: scale(1.15);
        z-index: 10;
        position: relative;
    }

    .avatar-container {
        position: relative;
        display: inline-block;
    }

    /* Remove standard button focus outline */
    .btn:focus { box-shadow: none !important; }

    /* Custom scrollbar for table responsive */
    .table-responsive::-webkit-scrollbar { height: 6px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #dee2e6; border-radius: 10px; }
</style>
@endsection