<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json([
            "success" => true,
            "results" => $projects
        ]);
    }
    public function show($slug)
    {
        $project = Project::with("types", "technologies")->where("slug", $slug)->first();
        if ($project) {
            return response()->json([
                "success" => true,
                "project" => $project
            ]);
        } else {
            return response()->json([
                "success" => false,
                "error" => "No such project finded"

            ]);
        }
    }
}
