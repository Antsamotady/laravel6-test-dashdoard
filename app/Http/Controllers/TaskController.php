<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        $task->priority = Task::count() + 1; // Set priority to the lowest available
        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Task::create([
            'name' => $request->input('name'),
            'priority' => Task::count() + 1,
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // Get the old priority of the task
        $oldPriority = $task->priority;

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'priority' => 'required|integer|min:1'
        ]);

        // Get the new priority from the request
        $newPriority = $validatedData['priority'];

        // Get the total number of tasks
        $totalTasks = Task::count();

        // Make sure the new priority is within the valid range
        $newPriority = max(1, min($newPriority, $totalTasks));

        // If the new priority is different from the old priority, update the priority of all tasks accordingly
        if ($newPriority != $oldPriority) {
            if ($newPriority > $oldPriority) {
                Task::where('priority', '>', $oldPriority)
                    ->where('priority', '<=', $newPriority)
                    ->decrement('priority');
            } else {
                Task::where('priority', '>=', $newPriority)
                    ->where('priority', '<', $oldPriority)
                    ->increment('priority');
            }
        }

        // Update the task with the new data
        $task->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $priority = $task->priority;
        $task->delete();

        // Shift all tasks with priority > $priority down by 1
        Task::where('priority', '>', $priority)->update(['priority' => DB::raw('priority - 1')]);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
