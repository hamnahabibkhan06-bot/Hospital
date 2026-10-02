@extends('layouts.doctor')

@section('title','Prescription')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white d-flex justify-content-between">

        <h4>

            Prescription #{{ $prescription->id }}

        </h4>

        <button onclick="window.print()" class="btn btn-light">

            Print

        </button>

    </div>

    <div class="card-body">

        <h5>

            Patient Information

        </h5>

        <hr>

        <p>

            <strong>Name:</strong>

            {{ $prescription->appointment->patient->name }}

        </p>

        <p>

            <strong>Doctor:</strong>

            Dr. {{ $prescription->appointment->doctor->name }}

        </p>

        <p>

            <strong>Date:</strong>

            {{ $prescription->created_at->format('d M Y') }}

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

        <p style="white-space: pre-line;">

            {{ $prescription->medicines }}

        </p>

        <h5>

            Tests

        </h5>

        <p>

            {{ $prescription->tests }}

        </p>

        <h5>

            Advice

        </h5>

        <p>

            {{ $prescription->advice }}

        </p>

        @if($prescription->next_visit)

        <h5>

            Next Visit

        </h5>

        <p>

            {{ \Carbon\Carbon::parse($prescription->next_visit)->format('d M Y') }}

        </p>

        @endif

    </div>

</div>

@endsection