<?php

namespace App\Http\Controllers;

use App\Task;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;

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
        return view('tasks.create');
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'priority' => 'required|integer',
        ]);

        if ($validatedData['priority'] != $request->input('current_priority')) {
            // priority has changed, so update other task priorities
            $tasks = Task::orderBy('priority')->get();
            foreach ($tasks as $t) {
                if ($t->id == $task->id) {
                    continue; // skip the current task being edited
                }
                if ($t->priority >= $validatedData['priority']) {
                    $t->priority += 1;
                    $t->save();
                }
            }
        }

        $task->name = $validatedData['name'];
        $task->priority = $validatedData['priority'];
        $task->save();

        return redirect()->route('tasks.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
