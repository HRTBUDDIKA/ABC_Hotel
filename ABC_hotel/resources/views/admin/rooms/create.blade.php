<!-- resources/views/admin/rooms/create.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2>{{ isset($room) ? 'Edit Room' : 'Create New Room' }}</h2>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($room))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category"
                                   value="{{ old('category', isset($room) ? $room->category : '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="size" class="form-label">Size (m²)</label>
                            <input type="number" class="form-control" id="size" name="size" step="0.01"
                                   value="{{ old('size', isset($room) ? $room->size : '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="bed_type" class="form-label">Bed Type</label>
                            <select class="form-select" id="bed_type" name="bed_type" required>
                                <option value="Single" {{ (isset($room) && $room->bed_type === 'Single') ? 'selected' : '' }}>Single</option>
                                <option value="Double" {{ (isset($room) && $room->bed_type === 'Double') ? 'selected' : '' }}>Double</option>
                                <option value="King" {{ (isset($room) && $room->bed_type === 'King') ? 'selected' : '' }}>King</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="max_occupancy" class="form-label">Max Occupancy</label>
                            <input type="number" class="form-control" id="max_occupancy" name="max_occupancy"
                                   value="{{ old('max_occupancy', isset($room) ? $room->max_occupancy : '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="special_feature" class="form-label">Special Feature</label>
                            <input type="text" class="form-control" id="special_feature" name="special_feature"
                                   value="{{ old('special_feature', isset($room) ? $room->special_feature : '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                   value="{{ old('price', isset($room) ? $room->price : '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="available" {{ (isset($room) && $room->status === 'available') ? 'selected' : '' }}>Available</option>
                                <option value="occupied" {{ (isset($room) && $room->status === 'occupied') ? 'selected' : '' }}>Occupied</option>
                                <option value="maintenance" {{ (isset($room) && $room->status === 'maintenance') ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Room Image</label>
                            <input type="file" class="form-control" id="image" name="image"
                                {{ isset($room) ? '' : 'required' }}>
                            @if(isset($room) && $room->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($room->image) }}" alt="Current Room Image"
                                         class="img-thumbnail" style="height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($room) ? 'Update Room' : 'Create Room' }}
                            </button>
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
