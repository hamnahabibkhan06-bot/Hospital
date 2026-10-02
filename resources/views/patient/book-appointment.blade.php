@extends('layouts.patient')

@section('title','Book Appointment')

@section('content')

<div class="card shadow">

    <div class="card-header">

        <h4>Book Appointment</h4>

    </div>

    <div class="card-body">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST"
              action="{{ route('patient.appointments.store') }}">

            @csrf

            <input
                type="hidden"
                name="doctor_id"
                value="{{ $doctor->id }}">

            <div class="mb-3">

                <label>Doctor</label>

                <input
                    class="form-control"
                    readonly
                    value="Dr. {{ $doctor->name }}">

            </div>

            <div class="mb-3">

                <label>Department</label>

                <input
                    class="form-control"
                    readonly
                    value="{{ $doctor->department->name ?? '' }}">

            </div>

            <div class="mb-3">

                <label>Date</label>

                <input
                    type="date"
                    class="form-control"
                    name="appointment_date"
                    required>

            </div>

            <div class="mb-3">

                <label>Time</label>

                <input
                    type="time"
                    class="form-control"
                    name="appointment_time"
                    required>

            </div>

            <div class="mb-3">

                <label>Problem</label>

                <textarea
                    class="form-control"
                    rows="4"
                    name="problem"
                    required></textarea>

            </div>

            <button
                class="btn btn-primary">

                Book Appointment

            </button>

        </form>

    </div>

</div>

@endsection