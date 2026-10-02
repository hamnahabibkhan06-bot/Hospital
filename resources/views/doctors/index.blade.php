@extends('layouts.admin')

@section('title','Doctors')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h2>Doctors</h2>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
            Add Doctor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Specialization</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>
                            @if($doctor->image)
                                <img src="{{ asset('doctor-images/'.$doctor->image) }}" width="60" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $doctor->name }}</td>
                        <!-- FIXED: Added safe navigation operator and fallback string -->
                        <td>{{ $doctor->department?->name ?? 'No Department' }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>Rs {{ $doctor->consultation_fee }}</td>
                        <td>
                            @if($doctor->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Doctor?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $doctors->links() }}
        </div>
    </div>
</div>
@endsection
