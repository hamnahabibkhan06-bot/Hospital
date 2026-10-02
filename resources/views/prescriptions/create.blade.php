@extends('layouts.admin')

@section('title','Create Prescription')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Create Prescription</h4>
        </div>

        <div class="card-body">
            <!-- FIXED: Added admin. prefix to store route action -->
            <form action="{{ route('admin.prescriptions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Appointment</label>
                    <select name="appointment_id" class="form-control" required>
                        <option value="">Select Appointment</option>
                        @foreach($appointments as $appointment)
                            <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                {{ $appointment->patient?->name ?? 'Deleted Patient' }} — 
                                Dr. {{ $appointment->doctor?->name ?? 'Deleted Doctor' }} — 
                                {{ $appointment->appointment_date }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Symptoms</label>
                    <textarea name="symptoms" rows="3" class="form-control" required>{{ old('symptoms') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Diagnosis</label>
                    <textarea name="diagnosis" rows="3" class="form-control" required>{{ old('diagnosis') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Medicines</label>
                    <textarea name="medicines" rows="5" class="form-control" required>{{ old('medicines') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Recommended Tests</label>
                    <textarea name="tests" rows="3" class="form-control">{{ old('tests') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Doctor Advice</label>
                    <textarea name="advice" rows="3" class="form-control">{{ old('advice') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Next Visit</label>
                    <input type="date" name="next_visit" class="form-control" value="{{ old('next_visit') }}">
                </div>

                <button class="btn btn-success">Save Prescription</button>
                <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
