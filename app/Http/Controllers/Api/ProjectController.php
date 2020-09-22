<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProject;
use App\Http\Requests\DeleteProject;
use App\Http\Resources\ProjectResource;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();

        return ProjectResource::collection($projects);
    }

    public function store(CreateProject $request)
    {
        $project = Project::create([
            'project' => $request->project,
        ]);

        return new ProjectResource($project);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(DeleteProject $request, Project $project)
    {
        $project->delete();

        return new ProjectResource($project);
    }
}
