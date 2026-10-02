<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>@yield('title', 'Doctor Panel')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/pages/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/pages/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @stack('styles')

</head>

<body>

<header>

    <nav class="navbar navbar-expand-lg shadow-sm fixed-top">

        <a class="navbar-brand" href="{{ route('doctor.dashboard') }}">

            <img src="{{ asset('admin-assets/SiteAssets/images/hospital-website.png') }}"
     width="45"
     height="45"
     alt="One Health Hospital">

            <span><strong>O</strong>ne-<strong>H</strong>ealth</span>
        </a>

        <div class="navbar-collapse">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-3">

                    <img src="{{ asset('admin-assets/SiteAssets/images/person.jpg') }}"
                        class="rounded-circle"
                        width="35">

                    Dr. {{ auth()->user()->name }}

                </li>

                <li class="nav-item">

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button class="btn btn-theme btn-sm">
    Logout
</button>

                    </form>

                </li>

            </ul>

        </div>

    </nav>

</header>

<main>

    <div class="side-nav">

        <ul class="list-group list-group-flush">

            <a class="list-group-item {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}"
                href="{{ route('doctor.dashboard') }}">

                <i class="las la-home"></i>

                Dashboard

            </a>

            <a class="list-group-item {{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}"
                href="{{ route('doctor.appointments.index') }}">

                <i class="las la-calendar-check"></i>

                My Appointments

            </a>

            <a class="list-group-item {{ request()->routeIs('doctor.patients.*') ? 'active' : '' }}"
                href="{{ route('doctor.patients.index') }}">

                <i class="las la-user-injured"></i>

                Patients

            </a>

            <a class="list-group-item {{ request()->routeIs('doctor.prescriptions.*') ? 'active' : '' }}"
                href="{{ route('doctor.prescriptions.index') }}">

                <i class="las la-file-medical"></i>

                Prescriptions

            </a>

            <hr>

            <div class="text-center mt-3">

                <img src="{{ asset('admin-assets/SiteAssets/images/doctor.svg') }}"
                    width="130"
                    class="img-fluid">

                <h6 class="mt-3">

                    Dr. {{ auth()->user()->name }}

                </h6>

                <small class="text-muted">

                    {{ auth()->user()->specialization ?? 'Doctor' }}

                </small>

            </div>

        </ul>

    </div>

    <div class="main-content">

        <div class="container-fluid pt-3">

            @yield('content')

        </div>

    </div>

</main>

<script src="{{ asset('admin-assets/SiteAssets/js/vendors/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/SiteAssets/js/vendors/bootstrap.bundle.min.js') }}"></script>

@stack('scripts')

</body>

</html>