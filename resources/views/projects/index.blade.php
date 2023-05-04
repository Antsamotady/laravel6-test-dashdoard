@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="card-title_">{{ __('Project List') }}</span>
                        <a href="{{ route('tasks.index') }}">Task list</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="col-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->name }}</td>
                                        <td>
                                            <a href="{{ route('tasks.index') }}/?project_id={{ $project->id }}">tasks</a>
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('projects.create') }}" class="btn btn-success btn-sm">New Project</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
