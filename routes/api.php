<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Projects API Routes
// Yeh automatically index, store, show, update, aur destroy ke routes bana dega
// Routes/api.php ke andar
Route::apiResource('projects', ProjectController::class)->names('api.projects');

// User  controller ke liye bhi same cheez kar sakte hain
Route::apiResource('users', UserController::class)->names('api.users');

// Application / Volunteer API Routes
Route::apiResource('applications', ApplicationController::class)->names('api.applications');

// Tasks API Routes
Route::apiResource('tasks', TaskApiController::class)->names('api.tasks');