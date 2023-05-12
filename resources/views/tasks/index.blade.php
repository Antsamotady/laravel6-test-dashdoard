@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="card-title_">{{ __('Task List') }}</span>
                        <a href="{{ route('projects.index') }}">Project list</a>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <div class="mt-2">
                                <form method="GET" action="{{ route('tasks.index') }}">
                                    <div class="row">
                                        <div class="col-10">
                                            <select class="form-control" name="project_id" id="project_id" onchange="this.form.submit()">
                                                <option value="">{{ __('All Projects') }}</option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" @if ($project->id == request('project_id')) selected @endif>{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 target-chekbox">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox"
                                                    id="showCompleteTasks"
                                                    data-action="/tasks/showComplete"
                                                />
                                                <label class="form-check-label" for="showCompleteTasks">completed</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="show-completed-task-result"></div>
                        <div class="sortable-item">
                            @foreach($tasks as $task)
                                <div class="card mb-2 eleStuff" id="task_{{ $task->id }}">
                                    <div class="card-header card-header-target">
                                        <span>Priority: #{{ $task->priority }}</span>
                                        <span>.. {{ $task->project_id }}</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p>{{ $task->name }}</p>
                                            <div class="d-flex justify-content-around align-items-center target-chekbox">
                                                <input type="checkbox"
                                                    id="chk_{{ $task->id }}"
                                                    class="toggle-complete-task"
                                                    name="chk_{{ $task->id }}"
                                                    data-action="/tasks/toggle/{{ $task->id }}"
                                                    {{ $task->is_completed ? 'checked' : '' }}
                                                />
                                                <label for="chk_{{ $task->id }}">complete</label>

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
                        </div>
                        <div class="mt-2 text-center">
                            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm">Add Task</a>
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
                    var idSequence = data.join(',').replace(/task_/g, "");

                    var currentUrl = $(location).attr('href');
                    if (currentUrl.match(/project_id=\d+/)) {
                        url = '/projects/tasks/ajax/' + {{ $task->project_id }} + '/' + idSequence;
                        nextUrl = '/?project_id=' + {{ $task->project_id }};

                        $.ajax({
                            url: url,
                            method: 'PUT',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                window.location.href = nextUrl;
                            }
                        });

                    } else {
                        var i = 1;

                        $.each(data, function (key, value) {
                            if(value) {
                                var task = value.split("_")[1];
                                url = '/tasks/ajax/' + task;

                                $.ajax({
                                    url: url,
                                    method: 'PUT',
                                    data: {
                                        priority: i,
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function (response) {
                                        window.location.href = '/';
                                    }
                                });
                                i++;
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '.toggle-complete-task', function () {
            let url = $(this).data('action');

            $.ajax({
                method: 'post',
                url: url,
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log('yessssssssss!');
                }
            });
        });

        $(document).on('click', '#showCompleteTasks', function () {
            let url = $(this).data('action');
            console.log(url);

            $.ajax({
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    isChecked: $(this).is(':checked') ? 1 : 0
                },
                url: url,
                success: function(data) {
                    $('.show-completed-task-result').html(data);
                    $('.sortable-item').addClass('d-none');
                }
            });
        });

    </script>

@endsection
