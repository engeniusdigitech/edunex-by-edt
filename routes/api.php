<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('/login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout']);
        Route::get('/profile', [\App\Http\Controllers\Api\V1\Student\ProfileController::class, 'show']);

        // Fee Routes
        Route::get('/fees', [\App\Http\Controllers\Api\V1\Student\FeeController::class, 'index']);
        Route::get('/fees/{fee}', [\App\Http\Controllers\Api\V1\Student\FeeController::class, 'show']);

        // Academic Routes
        Route::get('/lectures', [\App\Http\Controllers\Api\V1\Student\LectureController::class, 'index']);
        Route::get('/notifications', [\App\Http\Controllers\Api\V1\Student\NotificationController::class, 'index']);
    });
});
