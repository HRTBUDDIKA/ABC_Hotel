<!-- resources/views/admin/news-alerts/index.blade.php -->
@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('News Alerts Management') }}</h1>
            <a href="{{ route('admin.news-alerts.create') }}"
               class="btn btn-primary">
                Create New Alert
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Date Range</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($alerts as $alert)
                            <tr>
                                <td>{{ $alert->title }}</td>
                                <td>
                                    <span class="badge badge-{{ $alert->priority === 'high' ? 'danger' :
                                        ($alert->priority === 'medium' ? 'warning' : 'success') }}">
                                        {{ ucfirst($alert->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $alert->status ? 'success' : 'danger' }}">
                                        {{ $alert->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    {{ $alert->start_date->format('M d, Y') }} -
                                    {{ $alert->end_date ? $alert->end_date->format('M d, Y') : 'Indefinite' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.news-alerts.edit', $alert) }}"
                                       class="btn btn-sm btn-info mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.news-alerts.destroy', $alert) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this alert?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $alerts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


