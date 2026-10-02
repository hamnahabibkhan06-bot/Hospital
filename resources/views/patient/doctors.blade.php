@extends('layouts.patient')

@section('title', 'Doctors')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>

            Available Doctors

        </h3>

    </div>

    <form method="GET">

        <div class="row mb-4">

            <div class="col-md-5">

                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Search Doctor">

            </div>

            <div class="col-md-5">

                <select name="department" class="form-control">

                    <option value="">

                        All Departments

                    </option>

                    @foreach($departments as $department)

                        <option value="{{ $department->id }}" @if(request('department') == $department->id) selected @endif>

                            {{ $department->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary w-100">

                    Search

                </button>

            </div>

        </div>

    </form>

    <div class="row">

        @forelse($doctors as $doctor)

            <div class="col-lg-4 mb-4">

                <div class="card shadow h-100">

                    <div class="card-body text-center">

                        @if($doctor->image)

                            <img src="{{ asset('doctor-images/' . $doctor->image) }}" width="100" height="100"
                                class="rounded-circle mb-3">

                        @else

                            <img src="{{ asset('admin-assets/SiteAssets/images/person.jpg') }}" width="100" height="100"
                                class="rounded-circle mb-3">

                        @endif

                        <h5>

                            Dr. {{ $doctor->name }}

                        </h5>

                        <p>

                            {{ $doctor->department->name ?? 'No Department' }}

                        </p>

                        <p>

                            {{ $doctor->specialization }}

                        </p>

                        <p>

                            <strong>

                                Fee:

                            </strong>

                            Rs. {{ number_format($doctor->consultation_fee) }}

                        </p>

                        <a href="{{ route('patient.appointments.create', $doctor->id) }}" class="btn btn-success">

                            Book Appointment

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No Doctors Found

                </div>

            </div>

        @endforelse

    </div>

    {{ $doctors->links() }}

@endsection