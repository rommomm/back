<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::apiResource('posts', PostController::class);

Route::post('/register' ,[UserController::class, 'register']);
Route::post('/login' ,[UserController::class, 'login']);

Route::get('/posts' ,[PostController::class, 'index']);
Route::get('/posts/{id}' ,[PostController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts' ,[PostController::class, 'store']);
    Route::put('/posts/{id}' ,[PostController::class, 'update']);
    Route::delete('/posts/{id}' ,[PostController::class, 'destroy']);
    Route::post('/logout' ,[UserController::class, 'logout']);

});