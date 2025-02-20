<?php

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\RegistrationApiController;
use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginApiController::class, 'login']);
Route::post('register', [RegistrationApiController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tasks', TaskApiController::class);

    Route::get('logout', [LoginApiController::class, 'logout']);
});
