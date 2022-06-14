<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arrays sort') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.crowdin.com/apps/dist/iframe.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="col-lg-8 mx-auto p-3 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Arrays sort. Demo study project.</span>
            </a>
        </header>
        <main id="app">
            Loading...
        </main>
        <footer class="pt-5 my-5 text-muted border-top">
            Created by YHorodyskyy)) · © 2022
        </footer>
    </div>
    <script>
        let apiRouteSort= '{{ route("array.index") }}'
        let apiRouteWrite= '{{ route("array.write") }}'
    </script>
</body>
</html>
