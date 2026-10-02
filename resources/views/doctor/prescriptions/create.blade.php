@extends('layouts.doctor')

@section('title','Create Prescription')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4>Create Prescription</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('doctor.prescriptions.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">Appointment</label>

                    <select name="appointment_id" class="form-control" required>

                        <option value="">Select Appointment</option>

                        @foreach($appointments as $appointment)

                        <option value="{{ $appointment->id }}">

                            {{ $appointment->patient->name }}

                            -

                            {{ $appointment->appointment_date }}

                            -

                            {{ $appointment->appointment_time }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label>Symptoms</label>

                    <textarea

                        class="form-control"

                        name="symptoms"

                        rows="3"

                        required>{{ old('symptoms') }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Diagnosis</label>

                    <textarea

                        class="form-control"

                        name="diagnosis"

                        rows="3"

                        required>{{ old('diagnosis') }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Medicines</label>

                    <textarea

                        class="form-control"

                        name="medicines"

                        rows="5"

                        required>{{ old('medicines') }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Recommended Tests</label>

                    <textarea

                        class="form-control"

                        name="tests"

                        rows="3">{{ old('tests') }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Doctor Advice</label>

                    <textarea

                        class="form-control"

                        name="advice"

                        rows="3">{{ old('advice') }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Next Visit Date</label>

                    <input

                        type="date"

                        class="form-control"

                        name="next_visit"

                        value="{{ old('next_visit') }}">

                </div>

                <button class="btn btn-success">

                    Save Prescription

                </button>

                <a href="{{ route('doctor.prescriptions.index') }}"

                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection