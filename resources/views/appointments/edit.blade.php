@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Edit Appointment</h3>
        </div>

        <div class="card-body">
          
            <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                   
                    <div class="col-md-6 mb-3">
                        <label>Patient</label>
                        <select name="patient_id" class="form-control" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
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
                                <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Date</label>
                        <input type="date" name="appointment_date" class="form-control" value="{{ old('appointment_date', $appointment->appointment_date) }}" required>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label>Time</label>
                        <input type="time" name="appointment_time" class="form-control" value="{{ old('appointment_time', $appointment->appointment_time) }}" required>
                    </div>

                    
                    <div class="col-md-12 mb-3">
                        <label>Problem / Symptoms</label>
                        <textarea name="problem" rows="4" class="form-control" required>{{ old('problem', $appointment->problem) }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Remarks</label>
                        <textarea name="remarks" rows="3" class="form-control">{{ old('remarks', $appointment->remarks) }}</textarea>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending" {{ old('status', $appointment->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ old('status', $appointment->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Completed" {{ old('status', $appointment->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status', $appointment->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-success">Update Appointment</button>
                        <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
