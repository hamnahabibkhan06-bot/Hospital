@extends('layouts.patient')

@section('title', 'My Appointments')

@section('content')

    <h3 class="mb-4">

        My Appointments

    </h3>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Doctor</th>

                        <th>Date</th>

                        <th>Time</th>

                        <th>Token</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($appointments as $appointment)

                        <tr>

                            <td>

                                Dr. {{ $appointment->doctor->name }}

                            </td>

                            <td>

                                {{ $appointment->appointment_date }}

                            </td>

                            <td>

                                {{ $appointment->appointment_time }}

                            </td>

                            <td>

                                {{ $appointment->token_no }}

                            </td>

                            <td>

                                @if($appointment->status == "Pending")

                                    <span class="badge bg-warning">

                                        Pending

                                    </span>

                                @elseif($appointment->status == "Completed")

                                    <span class="badge bg-success">

                                        Completed

                                    </span>
                                    @elseif ($appointment->status == "Cancelled")

                                    <span class="badge bg-danger">

                                        Cancelled

                                    </span>

                                @else ($appointment->status == "Approved")

                                    <span style="      background-color: #17a2b8 !important;  display: inline-block;
    padding: .25em .4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;">

                                        Approved

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" align="center">

                                No appointments found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{ $appointments->links() }}

        </div>

    </div>

@endsection