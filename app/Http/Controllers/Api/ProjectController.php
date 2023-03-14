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
            "projects" => $projects
        ]);
    }
}
