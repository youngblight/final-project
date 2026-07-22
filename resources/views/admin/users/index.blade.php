@extends('layouts.admin') 

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">User Management</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-users me-1"></i> All Registered Users
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th text-end>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                @if($user->is_blocked)
                                    <span class="badge bg-danger">Aliyeblokiwa</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    {{-- Form ya Ku-Block au Fungulia Mtumiaji --}}
                                    <form action="{{ route('admin.users.block', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-warning' }}">
                                            <i class="fas {{ $user->is_blocked ? 'fa-unlock' : 'fa-ban' }}"></i>
                                            {{ $user->is_blocked ? 'Fungulia' : 'Block' }}
                                        </button>
                                    </form>

                                    {{-- Form ya Kufuta Mtumiaji --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                          onsubmit="return confirm('Je, una uhakika unataka kumfuta mtumiaji huyu? Kitendo hiki hakiwezi kurudishwa!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection