@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task List') }}</div>

                    <div class="card-body sortable-item">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @foreach($tasks as $task)
                            <div class="card mb-2" id="task_{{ $task->id }}">
                                <div class="card-header">{{ $task->name }}</div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <p>Task: {{ $task->name }}</p>
                                        <p>Priority: {{ $task->priority }}</p>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-2">
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
                handle: ".card-header",
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
                                    window.location.href = '/';
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
