@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Maoni na Maombi ya Wateja (Job Requests)</h4>
            <p class="text-muted small mb-0">Orodha ya maoni na maombi yote yaliyoombwa na wateja.</p>
        </div>
        <span class="badge bg-primary fs-6 px-3 py-2">Jumla: {{ $comments->total() }}</span>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show small" role="alert">
            <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-4">Mteja / Mtumiaji</th>
                            <th scope="col">Maoni / Maelezo ya Kazi</th>
                            <th scope="col">Tarehe & Muda</th>
                            <th scope="col" class="text-end pe-4">Kitendo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $comment)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name ?? 'Mteja') }}&background=0284c7&color=fff" 
                                             class="rounded-circle me-3" 
                                             width="40" 
                                             height="40" 
                                             alt="Avatar">
                                        <div>
                                            <h6 class="mb-0 fw-semibold text-dark">{{ $comment->user->name ?? 'Mteja Aliyefutwa' }}</h6>
                                            <small class="text-muted">{{ $comment->user->email ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 text-dark" style="max-width: 450px; word-wrap: break-word;">
                                        {{-- Inasoma column ya maoni kutoka JobRequest (Inachukua comment, description, au details) --}}
                                        {{ $comment->comment ?? $comment->description ?? $comment->details ?? 'Bila maelezo' }}
                                    </p>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fa-regular fa-clock me-1"></i>
                                        {{ $comment->created_at->format('d M, Y - H:i') }}
                                    </small>
                                </td>
                                <td class="text-end pe-4">
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Je, una uhakika unataka kufuta maoni haya?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-2">
                                            <i class="fa-solid fa-trash me-1"></i> Futa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fa-regular fa-comments fs-2 d-block mb-2 text-secondary"></i>
                                    Hakuna maoni au maombi yoyote yaliyopatikana kwa sasa.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if ($comments->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection