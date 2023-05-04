<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
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
        $task->priority = Task::count() + 1;
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
            'name' => 'required|string|max:100',
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
        $totalTasks = Task::count();
        return view('tasks.edit', compact('task', 'totalTasks'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'priority' => 'required|integer|min:1'
        ]);

        $this->rearrangePriority($validatedData, $task);
        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function updateAjax(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'priority' => 'required|integer|min:1',
        ]);

        $this->rearrangePriority($validatedData, $task);
        $task->update($validatedData);

        return response()->json(['success' => true]);
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

        Task::where('priority', '>', $priority)->update(['priority' => DB::raw('priority - 1')]);

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    private function rearrangePriority($validatedData, $task) {
        $oldPriority = $task->priority;
        $newPriority = $validatedData['priority'];
        $totalTasks = Task::count();
        $newPriority = max(1, min($newPriority, $totalTasks));

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
    }

}
