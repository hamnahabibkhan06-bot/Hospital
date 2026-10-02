<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>@yield('title', 'Patient Dashboard')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/pages/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @stack('styles')

</head>

<body>

    <header>

        <nav class="navbar navbar-expand-lg shadow-sm fixed-top">

            <a class="navbar-brand" href="{{ route('patient.dashboard') }}">

                <img src="{{ asset('admin-assets/SiteAssets/images/hospital-website.png') }}"
     width="45"
     height="45"
     alt="One Health Hospital">

                <span><strong>O</strong>ne-<strong>H</strong>ealth</span>

            </a>

            <div class="navbar-collapse">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">

                        <a class="nav-link">

                            <img class="rounded-circle" width="35"
                                src="{{ asset('admin-assets/SiteAssets/images/person.jpg') }}">

                            {{ auth()->user()->name }}

                        </a>

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

                <a class="list-group-item" href="{{ route('patient.dashboard') }}">

                    <i class="las la-home"></i>

                    Dashboard

                </a>

                <a class="list-group-item" href="{{ route('patient.doctors') }}">

                    <i class="las la-user-md"></i>

                    Doctors

                </a>

                <a href="{{ route('patient.appointments') }}" class="list-group-item">

                    <i class="las la-calendar-check"></i>

                    My Appointments

                </a>

                <a class="list-group-item" href="{{ route('patient.prescriptions') }}">

                    <i class="las la-file-medical"></i>

                    My Prescriptions

                </a>

                <a class="list-group-item" href="{{ route('profile.edit') }}">

                    <i class="las la-user"></i>

                    Profile

                </a>

            </ul>

        </div>

        <div class="main-content">

            <div class="container-fluid">

                @yield('content')

            </div>

        </div>

    </main>

    <script src="{{ asset('admin-assets/SiteAssets/js/vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/SiteAssets/js/vendors/bootstrap.bundle.min.js') }}"></script>

    @stack('scripts')

</body>

</html>