<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        if (!$projects->count()) {
            return view('projects.create');
        }

        $projectId = $request->input('project_id');
        $tasks = Task::query();

        if (!$tasks->count()) {
            return view('tasks.create', compact('projects'));
        }


        if ($request->has('completed')) {
            $tasks->where('is_completed', 1);
        }
        if ($projectId) {
            $tasks->where('project_id', $projectId);
        }
        $tasks = $tasks->orderBy('priority')->get();

        return view('tasks.index', compact('projects', 'tasks'));
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
        $projects = Project::all();
        return view('tasks.create', compact('task', 'projects'));
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
            'project_id' => 'required|exists:projects,id'
        ]);

        Task::create([
            'name' => $request->input('name'),
            'priority' => Task::count() + 1,
            'project_id' => $request->input('project_id')
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created succesfully!');
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

        return redirect('/?project_id=' . $task->project_id)->with('success', 'Task updated successfully.');
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

    public function updateProjectAjax($projectId, $idSequence)
    {
        $idSequenceArr = explode(",", $idSequence);
        $tasks = Task::where('project_id', $projectId)->orderBy('priority')->get();

        foreach($tasks as $key => $task) {
            Task::where('id', (int)$idSequenceArr[$key])->update(['priority' => $task->priority]);
        }
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

    public function toggle($id)
    {
        $task = Task::find($id);
        $task->is_completed = ($task->is_completed) ? 0 : 1;
        $task->save();

        return response()->json(['success' => true]);
    }

    public function showComplete(Request $request)
    {
        if($request->ajax()) {
            $output = "";

            $showCompleted = $request->input('completed');
            $tasks = Task::query();

            if ($showCompleted) {
                $tasks->where('is_completed', true);
                $output = "We have <strong>" . $tasks->count() . "</strong> finished tasks.";
            }

            $tasks = $tasks->get();
            $projects = Project::all();

        }
        return Response($output);
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
