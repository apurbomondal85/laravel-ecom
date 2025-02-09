<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/admin/login", [LoginController::class, "showLoginForm"])->name("loginForm");
Route::post("/admin/login", [LoginController::class, "create"])->name("login");

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home.dashboard');
});
