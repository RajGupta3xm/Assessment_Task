<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer - @yield('title','Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body class="bg-white">

<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 border-bottom">
    <a class="navbar-brand" href="{{ route('customer.dashboard') }}">My App</a>

    <div class="ms-auto">
        <form method="POST" action="{{ route('customer.logout') }}">
            @csrf
            <button class="btn btn-outline-dark btn-sm">Logout</button>
        </form>
    </div>
</nav>

<main class="container py-4">
    <h4 class="mb-4">@yield('page-title')</h4>

    @yield('content')
</main>

<footer class="bg-light text-center py-3 border-top">
    <small>© {{ date('Y') }} My App. All rights reserved.</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
