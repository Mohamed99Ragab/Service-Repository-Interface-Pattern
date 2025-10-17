<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PostController;
use Illuminate\Support\Facades\Route;

  Route::get('/', function () {
        return view('welcome');
    });


Route::middleware(['detect.platform:web'])->group(function () {

    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

   Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

        Route::get('/user',[AuthController::class,'user']);
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/post/{id}', [PostController::class, 'getPost']);
    });

});