@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Task</div>

                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Task Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $task->name }}" placeholder="Task Name here ..." required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                    @for($i=1; $i<=$totalTasks; $i++)
                                        <option value="{{ $i }}" {{ $i == $task->priority ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="current_priority" value="{{ $task->priority }}">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url()->previous() }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
