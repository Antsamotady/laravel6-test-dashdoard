@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-3 left-menu">
            <div class="col-12 mb-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="accordion" id="accordionExample">
                @if(Route::is('dashboard.list'))
                    <div class="card active">
                @else
                    <div class="card">
                @endif
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <a href="{{ route('dashboard.list') }}">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Menu 1
                                    </button>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        </div>
                    </div>
                @if(Route::is('dashboard.menu2') || Route::is('dashboard.menu2Submenu1') || Route::is('dashboard.menu2Submenu2'))
                    <div class="card active">
                @else
                    <div class="card">
                @endif
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Menu 2
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <a href="{{ route('dashboard.menu2Submenu1') }}">Submenu1</a><br>
                                <a href="{{ route('dashboard.menu2Submenu2') }}">Submenu2</a>
                            </div>
                        </div>
                    </div>
                @if(Route::is('dashboard.menu3'))
                    <div class="card active">
                @else
                    <div class="card">
                @endif
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="menu3-btn">
                                    Menu 3
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-9">
            <div class="menu-content">
                @yield('menu-content')
            </div>
        </div>

        <script type="text/javascript">
            var name = "";
            var status = "";

            window.onload = function() {
                $.ajax({
                    type : 'get',
                    url : '{{ URL::to("dashboard/search") }}',
                    data:{'name':name, 'status':status},
                    success:function(data){
                        $('.user-list').html(data);
                    }
                });
            }

            $(document).on('click', '#menu3-btn', function(){
                $.ajax({
                    type : 'get',
                    url : '{{ URL::to("dashboard/menu3") }}',
                    success:function(data){
                        $('.menu-content').replaceWith(data);
                    }
                });
            });
        </script>
    </div>
@endsection