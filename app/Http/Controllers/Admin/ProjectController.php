<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// MODELS
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

// managemente emails
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

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
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.create", compact("types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();

        $slug = Project::genSlug($request->title);

        $form_data['slug'] = $slug;

        if ($request->has('cover_image')) {
            $path = Storage::disk('public')->put('post_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }
        $newProject = Project::create($form_data);

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($form_data['technologies']);
        }

        // emails
        $newLead = new Lead();
        $newLead->fill($form_data);
        $newLead->save();
        Mail::to('info@boolpress.com')->send(new NewContact($newLead));

        return redirect()->route("admin.projects.index");
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
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.edit", compact("project", "types", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $slug = Project::genSlug($request->title);
        $form_data["slug"] = $slug;

        if ($request->has('cover_image')) {
            //checking if there's an image already
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $path = Storage::disk('public')->put('project_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }

        if ($request->has('cover_image')) {
            $path = Storage::disk('public')->put('post_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }

        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($form_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route("admin.projects.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("admin.projects.index");
    }
}
