@extends('layouts.doctor')

@section('title', 'Doctor Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Welcome, Dr. {{ auth()->user()->name }}</h3>
            <p>Manage appointments, patients and prescriptions.</p>
        </div>
    </div>

    <!-- Main Overview Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-4 col-lg-2-4">
            <div class="card shadow text-center h-100">
                <div class="card-body">
                    <h2>{{ $todayAppointments }}</h2>
                    <p class="text-muted mb-0 small">Today's Appointments</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-2-4">
            <div class="card shadow text-center h-100">
                <div class="card-body">
                    <h2>{{ $pendingAppointments }}</h2>
                    <p class="text-muted mb-0 small">Pending</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-2-4">
            <div class="card shadow text-center h-100">
                <div class="card-body">
                    <h2>{{ $completedAppointments }}</h2>
                    <p class="text-muted mb-0 small">Completed</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-2-4">
            <div class="card shadow text-center h-100">
                <div class="card-body">
                    <h2>{{ $totalPatients }}</h2>
                    <p class="text-muted mb-0 small">Patients</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-2-4">
            <div class="card shadow text-center h-100">
                <div class="card-body">
                    <h2>{{ $totalPrescriptions }}</h2>
                    <p class="text-muted mb-0 small">Total Prescriptions</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- Quick Action Navigation Modules -->
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-light">
            <strong>Quick Actions</strong>
        </div>
        <div class="card-body">
            <a href="{{ route('doctor.appointments.index') }}" class="btn btn-primary btn-sm me-2">
                Appointments
            </a>
            <a href="{{ route('doctor.patients.index') }}" class="btn btn-success btn-sm me-2">
                Patients
            </a>
            <!-- FIXED: Redirects to appointments index where prescriptions are generated per appointment context -->
            <a href="{{ route('doctor.prescriptions.index') }}" class="btn btn-info btn-sm">
    Prescriptions
</a>
    </div>
@endsection

@push('styles')
    <style>
        /* Small styling addition to make 5 dashboard stats align evenly across row lines */
        @media (min-width: 992px) {
            .col-lg-2-4 {
                flex: 0 0 20% !important;
                max-width: 20% !important;
            }
        }
    </style>
@endpush
