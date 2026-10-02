@extends('layouts.patient')

@section('title','Patient Dashboard')

@section('content')

{{-- <h3 class="mb-4">Patient Dashboard</h3> --}}
<h3 class="mb-1">Welcome, {{ auth()->user()->name }}</h3>
<p class="text-muted mb-4">Manage your appointments and prescriptions.</p>

<div class="row">
    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body text-center">
                <h2>{{ $appointments }}</h2>
                <h6>Total Appointments</h6>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body text-center">
                <h2>{{ $pending }}</h2>
                <h6>Pending</h6>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body text-center">
                <h2>{{ $completed }}</h2>
                <h6>Completed</h6>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow">
            <div class="card-body text-center">
                <h2>{{ $prescriptions }}</h2>
                <h6>Prescriptions</h6>
            </div>
        </div>
    </div>
</div>

@endsection
