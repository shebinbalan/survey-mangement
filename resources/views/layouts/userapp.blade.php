<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User Panel | {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #1f2937;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: #0d6efd;
        }

        .footer {
            background: #1f2937;
            color: #ccc;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }

        .content-wrapper {
            min-height: 80vh;
            padding: 2rem;
        }

           .card-title {
        font-weight: bold;
        font-size: 1.25rem;
    }

    .btn-primary {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

      body {
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    /* Survey Card Styling */
    .card {
        transition: all 0.3s ease-in-out;
        border-radius: 20px; /* Rounded corners */
    }

    .card:hover {
        transform: translateY(-10px); /* Card lifts on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow on hover */
    }

    .card-body {
        padding: 30px; /* More padding for the content */
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #4CAF50; /* Custom green color */
        border-color: #388E3C;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #388E3C;
        border-color: #2c6b2f;
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 0.2rem rgba(72, 169, 97, 0.5);
    }

    .btn-lg {
        font-size: 1.1rem;
        padding: 12px 24px;
    }

    .rounded-pill {
        border-radius: 50px; /* Rounded pill-shaped button */
    }

    .shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12); /* Light shadow for smooth appearance */
    }

    .transition-effect {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Typography */
    h3 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }
    }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">User Panel</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser" aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.surveys.*') ? 'active' : '' }}" href="{{ route('user.surveys.index') }}">
                            <i class="fas fa-list me-1"></i> Surveys
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.responses') ? 'active' : '' }}" href="{{ route('user.responses.index') }}">
                            <i class="fas fa-history me-1"></i> My Responses
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-danger ms-3" type="submit">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container content-wrapper">
        <h5 class="mb-4">Welcome, {{ Auth::user()->name }}</h5>
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; {{ date('Y') }} Your Company. All rights reserved.
    </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
