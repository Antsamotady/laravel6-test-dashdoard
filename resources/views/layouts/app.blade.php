<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel test')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                            <div class="font-weight-bolder">{{ Auth::user()->civilite }}&nbsp;{{ Auth::user()->surname }}&nbsp;{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div id="left-arrow-button">
                        <div class="d-flex">
                            <span class="btn-breadcrumb-tab breadcrumb-button2 text-light">Tableau de bord</span>
                        </div>
                    </div>
                    <div id="right-arrow-button" style="display:none;">
                        <div href="#" title="" class="">
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
                    <div id="non-active-left-side-button2" style="display:none;">
                        <div id="non-active-left-side-button2" class="d-flex align-items-center left-side-button2 mt-4">
                            <span class="material-icons text-primary md-22 material-icons-settings">schedule</span>
                            <span class="text-btn-left-side">Tableau de bord</span>
                        </div>
                    </div>
                    <div id="active-left-side-button2">
                        <div class="d-flex align-items-center left-side-button2 mt-4">
                            <span class="material-icons text-primary md-22 material-icons-settings">schedule</span>
                            <span class="text-btn-left-side">Tableau de bord</span>
                        </div>
                    </div>
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
                <div class="col-10">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        </div>
                    @endif


                    <div class="user-stat-cards">
                        <div class="row mb-4">
                            <div class="col-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center" id="user-counts">
                                        <div class="">Nombre d'utilisateurs total</div>
                                        <h4 class="card-text" style="color: #3490dc;">{{ $totalUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center" id="user-counts">
                                        <div class="">Nombre d'utilisateurs actifs</div>
                                        <h4 class="card-text" style="color: #3490dc;">{{ $totalActifUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center" id="user-counts">
                                        <div class="">Nombre d'utilisateurs inactifs</div>
                                        <h4 class="card-text" style="color: #3490dc;">{{ $totalInactifUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center" id="user-counts">
                                        <div class="">Profils photos</div>
                                        <h4 class="card-text" style="color: #3490dc;">{{ $imageCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between mt-2">
                            <div class="col-6">
                                <div class="card stat-card">
                                    <div class="card-header text-center">Typologie d'utilisateurs</div>
                                    <div class="card-body">
                                        <canvas id="bar-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card stat-card">
                                    <div class="card-header text-center">Pourcentage d'actif / Typologie d'utilisateurs</div>
                                    <div class="card-body">
                                        <canvas id="donut-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="user-search-list d-none">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

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


            var labels = ['Mademoiselle', 'Madame', 'Monsieur'];

            var data1 = @json($groupedUser->pluck('total'));
            var barOptions = {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            precision: 0,
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            };

            var chart1 = new Chart(document.getElementById('bar-chart'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data1,
                        backgroundColor: '#ffa229',
                        borderColor: '#ffa229',
                        borderWidth: 1
                    }]
                },
                options: barOptions
            });


            var data2 = @json($groupedActifUser);
            var labels = ['Madame', 'Mademoiselle', 'Monsieur'];
            var countMe = data2.find(x => x.civilite === 'Me') ? data2.find(x => x.civilite === 'Me').count : 0;
            var countMr = data2.find(x => x.civilite === 'Mr') ? data2.find(x => x.civilite === 'Mr').count : 0;
            var countMlle = data2.find(x => x.civilite === 'Mlle') ? data2.find(x => x.civilite === 'Mlle').count : 0;

            var donutOptions = {
                plugins: {
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    Responsive: true,
                    cutoutPercentage: 50,
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    tooltip: {
                        mode: 'index',
                        callbacks: {
                            label: function(context) {
                                var label = context.label;
                                var value = context.parsed;
                                var total = {{ $totalUsers }};
                                var percentage = Math.round((value / total) * 100) + '%';
                                return percentage;
                            }
                        }
                    }
                }
            };

            var chart2 = new Chart(document.getElementById('donut-chart'), {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: [
                            countMe,
                            countMlle,
                            countMr
                        ],
                        backgroundColor: [
                            '#ef93e7',
                            '#00a1ff',
                            '#d08f97'
                        ]
                    }]
                },
                options: donutOptions
            });


            $(document).on('click', '.left-side-button2', function(){
                var userListContainer = $(".user-search-list");
                var userStatContainer = $(".user-stat-cards");

                var activeLeftBtn = $("#active-left-side-button");
                var nonActiveLeftBtn = $("#non-active-left-side-button");


                var activeLeftBtn2 = $("#active-left-side-button2");
                var nonActiveLeftBtn2 = $("#non-active-left-side-button2");

                nonActiveLeftBtn2.toggle();
                activeLeftBtn2.toggle();
                
                if (userStatContainer.hasClass("d-none")) {
                    userStatContainer.toggleClass("d-none");
                } else {
                    userStatContainer.toggleClass("d-none");
                }
            });


        </script>

        @endauth

        @yield('content-login')

        @yield('content-email')

        @yield('content-reset')

    </div>
</body>
</html>
