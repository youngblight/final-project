@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">Edit Service: {{ $service->name }}</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Service Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">FontAwesome Icon Class</label>
                            <input type="text" name="icon" class="form-control" value="{{ $service->icon }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Image</label>
                            <div class="mb-2">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" class="rounded shadow-sm" style="width: 100px;">
                                @else
                                    <span class="text-muted">No image uploaded</span>
                                @endif
                            </div>
                            <label class="form-label">Upload New Image (Optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light">Back</a>
                            <button type="submit" class="btn btn-primary px-5">Update Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection