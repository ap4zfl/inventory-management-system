<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'inventory-management-system')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">IMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto">
                        @if(session('user_id'))
                        <li class="nav-item">
                            @if (session('admin'))
                            <a class="nav-link" href="{{ url('admin-dashboard') }}">Dashboard</a>
                            @elseif (session('manager'))
                            <a class="nav-link" href="{{ url('manager-dashboard') }}">Dashboard</a>
                            @else
                            <a class="nav-link" href="{{ url('adviser-dashboard') }}">Dashboard</a>
                            @endif
                           
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                        </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('registration') }}">Signup</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
