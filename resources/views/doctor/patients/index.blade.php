@extends('layouts.doctor')

@section('title', 'My Patients')

@section('content')

    <h3 class="mb-4">My Patients</h3>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Phone</th>

                        <th>Gender</th>

                        <th>Age</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($patients as $patient)

                        <tr>

                            <td>{{ $patient->patient_code }}</td>

                            <td>{{ $patient->name }}</td>

                            <td>{{ $patient->phone }}</td>

                            <td>{{ $patient->gender }}</td>

                            <td>{{ $patient->age }}</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                No Patients Found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

            {{ $patients->links() }}

        </div>

    </div>

@endsection