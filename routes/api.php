<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::post('/register' ,[AuthController::class, 'register']);
Route::post('/login' ,[AuthController::class, 'login']);
Route::get('/posts' ,[PostController::class, 'index']);
Route::get('users/{user:user_name}/posts', [UserController::class, 'getUserPosts']);
Route::get('users/{user:user_name}', [AuthController::class, 'AuthMe']);
Route::get('/users', [UserController::class, 'allUser']);
Route::get('/posts/{id}' ,[PostController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts' ,[PostController::class, 'store']);
    Route::put('/posts/{id}' ,[PostController::class, 'update']);
    Route::delete('/posts/{id}' ,[PostController::class, 'destroy']);
    Route::post('/logout' ,[AuthController::class, 'logout']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
