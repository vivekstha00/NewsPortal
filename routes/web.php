<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\User\DashboardController;

// PUBLIC HOMEPAGE
Route::get('/', function () {
    return view('index');
})->name('home');

// USER AUTH
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// LOGIN (for both admin & user)
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

// ADMIN ROUTES (Protected with admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.pages.admin-dashboard');
    })->name('admin.dashboard');

    // User Management
    Route::get('/manage-user', [UserController::class, 'index'])->name('admin.manage-user');
    Route::post('/manage-user', [UserController::class, 'store'])->name('admin.user.store');
    Route::put('/manage-user/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/manage-user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // News Management
    Route::get('/manage-news', [NewsController::class, 'index'])->name('admin.manage-news');
    Route::get('/manage-news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/manage-news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/manage-news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/manage-news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/manage-news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
});

// USER ROUTES (Protected with auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
