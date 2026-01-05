<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title','Dashboard')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="btn btn-sm btn-danger">Logout</button>
    </form>
</nav>

<div class="container-fluid">
    <div class="row">

        <aside class="col-md-2 bg-white border-end min-vh-100 p-3">
            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
               
            </ul>
        </aside>

        <main class="col-md-10 p-4">
            <h4 class="mb-3">@yield('page-title')</h4>

            @yield('content')
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
