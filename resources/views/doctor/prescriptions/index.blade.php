@extends('layouts.doctor')

@section('title','My Prescriptions')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3>My Prescriptions</h3>

    <a href="{{ route('doctor.prescriptions.create') }}" class="btn btn-primary">

        <i class="las la-plus-circle"></i>

        Create Prescription

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Patient</th>

                    <th>Date</th>

                    <th width="270">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($prescriptions as $prescription)

                <tr>

                    <td>{{ $prescription->id }}</td>

                    <td>

                        {{ $prescription->appointment->patient->name }}

                    </td>

                    <td>

                        {{ $prescription->created_at->format('d M Y') }}

                    </td>

                    <td>

                        <a href="{{ route('doctor.prescriptions.show',$prescription) }}"
                            class="btn btn-info btn-sm">

                            View

                        </a>

                        <a href="{{ route('doctor.prescriptions.edit',$prescription) }}"
                            class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form action="{{ route('doctor.prescriptions.destroy',$prescription) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete Prescription?')"
                                class="btn btn-danger btn-sm">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">

                        No prescriptions available.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $prescriptions->links() }}

    </div>

</div>

@endsection