@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        <td>{{ $user['website'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
