<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>@yield('title', 'Laravel test')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
</head>
<body>
    <div id="app">
        @auth
        <ul class="nav justify-content-between bg-white mb-2 p-2">
            <li class="nav-item">
                <a class="nav-link disabled" href="#">LOGO</a>
            </li>
            <li class="nav-item">
                <a class="dropdown-item mr-sm-2 d-flex align-items-center" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span>{{ __('Déconnexion') }}&nbsp;</span>
                    <span class="material-icons md-18">exit_to_app</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                </form>
            </li>
        </ul>
  
        <div class="m-2">
            <div class="row my-2 px-2">
                <div class="col-2">
                    <div class="row">
                        <div class="col-4">
                            <img id="avatar-image-logo" src="images/{{ Auth::user()->image }}" alt="">
                        </div>
                        <div class="col-8">
                            Bienvenue,
                            <div class="font-weight-bolder">{{ Auth::user()->surname }}&nbsp;{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div id="left-arrow-button">
                        <div class="d-flex">
                            <span class="btn-breadcrumb breadcrumb-button">Gestion générale</span>
                            <span class="btn-breadcrumb text-secondary" id="right-arrow-button-non-active">Liste des utilisateurs</span>
                        </div>
                    </div>
                    <div id="right-arrow-button" style="display:none;">
                        <div href="#" title="" class="breadcrumb-button">
                            <div class="d-flex">
                                <span class="btn-breadcrumb" id="left-arrow-button"><a href="#" class="breadcrumb-button">Gestion générale</a></span>
                                <span class="btn-breadcrumb btn-breadcrumb-current text-light" id="right-arrow-button">Liste des utilisateurs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active text-primary" href="#">Menu</a>
                        </li>
                    </ul>
                    <div id="non-active-left-side-button">
                        <div id="non-active-left-side-button" class="d-flex align-items-center left-side-button mt-4">
                            <span class="material-icons text-primary md-22 material-icons-settings">settings</span>
                            <span class="text-btn-left-side">Gestion générale</span>
                            <span class="material-icons text-secondary md-18 material-icons-chevron-right">chevron_right</span>
                        </div>
                    </div>
                    <div id="active-left-side-button" style="display:none;">
                        <div class="d-flex align-items-center left-side-button mt-4">
                            <span class="material-icons text-primary md-22 material-icons-settings">settings</span>
                            <span class="text-btn-left-side">Gestion générale</span>
                            <span class="material-icons text-secondary md-18 material-icons-chevron-right">expand_more</span>
                        </div>
                        <div class="sub-btn-menu font-weight-bolder text-primary d-flex align-items-center m-2 pl-5">
                            <span class="material-icons md-18">create_new_folder</span>
                            &nbsp;User list
                        </div>
                    </div>
                </div>
                <div class="col-10 user-search-list d-none">
                    @yield('content')
                </div>
            </div>
        </div>
        @endauth

        @yield('content-login')

        
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
