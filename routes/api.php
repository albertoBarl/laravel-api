<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\Api\ProjectController as ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// API call for projects
// project list
Route::get("/projects", [ProjectController::class, "index"]);
// single project detail
Route::get("/projects/{slug}", [ProjectController::class, "show"]);
// contacts
// Route::post("/contacts", [::class, ""]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
