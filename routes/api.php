<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Projects API Routes
// Yeh automatically index, store, show, update, aur destroy ke routes bana dega
Route::apiResource('projects', ProjectController::class);

// User  controller ke liye bhi same cheez kar sakte hain
Route::apiResource('users', UserController::class);