@extends('layouts.doctor')

@section('title','Edit Prescription')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h4>Edit Prescription</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('doctor.prescriptions.update',$prescription) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Appointment</label>

                    <select name="appointment_id" class="form-control" required>

                        @foreach($appointments as $appointment)

                        <option value="{{ $appointment->id }}"
                            {{ $appointment->id==$prescription->appointment_id ? 'selected':'' }}>

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

                    <textarea class="form-control"
                        rows="3"
                        name="symptoms"
                        required>{{ old('symptoms',$prescription->symptoms) }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Diagnosis</label>

                    <textarea class="form-control"
                        rows="3"
                        name="diagnosis"
                        required>{{ old('diagnosis',$prescription->diagnosis) }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Medicines</label>

                    <textarea class="form-control"
                        rows="5"
                        name="medicines"
                        required>{{ old('medicines',$prescription->medicines) }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Recommended Tests</label>

                    <textarea class="form-control"
                        rows="3"
                        name="tests">{{ old('tests',$prescription->tests) }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Doctor Advice</label>

                    <textarea class="form-control"
                        rows="3"
                        name="advice">{{ old('advice',$prescription->advice) }}</textarea>

                </div>

                <div class="mb-3">

                    <label>Next Visit</label>

                    <input type="date"
                        class="form-control"
                        name="next_visit"
                        value="{{ old('next_visit',$prescription->next_visit) }}">

                </div>

                <button class="btn btn-primary">

                    Update Prescription

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