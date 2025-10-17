<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;







Route::prefix('mobile')->middleware(['detect.platform:mobile'])->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user',[AuthController::class,'user']);
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/post/{id}', [PostController::class, 'getPost']);
        });

});
