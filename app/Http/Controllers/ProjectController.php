<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $project = new Project;

        return view('projects.create', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Project::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $project->name = $request->input('name');
        $project->save();

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->tasks()->delete(); // Delete all corresponding tasks first
        $project->delete(); // Then delete the project itself

        return redirect()->route('projects.index')->with('success', 'Project and its tasks have been deleted successfully.');
    }


}
