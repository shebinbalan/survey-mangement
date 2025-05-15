<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #007bff;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #0056b3;
            color: white;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <div class="d-flex flex-grow-1" style="min-height: 100vh;">
        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Main Content Area -->
        <div class="d-flex flex-column flex-grow-1 col-md-9">
            <!-- Header -->
            @include('layouts.admin.header')

            <!-- Page Content -->
            <main class="flex-grow-1 p-4">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('layouts.admin.footer')
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    @stack('scripts')

</body>
</html>
