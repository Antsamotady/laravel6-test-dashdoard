@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="card-title_">{{ __('Task List') }}</span>
                        <a href="{{ route('projects.index') }}">Project list</a>
                    </div>

                    <div class="card-body sortable-item">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <form method="GET" action="{{ route('tasks.index') }}">
                                {{-- <label for="project_id">{{ __('Filter by Project') }}</label> --}}
                                <select class="form-control" name="project_id" id="project_id" onchange="this.form.submit()">
                                    <option value="">{{ __('All Projects') }}</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" @if ($project->id == request('project_id')) selected @endif>{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>

                        @foreach($tasks as $task)
                            <div class="card mb-2" id="task_{{ $task->id }}">
                                <div class="card-header card-header-target">
                                    <span>Priority: #{{ $task->priority }}</span>
                                    <span>.. {{ $task->project_id }}</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p>{{ $task->name }}</p>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-2 text-center">
                            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm">Add Task</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".sortable-item").sortable({
                handle: ".card-header-target",
                update: function (event, ui) {
                    var data = $(this).sortable('toArray', {attribute: 'id'});
                    var i = 1;
                    $.each(data, function (key, value) {
                        if(value) {
                            var id = value.split("_")[1];
                            $.ajax({
                                url: '/tasks/ajax/' + id,
                                method: 'PUT',
                                data: {
                                    priority: i,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    window.location.href = '/?project_id=' + {{ $task->project_id }};
                                }
                            });
                            i++;
                        }
                    });
                }
            });
        });
    </script>

@endsection
