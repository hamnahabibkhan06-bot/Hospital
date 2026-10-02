@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/pages/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/Chart.min.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="mb-4 mt-3">
        <h2>Welcome, {{ auth()->user()->name }}</h2>
        <p class="text-muted">One Health Hospital Management Dashboard</p>
    </div>

    
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-user-md dashboard-icon"></i>
                    <h2>{{ $totalDoctors }}</h2>
                    <p>Total Doctors</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-user-injured dashboard-icon"></i>
                    <h2>{{ $totalPatients }}</h2>
                    <p>Total Patients</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-user-shield dashboard-icon"></i>
                    <h2>{{ $totalAdmins }}</h2>
                    <p>Total Admins</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-hospital dashboard-icon"></i>
                    <h2>{{ $totalDepartments }}</h2>
                    <p>Departments</p>
                </div>
            </div>
        </div>

    </div>

   
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-check-circle dashboard-icon"></i>
                    <h2>{{ $activeDoctors }}</h2>
                    <p>Active Doctors</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-times-circle dashboard-icon"></i>
                    <h2>{{ $inactiveDoctors }}</h2>
                    <p>Inactive Doctors</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-user-check dashboard-icon"></i>
                    <h2>{{ $activePatients }}</h2>
                    <p>Active Patients</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-user-times dashboard-icon"></i>
                    <h2>{{ $inactivePatients }}</h2>
                    <p>Inactive Patients</p>
                </div>
            </div>
        </div>

    </div>

    
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-calendar-check dashboard-icon"></i>
                    <h2>{{ $totalAppointments }}</h2>
                    <p>Total Appointments</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-calendar-day dashboard-icon"></i>
                    <h2>{{ $todayAppointments }}</h2>
                    <p>Today's Appointments</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-clock dashboard-icon"></i>
                    <h2>{{ $pendingAppointments }}</h2>
                    <p>Pending Appointments</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="las la-file-medical dashboard-icon"></i>
                    <h2>{{ $totalPrescriptions }}</h2>
                    <p>Prescriptions</p>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('admin-assets/SiteAssets/js/vendors/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/SiteAssets/js/dashboard.js') }}"></script>
@endpush
