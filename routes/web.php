<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagerController;



Route::get('/', function () {
    return view('index');
});
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/manager', [AdminController::class, 'manager'])->name('admin.manager');

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/manager', [AdminController::class, 'manager'])->name('admin.manager');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login.show'); // To show the login form
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login'); // To handle login submission
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); // To handle logout
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.updateProfile');

Route::prefix('manager')->middleware(['auth', 'role:owner'])->group(function() {
    Route::get('/', [ManagerController::class, 'index'])->name('manager.index');
    Route::post('/create-user', [ManagerController::class, 'createUser'])->name('manager.createUser');
    Route::post('/update-role/{userId}', [ManagerController::class, 'updateUserRole'])->name('manager.updateRole');
    Route::post('/delete-user/{userId}', [ManagerController::class, 'deleteUser'])->name('manager.deleteUser');
});


require __DIR__.'/auth.php';