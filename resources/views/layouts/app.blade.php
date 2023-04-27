<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel test')</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    ls la la
    @yield('content')

    <button type="button" class="btn btn-primary btn-lg btn-block">Click me!</button>


</body>
</html>
