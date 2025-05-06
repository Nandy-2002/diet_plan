<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckPermissions;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\logsController;


Route::get('/', [PageController::class, 'index'])->name('landing');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/check-password', [UserController::class, 'checkPassword']);

// Admin and manage_user-only routes
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logs', [logsController::class, 'index'])->name('admin.logs');

    Route::middleware(CheckPermissions::class . ':manage_user')->group(function () {
        Route::get('/users', [UserController::class, 'showUsers'])->name('admin.users');
        Route::post('/users/add', [UserController::class, 'addUser'])->name('admin.users.add');
        Route::delete('/users/{user}/delete', [UserController::class, 'deleteUser'])->name('admin.users.delete');
        Route::get('/users/{user}/edit', [UserController::class, 'editUser'])->name('admin.users.edit');
        Route::post('/users/{user}/update', [UserController::class, 'updateUser'])->name('admin.users.update');
        Route::post('restore-user/{id}', [UserController::class, 'restoreUser'])->name('developer.user.restore');
        Route::delete('force-delete-user/{id}', [UserController::class, 'forceDeleteUser'])->name('developer.user.force-delete');
    });    

    // Routes for managing roles (requires manage_roles permission)
    Route::middleware(CheckPermissions::class . ':manage_roles')->group(function () {
        Route::get('/roles', [RoleController::class, 'showRoles'])->name('admin.roles');
        Route::post('/roles/add', [RoleController::class, 'addRole'])->name('admin.roles.add');
        Route::post('/roles/{id}/update', [RoleController::class, 'editUserRole'])->name('admin.updateUserRole');
    });

    Route::middleware(CheckPermissions::class . ':prdections')->group(function () {
        Route::get('/prdections', [PredictionController::class, 'index'])->name('admin.prdections');
        Route::match(['get', 'post'], '/prdections/data', [PredictionController::class, 'predict'])->name('admin.prdections.data');
        Route::get('/weeklypredict', [PredictionController::class, 'weeklypredict'])->name('admin.weeklypredict');
        Route::post('/feedback/submit', [PredictionController::class, 'submitFeedback'])->name('feedback.submit');
        Route::get('/collaboration', [PredictionController::class, 'showCollaborationView'])->name('admin.collaboration.view');
    });

    Route::middleware(CheckPermissions::class . ':prdections')->group(function () {
        Route::get('/collab', [PredictionController::class, 'collab'])->name('admin.collab');
    });

    Route::middleware(CheckPermissions::class . ':prdections')->group(function () {
        Route::get('/tracker', [PredictionController::class, 'tracker'])->name('admin.tracker');
        Route::put('/mealtracker/{meal}/update', [PredictionController::class, 'update'])->name('admin.mealtracker.update');
        Route::get('/mealtracker/weekly-stats', [PredictionController::class, 'weeklyStats'])->name('admin.mealtracker.weeklyStats');
        Route::get('/mealtracker/overall-stats', [PredictionController::class, 'overallStats'])->name('admin.mealtracker.overallStats');
    });

});