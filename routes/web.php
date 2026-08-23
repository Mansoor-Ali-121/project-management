<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectApplicationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. PUBLIC WEBSITE ROUTES (For Visitors)
// ==========================================
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/projects-list', [WebController::class, 'projects'])->name('public.projects');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');

// ==========================================
// 2. AUTHENTICATION ROUTES
// ==========================================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

// Registration Routes (Using UserController normal routes)
Route::get('/register', [UserController::class, 'index'])->name('register.add');
Route::post('/register', [UserController::class, 'store']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==========================================
// 3. NORMAL CRUD ROUTES (Without Resource Word)
// ==========================================

// --- Projects Routes ---
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.add');
Route::post('/projects', [ProjectController::class, 'store']);
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// --- Project Applications Routes ---
Route::get('/applications', [ProjectApplicationController::class, 'index'])->name('applications.index');
Route::get('/applications/create', [ProjectApplicationController::class, 'create'])->name('applications.create');
Route::post('/applications', [ProjectApplicationController::class, 'store'])->name('applications.store');
Route::get('/applications/{id}', [ProjectApplicationController::class, 'show'])->name('applications.show');
Route::get('/applications/{id}/edit', [ProjectApplicationController::class, 'edit'])->name('applications.edit');
Route::put('/applications/{id}', [ProjectApplicationController::class, 'update'])->name('applications.update');
Route::delete('/applications/{id}', [ProjectApplicationController::class, 'destroy'])->name('applications.destroy');

// --- Tasks Routes ---
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// --- Users Management Routes ---
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// --- Notifications Routes ---
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
Route::get('/notifications/{id}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
Route::put('/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

// --- Profile Route ---
Route::get('/profile', [UserController::class, 'profile'])->name('profile');