@extends('layouts.admin')

@section('title','New Appointment')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Create Appointment</h3>
        </div>

        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.appointments.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Patient</label>
                        <select name="patient_id" class="form-control" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->patient_code }} - {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Doctor</label>
                        <select name="doctor_id" class="form-control" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    Dr. {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Date</label>
                        <input type="date" name="appointment_date" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Time</label>
                        <input type="time" name="appointment_time" class="form-control" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Problem / Symptoms</label>
                        <textarea name="problem" rows="4" class="form-control" required></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Remarks</label>
                        <textarea name="remarks" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">
                            Book Appointment
                        </button>
                        
                        <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
