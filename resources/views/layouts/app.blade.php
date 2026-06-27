<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Warkop Apgret')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f5f6fa;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#212529;
        }

        .sidebar .nav-link{
            color:#adb5bd;
            padding:12px 20px;
            border-radius:8px;
            margin-bottom:5px;
        }

        .sidebar .nav-link:hover{
            background:#343a40;
            color:#fff;
        }

        .sidebar .nav-link.active{
            background:#0d6efd;
            color:#fff;
        }

        .content{
            min-height:100vh;
            background:#f8f9fa;
        }

        .navbar{
            background:#fff;
        }

        .card{
            border:none;
            border-radius:12px;
        }

        .table th{
            background:#0d6efd;
            color:white;
            white-space:nowrap;
        }

        .table td{
            vertical-align:middle;
        }
    </style>

    @stack('css')

</head>

<body>

<div class="d-flex">

    {{-- Sidebar --}}
    <div class="sidebar p-3">

        <h4 class="text-white text-center mb-4">
            Warkop Apgret
        </h4>

        <ul class="nav flex-column">

            @if(auth()->user()->role=='master')

                <li class="nav-item">
                    <a href="{{ route('dashboard.master') }}"
                       class="nav-link {{ request()->routeIs('dashboard.master') ? 'active':'' }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('barang.index') }}"
                       class="nav-link {{ request()->routeIs('barang.*') ? 'active':'' }}">
                        <i class="bi bi-box-seam"></i>
                        Master Barang
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('laporan.index') }}"
                       class="nav-link {{ request()->routeIs('laporan.*') ? 'active':'' }}">
                        <i class="bi bi-bar-chart"></i>
                        Laporan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('outlet.index') }}"
                       class="nav-link {{ request()->routeIs('outlet.*') ? 'active':'' }}">
                        <i class="bi bi-shop"></i>
                        Outlet
                    </a>
                </li>

            @endif


            @if(auth()->user()->role=='admin')

                <li class="nav-item">
                    <a href="{{ route('dashboard.admin') }}"
                       class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active':'' }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('barang-masuk.index') }}"
                       class="nav-link {{ request()->routeIs('barang-masuk.*') ? 'active':'' }}">
                        <i class="bi bi-box-arrow-in-down"></i>
                        Barang Masuk
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('barang-keluar.index') }}"
                       class="nav-link {{ request()->routeIs('barang-keluar.*') ? 'active':'' }}">
                        <i class="bi bi-box-arrow-up"></i>
                        Barang Keluar
                    </a>
                </li>

            @endif

        </ul>

    </div>

    {{-- Content --}}
    <div class="flex-grow-1 content">

        <nav class="navbar shadow-sm px-4">

            <div>

                <strong>
                    @yield('title')
                </strong>

            </div>

            <div class="d-flex align-items-center gap-3">

                <span>

                    {{ auth()->user()->name_user }}

                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-danger">
                        Logout
                    </button>
                </form>

            </div>

        </nav>

        <div class="container-fluid p-4">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')

</body>

</html>