<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view("admin.projects.index", compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();

        return view("admin.projects.create", compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // $data = $request->validated();

        $data = $request->validated();

        if (key_exists("thumb", $data)) {

            $path = Storage::put("projects", $data["thumb"]);
        }

        $project = Project::create([
            ...$data,
            "thumb" => $path ?? '',
        ]);

        if ($request->has("technologies")) {
            $project->technologies()->attach($data["technologies"]);
        }

        return redirect()->route("admin.projects.show", $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $technologies = Technology::all();

        return view("admin.projects.edit", compact("project", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data = $request->all();

        $data = $request->validate([
            "title" => "required|min:10|max:255",
            "description" => "required|string",
            "thumb" => "image|max:1024",
            "github_link" => "string|url",
            "technologies" => "nullable|array|exists:technologies,id"
        ]);

        if (key_exists("thumb", $data)) {

            $path = Storage::put("projects", $data["thumb"]);

            Storage::delete($project->thumb);
        }

        $project->update([
            ...$data,
            "thumb" => $path ?? $project->thumb
        ]);

        $project->technologies()->sync($data["technologies"]);

        return redirect()->route("admin.projects.show", compact("project"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->technologies()->detach();

        $project->delete();

        return redirect()->route("admin.projects.index");

    }
}
