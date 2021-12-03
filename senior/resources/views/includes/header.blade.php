<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ログイン情報</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-current="page" href="#">id:{{ Auth::user()->id }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-current="page" href="#">名前:{{ Auth::user()->name }}</a>
                        </li>
                        @if ( Auth::user()->manager_flg === 1)
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-current="page" href="#">管理者でログイン中</a>
                        </li>
                        @endif
                    </ul>

                <form class="d-flex">
                    <button class="btn btn-sm btn-outline-success me-2" type="button">ログアウト</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="card-footer">
    </div>

    <main class="py-4">
            @yield('content')
    </main>

</body>
