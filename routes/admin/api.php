<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('users', [App\Http\Controllers\API\UserController::class, 'store']);
    Route::post('login', [App\Http\Controllers\API\SessionController::class, 'store']);


    Route::middleware('auth:api')->group(function () {
        Route::delete('logout', [App\Http\Controllers\API\SessionController::class, 'destroy']);
    });
});
