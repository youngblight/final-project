@extends('layouts.admin')

@section('title', 'Main Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Overview of Skilled Craftsmen Network</li>
    </ol>

    <div class="d-flex flex-wrap gap-4 mb-4">
        
        <div class="card bg-primary text-white shadow" style="min-width: 250px; flex: 1;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-white-50 small">Total Craftsmen</div>
                        <div class="fs-4 fw-bold">{{ $totalCraftsmen }}</div> 
                    </div>
                    <i class="fas fa-users fa-2x text-white-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="{{ route('admin.craftsmen.details') }}">View Details</a>
                <div class="text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>

        <div class="card bg-warning text-white shadow" style="min-width: 250px; flex: 1;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-white-50 small">Pending Verifications</div>
                        <div class="fs-4 fw-bold">{{$pendingVerifications}}</div>
                    </div>
                    <i class="fas fa-user-clock fa-2x text-white-50"></i>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="{{ route('admin.craftsmen.details') }}">View Details</a>
                <div class="text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>

    </div>
</div>
@endsection