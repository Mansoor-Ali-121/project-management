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
Route::prefix('projects')->group(function () {
    Route::get('/add', [ProjectController::class, 'index'])->name('projects.add');
    Route::post('/add', [ProjectController::class, 'store']);
    Route::get('/show', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');
});

// --- Project Applications Routes ---
Route::prefix('applications')->group(function () {
    Route::get('/add', [ProjectApplicationController::class, 'index'])->name('applications.add'); // <-- 'add' se 'index' kar diya
    Route::post('/add', [ProjectApplicationController::class, 'store']);
    Route::get('/show', [ProjectApplicationController::class, 'show'])->name('applications.show');
    Route::get('/edit/{id}', [ProjectApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/update/{id}', [ProjectApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/delete/{id}', [ProjectApplicationController::class, 'destroy'])->name('applications.delete');

    Route::get('/active-volunteers', [ProjectApplicationController::class, 'activeVolunteers'])->name('applications.active');
});

// --- Tasks Routes ---
Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/show', [TaskController::class, 'show'])->name('show');
    Route::get('/add', [TaskController::class, 'index'])->name('add');
    Route::post('/store', [TaskController::class, 'store'])->name('add');
});
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
