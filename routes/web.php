<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\Auth\LoginController;
use App\Http\Controllers\Public\Auth\RegisterController;
use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/login", [LoginController::class, "showLoginForm"])->name("loginForm");
Route::post("/login", [LoginController::class, "login"])->name("login");
Route::get("/register", [RegisterController::class, "showRegisterForm"])->name("registerForm");
Route::post("/register", [RegisterController::class, "create"])->name("register");
Route::get("/logout", [LoginController::class, "logout"])->name("logout");

Route::name('public.')->as('public.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'shops', 'as' => 'shop.', 'controller' => ShopController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{slug}', 'details')->name('details');
    });

    Route::group(['prefix' => 'carts', 'as' => 'cart.', 'controller' => CartController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add-to-cart', 'addToCart')->name('add_cart');
        Route::post('/{cart}/cart-delete', 'removeCart')->name('delete');
    });
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'verified']], function(){
    Route::get('/', [HomeController::class, 'dashboard'])->name("index");
});

require __DIR__ . '/admin.php';