@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task List') }}</div>

                    <div class="card-body">
                        @foreach($tasks as $task)
                            <div class="card mb-2">
                                <div class="card-header">{{ $task->name }}</div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <p>Priority: {{ $task->priority }}</p>
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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
@endsection
