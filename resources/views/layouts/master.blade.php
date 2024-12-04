<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ URL::to('assets/img/favicon-gs.png') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.cs') }}s">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/simple-calendar/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>
<body>
<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ URL::to('assets/img/icon.png') }}" alt="Logo">
            </a>
        </div>
        <div class="menu-toggle">
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
        </div>

        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>
        <ul class="nav user-menu">
            <li class="nav-item dropdown noti-dropdown me-2">
                <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                    <img src="assets/img/icons/header-icon-05.svg" alt="">
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#">View all Notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item zoom-screen me-2">
                <a href="#" class="nav-link header-nav-list win-maximize">
                    <img src="assets/img/icons/header-icon-04.svg" alt="">
                </a>
            </li>

            <li class="nav-item dropdown has-arrow new-user-menus">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <div class="user-text">
                                <h6>{{ Session::get('TenDN') }}</h6>
                                <p class="text-muted mb-0">{{ Session::get('TenVaiTro') }}</p>
                            </div>
                        </span>
                </a>
                <div class="dropdown-menu">
                    <div class="user-header">
                        <div class="user-text">
                            <h6>{{ Session::get('TenDN') }}</h6>
                            <p class="text-muted mb-0">{{ Session::get('TenVaiTro') }}</p>
                        </div>
                    </div>
{{--                    <a class="dropdown-item" href="{{ route('user/profile/page') }}">My Profile</a>--}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    {{-- side bar --}}
    @include('sidebar.sidebar')
    {{-- content page --}}
    @yield('content')
</div>

<script src="{{ URL::to('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::to('assets/js/feather.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/apexchart/chart-data.js') }}"></script>
<script src="{{ URL::to('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
<script src="{{ URL::to('assets/js/calander.js') }}"></script>
<script src="{{ URL::to('assets/js/circle-progress.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::to('assets/js/script.js') }}"></script>
@yield('script')
</body>
</html>
