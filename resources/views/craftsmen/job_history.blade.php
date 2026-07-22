@extends('layouts.craftsmen') {{-- Inatumia muundo mkuu wa wrapper --}}

@section('content')
<div class="container py-4">
    
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card shadow-sm border-0 text-white card-gradient-success">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase small fw-bold text-white-50 mb-1">Jumla ya Kazi Zilizokamilika</h6>
                        <h2 class="fw-extrabold display-6 mb-0">{{ $totalCompleted }}</h2>
                    </div>
                    <div class="stat-icon-box">
                        <i class="fas fa-check-double fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm border-0 text-white card-gradient-primary">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase small fw-bold text-white-50 mb-1">Jumla ya Mapato</h6>
                        <h2 class="fw-extrabold display-6 mb-0">Tsh {{ number_format($totalEarnings) }}</h2>
                    </div>
                    <div class="stat-icon-box">
                        <i class="fas fa-wallet fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-4 bg-white">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">Kumbukumbu za Kazi za Nyuma</h5>
                <p class="text-muted small mb-0">Kumbukumbu kamili ya majukumu ya wateja yaliyofungwa, kukamilika au kushughulikiwa.</p>
            </div>
            <span class="badge bg-light text-dark border rounded-pill px-3 py-2 fw-semibold">
                Kumbukumbu: {{ count($pastJobs) }}
            </span>
        </div>

        @if($pastJobs->isEmpty())
            <div class="text-center py-5">
                <div class="empty-state-icon mx-auto mb-3">
                    <i class="fas fa-history fa-2x text-muted"></i>
                </div>
                <h6 class="fw-bold text-secondary">Hakuna kumbukumbu zilizopatikana</h6>
                <p class="text-muted small px-4 mx-auto" style="max-width: 400px;">
                    Majukumu utakayoyafunga au kuyasitisha yatawekwa kiotomatiki kwenye ukurasa huu wa kumbukumbu za nyuma.
                </p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0 mb-0">
                    <thead>
                        <tr class="text-muted small text-uppercase bg-light rounded-3">
                            <th class="border-0 ps-3 rounded-start py-3">Mteja</th>
                            <th class="border-0 py-3">Tarehe</th>
                            <th class="border-0 py-3">Kiasi</th>
                            <th class="border-0 py-3">Hali</th>
                            <th class="border-0 text-end pe-3 rounded-end py-3">Alama & Maoni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pastJobs as $job)
                            <tr class="border-bottom-custom">
                                <td class="ps-3 py-3">
                                    <span class="fw-bold text-dark d-block mb-1">
                                        {{ $job->customer_name ?? ($job->user->name ?? 'Mteja Asiyejulikana') }}
                                    </span>
                                    <small class="text-muted d-flex align-items-center">
                                        <i class="fas fa-phone-alt me-1.5 text-primary opacity-75"></i>
                                        {{ $job->customer_phone ?? ($job->user->phone ?? 'Bila Namba') }}
                                    </small>
                                </td>
                                
                                <td class="text-muted small">
                                    {{ $job->updated_at->format('M d, Y') }}
                                </td>
                                
                                <td class="fw-bold text-dark">
                                    @if($job->agreed_price)
                                        <span class="text-dark">Tsh {{ number_format($job->agreed_price) }}</span>
                                    @else
                                        <span class="text-muted small fw-normal">Bila Bei</span>
                                    @endif
                                </td>
                                
                                <td>
                                    @if($job->status == 'fully_paid' || $job->status == 'completed')
                                        <span class="badge badge-custom-success text-uppercase">Imekamilika</span>
                                    @elseif($job->status == 'rejected')
                                        <span class="badge badge-custom-danger text-uppercase">Imekataliwa</span>
                                    @else
                                        <span class="badge badge-custom-secondary text-uppercase">Imeghairiwa</span>
                                    @endif
                                </td>
                                
                                <td class="text-end pe-3">
                                    @if($job->rating)
                                        <div class="mb-1 text-nowrap">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star" style="color: {{ $i <= $job->rating ? '#ffc107' : '#e2e8f0' }}; font-size: 12px;"></i>
                                            @endfor
                                        </div>
                                        @if($job->comment || $job->review)
                                            <div class="review-bubble-container d-inline-block text-start">
                                                <small class="review-bubble">
                                                    "{{ $job->comment ?? $job->review }}"
                                                </small>
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-muted small italic">Hakuna maoni</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
    .card-gradient-success {
        background: linear-gradient(135deg, #198754 0%, #2bd47e 100%);
        border-radius: 1rem !important;
    }
    .card-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #3ca0ff 100%);
        border-radius: 1rem !important;
    }
    .fw-extrabold { font-weight: 800; }
    
    .stat-icon-box {
        width: 54px;
        height: 54px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }

    .badge-custom-success {
        background-color: rgba(25, 135, 84, 0.1) !important;
        color: #198754 !important;
        border-radius: 30px;
        padding: 6px 14px;
        font-weight: 700;
        font-size: 10px;
        letter-spacing: 0.5px;
    }
    .badge-custom-danger {
        background-color: rgba(220, 53, 69, 0.1) !important;
        color: #dc3545 !important;
        border-radius: 30px;
        padding: 6px 14px;
        font-weight: 700;
        font-size: 10px;
        letter-spacing: 0.5px;
    }
    .badge-custom-secondary {
        background-color: rgba(108, 117, 125, 0.1) !important;
        color: #6c757d !important;
        border-radius: 30px;
        padding: 6px 14px;
        font-weight: 700;
        font-size: 10px;
        letter-spacing: 0.5px;
    }

    .border-bottom-custom {
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-hover tbody tr:hover {
        background-color: #f8fafc;
        transition: background-color 0.2s ease-in-out;
    }

    .review-bubble {
        display: block;
        background-color: #f8f9fa;
        color: #475569;
        font-style: italic;
        padding: 6px 12px;
        border-radius: 8px;
        margin-top: 4px;
        max-width: 240px;
        font-size: 11px;
        line-height: 1.4;
        border-left: 3px solid #cbd5e1;
    }
    .empty-state-icon {
        width: 60px;
        height: 60px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection