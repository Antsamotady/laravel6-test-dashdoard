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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        @auth
        <ul class="nav justify-content-between mb-2 bg-white">
            <li class="nav-item">
                <a class="nav-link disabled" href="#">LOGO</a>
            </li>
            <li class="nav-item">
                <a class="dropdown-item mr-sm-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span>{{ __('Déconnexion') }}</span>
                    <span class="material-icons md-18">exit_to_app</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                </form>
            </li>
        </ul>
        @endauth
  
        @yield('content')

        <script type="text/javascript">
            var name = "";
            var status = "";

            window.onload = function() {
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('search')}}',
                    data:{'name':name, 'status':status},
                    success:function(data){
                        $('.user-list').html(data);
                    }

                });
            }
        </script>

    </div>
</body>
</html>
