@extends('layouts.patient')

@section('title', 'Prescription')

@section('content')

    <div class="card shadow">

        <div class="card-body">

            <h2 class="mb-4">

                Prescription

            </h2>

            <hr>

            <h5>

                Patient

            </h5>

            <p>

                {{ $prescription->appointment->patient->name }}

            </p>

            <h5>

                Doctor

            </h5>

            <p>

                Dr.

                {{ $prescription->appointment->doctor->name }}

            </p>

            <hr>

            <h5>

                Symptoms

            </h5>

            <p>

                {{ $prescription->symptoms }}

            </p>

            <h5>

                Diagnosis

            </h5>

            <p>

                {{ $prescription->diagnosis }}

            </p>

            <h5>

                Medicines

            </h5>

            <p>

                {!! nl2br(e($prescription->medicines)) !!}

            </p>

            <button onclick="window.print()" class="btn btn-success">

                Print

            </button>

        </div>

    </div>

@endsection