@extends('layouts.admin')

@section('title','Patients')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Patients</h2>
        <a href="{{ route('admin.patients.create') }}" class="btn btn-primary">
            Add Patient
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Blood</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->patient_code }}</td>
                        <td>
                            @if($patient->image)
                                <img src="{{ asset('patient-images/'.$patient->image) }}" width="50" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->blood_group }}</td>
                        <td>
                            @if($patient->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $patients->links() }}
        </div>
    </div>
</div>
@endsection
