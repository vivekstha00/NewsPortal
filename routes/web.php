<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;


// PUBLIC HOMEPAGE
Route::get('/', function () {
    return view('index');
})->name('home');


// USER AUTH (REGISTER + LOGIN if needed)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// ADMIN LOGIN
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


// ADMIN PAGES (PROTECTED)
Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.pages.admin-dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/manage-news', function () {
        return view('admin.pages.manage-news', ['news' => collect()]);
    })->name('admin.manage-news');

    Route::get('/admin/manage-user', function () {
        return view('admin.pages.manage-user', ['users' => collect()]);
    })->name('admin.manage-user');
});
