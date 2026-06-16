@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Service Management</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Add New Service
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Service Details</th> {{-- Changed from Service Name --}}
                            <th>Icon Class</th>
                            <th>Craftsmen Count</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td class="ps-4">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" class="rounded shadow-sm" style="width: 60px; height: 45px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 45px; border: 1px dashed #ccc;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold d-block text-dark">{{ $service->name }}</span>
                                {{-- Added Description here --}}
                                @if($service->description)
                                    <small class="text-secondary d-block mb-1" style="max-width: 250px;">
                                        {{ Str::limit($service->description, 50) }}
                                    </small>
                                @endif
                                <small class="text-muted">Slug: {{ $service->slug }}</small>
                            </td>
                            <td>
                                <i class="fas {{ $service->icon }} text-primary me-1"></i>
                                <code class="small text-secondary">{{ $service->icon }}</code>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $service->craftsmen_count }} Craftsmen
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-light mb-3 d-block"></i>
                                <p class="text-muted mb-0">No services found. Click "Add New Service" to get started.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection