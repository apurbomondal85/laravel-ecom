<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\Auth\LoginController;
use App\Http\Controllers\Public\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/login", [LoginController::class, "showLoginForm"])->name("loginForm");
Route::post("/login", [LoginController::class, "login"])->name("login");
Route::get("/logout", [LoginController::class, "logout"])->name("logout");
Route::get("/register", [RegisterController::class, "showRegisterForm"])->name("registerForm");
Route::post("/register", [RegisterController::class, "create"])->name("register");

Route::get('/', [HomeController::class, 'index']);
