<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>@yield('title', 'Hospital Management System')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/pages/layout.css') }}">

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <style>

.dashboard-card{
    border:none;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
}

.dashboard-card:hover{
    transform:translateY(-6px);
}

.dashboard-icon{
    font-size:42px;
    color:#00D9A5;
    margin-bottom:15px;
}

.dashboard-card h2{
    font-size:34px;
    font-weight:700;
    margin-bottom:10px;
}

.dashboard-card p{
    color:#777;
    font-size:15px;
    margin-bottom:0;
}

</style>

@stack('styles')

    @stack('styles')

</head>

<body>

    <header>

        <nav class="navbar navbar-expand-lg shadow-sm fixed-top">

            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">

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

                            <img class="rounded-circle" src="{{ asset('admin-assets/SiteAssets/images/person.jpg') }}"
                                width="35">

                            {{ auth()->user()->name }}

                        </a>

                    </li>

                    <li class="nav-item">

                        <form action="{{ route('logout') }}" method="POST">

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

                <a class="list-group-item" href="{{ route('admin.dashboard') }}">

                    <i class="las la-home"></i>

                    Dashboard

                </a>

                <a class="list-group-item" href="{{ route('admin.departments.index') }}">

                    <i class="las la-hospital"></i>

                    Departments

                </a>

                <a class="list-group-item" href="{{ route('admin.doctors.index') }}">

                    <i class="las la-user-md"></i>

                    Doctors

                </a>

                <a class="list-group-item" href="{{ route('admin.patients.index') }}">

                    <i class="las la-user-injured"></i>

                    Patients

                </a>

                <a class="list-group-item" href="{{ route('admin.appointments.index') }}">

                    <i class="las la-calendar-check"></i>

                    Appointments

                </a>
                <a class="list-group-item" href="{{ route('admin.prescriptions.index') }}">

                    <i class="las la-file-medical"></i>

                    Prescriptions

                </a>

                {{-- <a class="list-group-item" href="{{ route('admin.reports.index') }}">

                    <i class="las la-chart-bar"></i>

                    Reports

                </a> --}}

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

    <script src="{{ asset('admin-assets/SiteAssets/js/global.js') }}"></script>

    @stack('scripts')
    

</body>

</html>
