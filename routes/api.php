<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index']);
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store']);
    Route::post('/post_images', [\App\Http\Controllers\PostImageController::class, 'store']);
    // Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show']);
    // Route::put('/posts/{post}', [App\Http\Controllers\PostController::class, 'update']);
    // Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy']);
});
