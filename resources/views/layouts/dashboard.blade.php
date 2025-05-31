<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Task Managment</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/jquery.js', 'resources/js/script.js', 'resources/css/style.css'])
</head>
<style>
    @media (max-width: 775px) {
        .flex-xs-only {
            display: flex !important;
        }
    }
</style>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="text-center mb-4">
            <h4 class="text-white">Task Managment</h4>
        </div>
        <div class="col-12 flex-xs-only">
            <div class="col-6 col-md-12">
                <a href="/home" class="{{ request()->path()=="home" ? "active":""}}"><i class="fas fa-chart-bar me-2"></i> DashBoard</a>
            </div>
            <div class="col-6 col-md-12">
                <a href="/tasks/" class="{{ strpos(request()->path(),"tasks")>-1  ? "active":""}}"><i class="fas fa-users me-2"></i> Tasks</a>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>

</html>
