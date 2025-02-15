<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/login", [LoginController::class, "showLoginForm"])->name("loginForm");
Route::post("/login", [LoginController::class, "login"])->name("login");
Route::get("/logout", [LoginController::class, "logout"])->name("logout");

// Route::get('/', [LoginController::class, "showLoginForm"]);

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'brands', 'as' => 'brand.', 'controller' => BrandController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{brand}/update', 'edit')->name('updateForm');
        Route::post('/{brand}/update', 'update')->name('update');
        Route::post('/{brand}/change-status', 'changeStatus')->name('changeStatus');
        Route::post('/{brand}/delete', 'delete')->name('delete');
    });
});
