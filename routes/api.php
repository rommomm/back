<?php
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'getAll']);
Route::get('posts/{post}', [PostController::class, 'getById']);
Route::post('posts', [PostController::class, 'save']);
Route::put('posts/{id}', [PostController::class, 'update']);
Route::delete('posts/{id}', [PostController::class, 'delete']);

// Route::apiResource('posts', PostController::class)->only(['index']);

