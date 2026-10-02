<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Hospital Management')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/vendors/line-awesome.min.css') }}">

    
    <link rel="stylesheet" href="{{ asset('admin-assets/SiteAssets/css/pages/layout.css') }}">

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
        <span>One Health</span>
    </a>

    <div class="navbar-collapse">

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">

                <a class="nav-link profile-dropdown" href="#">

                    <img class="rounded-circle"
                         src="{{ asset('admin-assets/SiteAssets/images/person.jpg') }}">

                    <span>

                        {{ auth()->user()->name }}

                    </span>

                </a>

            </li>

            <li class="nav-item">

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button class="btn btn-danger btn-sm">

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
<i class="las la-shapes"></i>
<span>Dashboard</span>
</a>

<a class="list-group-item" href="#">
<i class="las la-user-injured"></i>
<span>Patients</span>
</a>

<a class="list-group-item" href="#">
<i class="las la-user-md"></i>
<span>Doctors</span>
</a>

<a class="list-group-item" href="#">
<i class="las la-building"></i>
<span>Departments</span>
</a>

<a class="list-group-item" href="#">
<i class="las la-calendar-check"></i>
<span>Appointments</span>
</a>

<a class="list-group-item" href="#">
<i class="las la-file-medical"></i>
<span>Prescriptions</span>
</a>

{{-- <a class="list-group-item" href="#">
<i class="las la-chart-bar"></i>
<span>Reports</span>
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