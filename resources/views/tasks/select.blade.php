@extends('layouts.app')

@section('content')
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
@endsection
