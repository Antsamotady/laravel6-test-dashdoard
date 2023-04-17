@extends('dashboard.index')

@section('menu-content')
    <h1>Menu 2</h1>
    <p>This is the content for menu 2.</p>
    <ul>
        <li><a href="{{ route('dashboard.submenu1') }}">Sub 1</a></li>
        <li><a href="{{ route('dashboard.submenu2') }}">Sub 2</a></li>
    </ul>
@endsection
