<?php

use Illuminate\Support\Facades\Route;

// Public landing page
Route::get('/', function () {
    return view('index');
})->name('home');

// ADMIN LOGIN
Route::get('/admin/login', function () {
    return view('admin.pages.login');
})->name('admin.login');

Route::post('/admin/login', function () {
    // handle login
})->name('admin.login.submit');

// ADMIN DASHBOARD
Route::get('/admin/dashboard', function () {
    return view('admin.pages.admin-dashboard');
})->name('admin.dashboard');

// Logout
Route::post('/admin/logout', function () {
    // logout logic
})->name('admin.logout');
