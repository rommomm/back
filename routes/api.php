<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

Route::post('/register' ,[AuthController::class, 'register']);
Route::post('/login' ,[AuthController::class, 'login']);
Route::get('users/{author:user_name}', [UserController::class, 'show']);
Route::get('/posts' ,[PostController::class, 'index']);
Route::get('users/{user:user_name}/posts', [PostController::class, 'getAllByUser']);
Route::get('/posts/{post}' ,[PostController::class, 'show']);
Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
Route::get('/comments/{comment}', [CommentController::class, 'show']);
Route::get('/comments', [CommentController::class, 'getAll']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts' ,[PostController::class, 'store']);
    Route::put('/posts/{post}' ,[PostController::class, 'update'])->middleware('can:update,post');
    Route::delete('/posts/{post}' ,[PostController::class, 'destroy'])->middleware('can:delete,post');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware('can:update,comment');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('can:delete,comment');
    Route::post('/logout' ,[AuthController::class, 'logout']);
    Route::get('/auth/me' ,[ProfileController::class, 'show']);

});

