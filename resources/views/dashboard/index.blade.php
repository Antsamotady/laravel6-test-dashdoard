@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('dashboard.menu1') }}">Menu 1</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('dashboard.menu2') }}">Menu 2</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('dashboard.menu3') }}">Menu 3</a>
                    </li>
                </ul>
            </div>
            <!-- Main content -->
            <div class="col-md-10">
                @yield('menu-content')
            </div>
        </div>
    </div>
@endsection