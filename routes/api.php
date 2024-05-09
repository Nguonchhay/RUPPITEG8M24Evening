<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [App\Http\Controllers\Api\LoginAPIController::class, 'login']);

Route::get('/categories', [App\Http\Controllers\Api\CategoryAPIController::class, 'index']);
Route::post('/categories', [App\Http\Controllers\Api\CategoryAPIController::class, 'store'])->middleware('auth:sanctum')->middleware(\App\Http\Middleware\AdminMiddleware::class);;
Route::put('/categories/{category}/update', [App\Http\Controllers\Api\CategoryAPIController::class, 'update']);
Route::delete('/categories/{category}/delete', [App\Http\Controllers\Api\CategoryAPIController::class, 'destroy']);
