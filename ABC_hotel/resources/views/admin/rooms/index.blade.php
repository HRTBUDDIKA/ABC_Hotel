<!-- resources/views/admin/rooms/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Rooms Management</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Room
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Bed Type</th>
                            <th>Occupancy</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>
                                    <img src="{{ Storage::url($room->image) }}" alt="Room" class="img-thumbnail" style="width: 100px; height: 70px; object-fit: cover;">
                                </td>
                                <td>{{ $room->category }}</td>
                                <td>{{ $room->size }} m²</td>
                                <td>{{ $room->bed_type }}</td>
                                <td>{{ $room->max_occupancy }}</td>
                                <td>${{ number_format($room->price, 2) }}</td>
                                <td>
                                <span class="badge {{ $room->status === 'available' ? 'bg-success' : ($room->status === 'occupied' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $room->status }}
                                </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this room?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $rooms->links() }}
        </div>
    </div>
@endsection
