<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::post('/register' ,[AuthController::class, 'register']);
Route::post('/login' ,[AuthController::class, 'login']);
Route::get('/posts' ,[PostController::class, 'index']);
Route::get('users/{user:user_name}/posts', [UserController::class, 'index']);
Route::get('users/{user:user_name}', [UserController::class, 'show']);
Route::get('/posts/{id}' ,[PostController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts' ,[PostController::class, 'store']);
    Route::put('/posts/{post}' ,[PostController::class, 'update'])->middleware('can:update,post');
    Route::delete('/posts/{post}' ,[PostController::class, 'destroy'])->middleware('can:delete,post');
    Route::post('/logout' ,[AuthController::class, 'logout']);
    Route::get('/auth/me' ,[AuthController::class, 'show']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
