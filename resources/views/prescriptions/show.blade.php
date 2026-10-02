@extends('layouts.admin')

@section('title', 'Prescription')

@section('content')

    <div class="container mt-4">

        <div class="card shadow printable-area">

            <div class="card-header text-center">

                <h2>Hospital Management System</h2>

                <p>
                    ABC Hospital<br>
                    Lahore, Pakistan<br>
                    Phone: +92-300-1234567
                </p>

            </div>

            <div class="card-body">

                <div class="row mb-4">

                    <div class="col-md-6">

                        <strong>Prescription ID:</strong>

                        RX-{{ str_pad($prescription->id, 4, '0', STR_PAD_LEFT) }}

                        <br>

                        <strong>Date:</strong>

                        {{ $prescription->created_at->format('d M Y') }}

                    </div>

                    <div class="col-md-6 text-end">

                        <strong>Doctor</strong>

                        <br>

                        Dr.
                        {{ $prescription->appointment->doctor->name }}

                    </div>

                </div>

                <hr>

                <div class="row mb-3">

                    <div class="col-md-6">

                        <strong>Patient Name</strong>

                        <p>{{ $prescription->appointment->patient->name }}</p>

                    </div>

                    <div class="col-md-6">

                        <strong>Appointment ID</strong>

                        <p>

                            APT-{{ str_pad($prescription->appointment->id, 4, '0', STR_PAD_LEFT) }}

                        </p>

                    </div>

                </div>

                <hr>

                <h5>Symptoms</h5>

                <p>

                    {{ $prescription->symptoms }}

                </p>

                <h5>Diagnosis</h5>

                <p>

                    {{ $prescription->diagnosis }}

                </p>

                <h5>Medicines</h5>

                <p>

                    {!! nl2br(e($prescription->medicines)) !!}

                </p>

                <br><br>

                <div class="text-end">

                    _______________________

                    <br>

                    Doctor Signature

                </div>

            </div>

        </div>

        <div class="mt-3 no-print">

            <button onclick="window.print()" class="btn btn-success">

                Print Prescription

            </button>

            <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

@endsection

@push('styles')

    <style>
        @media print {

            .no-print {

                display: none;

            }

            .navbar {

                display: none;

            }

            .side-nav {

                display: none;

            }

            .main-content {

                margin-left: 0;

                width: 100%;

            }

            body {

                background: white;

            }

        }
    </style>

@endpush