@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Appointments</h2>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
            New Appointment
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Token</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->token_no }}</td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">{{ $appointment->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
