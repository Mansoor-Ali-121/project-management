<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpactReportController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectApplicationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. AUTHENTICATION ROUTES (Public - No Middleware)
// ==========================================
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [UserController::class, 'index'])->name('register.add');
Route::post('/register', [UserController::class, 'store']);


// ==========================================
// 2. PROTECTED / AUTHENTICATED ROUTES (Middleware Applied)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Root URL (Middleware ki wajah se yahan sirf login user hi aa sakega)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Impact Reports
    Route::get('/impact-reports', [ImpactReportController::class, 'index'])->name('impact.reports');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clear Cache Route
    Route::get('/admin/clear-cache', [DashboardController::class, 'clearCache'])->name('admin.clear-cache');

    // Profile Route
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

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
        Route::get('/add', [ProjectApplicationController::class, 'index'])->name('applications.add');
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
        Route::post('/add', [TaskController::class, 'store']);
        Route::patch('/{id}/update-status', [TaskController::class, 'updateStatus'])->name('updateStatus');
    });

    // --- Users Management Routes ---
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/show', [UserController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    });

    // --- Notifications Routes ---
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllRead'])->name('markAllRead');
        Route::get('/create', [NotificationController::class, 'create'])->name('create');
        Route::post('/', [NotificationController::class, 'store'])->name('store');
        Route::get('/{id}', [NotificationController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [NotificationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [NotificationController::class, 'update'])->name('update');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    });
});