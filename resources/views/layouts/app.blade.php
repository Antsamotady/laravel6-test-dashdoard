<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel test')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
        </div>

        <div class="hero">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    @if(Route::is('dashboard.menu1'))
                        <li class="breadcrumb-item active" aria-current="page">Menu1</li>
                    @elseif(Route::is('dashboard.menu3'))
                        <li class="breadcrumb-item active" aria-current="page">Menu3</li>
                    @elseif(Route::is('dashboard.menu2') || Route::is('dashboard.menu2Submenu1') || Route::is('dashboard.menu2Submenu2'))
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.menu2') }}">Menu2</a></li>
                        @if(Route::is('dashboard.menu2Submenu1'))
                            <li class="breadcrumb-item active" aria-current="page">Submenu1</li>
                        @elseif(Route::is('dashboard.menu2Submenu2'))
                            <li class="breadcrumb-item active" aria-current="page">Submenu2</li>
                        @endif
                    @endif
                </ol>
            </nav>
        </div>

        @yield('content')

        <div class="footer">FOOTER</div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</body>
</html>