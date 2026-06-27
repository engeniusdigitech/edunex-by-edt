<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('/login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);

    Route::middleware(['auth:sanctum', 'tenant'])->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout']);
        Route::get('/profile', [\App\Http\Controllers\Api\V1\Student\ProfileController::class, 'show']);

        // Fee Routes
        Route::get('/fees', [\App\Http\Controllers\Api\V1\Student\FeeController::class, 'index']);
        Route::get('/fees/{fee}', [\App\Http\Controllers\Api\V1\Student\FeeController::class, 'show']);
        Route::post('/fees/{fee}/checkout-link', [\App\Http\Controllers\Api\V1\Student\FeeController::class, 'checkoutLink']);

        // Academic Routes
        Route::get('/lectures', [\App\Http\Controllers\Api\V1\Student\LectureController::class, 'index']);
        Route::get('/notifications', [\App\Http\Controllers\Api\V1\Student\NotificationController::class, 'index']);
        Route::get('/homework', [\App\Http\Controllers\Api\V1\Student\HomeworkController::class, 'index']);
        Route::get('/attendance', [\App\Http\Controllers\Api\V1\Student\AttendanceController::class, 'index']);
        Route::get('/discipline', [\App\Http\Controllers\Api\V1\Student\DisciplineController::class, 'index']);
        Route::get('/gallery', [\App\Http\Controllers\Api\V1\Student\GalleryController::class, 'index']);
        Route::get('/timetable', [\App\Http\Controllers\Api\V1\Student\TimetableController::class, 'index']);
        Route::get('/tests', [\App\Http\Controllers\Api\V1\Student\TestController::class, 'index']);
        
        Route::get('/leave-requests', [\App\Http\Controllers\Api\V1\Student\LeaveRequestController::class, 'index']);
        Route::post('/leave-requests', [\App\Http\Controllers\Api\V1\Student\LeaveRequestController::class, 'store']);
        Route::delete('/leave-requests/{leave}', [\App\Http\Controllers\Api\V1\Student\LeaveRequestController::class, 'withdraw']);

        // Library
        Route::get('/library', [\App\Http\Controllers\Api\V1\Student\LibraryController::class, 'index']);
        Route::get('/library/my-books', [\App\Http\Controllers\Api\V1\Student\LibraryController::class, 'myBooks']);
        Route::get('/library/history', [\App\Http\Controllers\Api\V1\Student\LibraryController::class, 'history']);
        Route::get('/library/fines', [\App\Http\Controllers\Api\V1\Student\LibraryController::class, 'fines']);
        Route::get('/library/digital', [\App\Http\Controllers\Api\V1\Student\LibraryController::class, 'digital']);

        // Study Materials
        Route::get('/study-materials', [\App\Http\Controllers\Api\V1\Student\StudyMaterialController::class, 'index']);

        // Profile
        Route::post('/profile/change-password', [\App\Http\Controllers\Api\V1\Student\ProfileController::class, 'changePassword']);

        // Class Chatroom API endpoints
        Route::get('/class-chat/batches', [\App\Http\Controllers\Api\V1\Chat\ClassChatApiController::class, 'batches']);
        Route::get('/class-chat/messages', [\App\Http\Controllers\Api\V1\Chat\ClassChatApiController::class, 'messages']);
        Route::post('/class-chat/messages', [\App\Http\Controllers\Api\V1\Chat\ClassChatApiController::class, 'sendMessage']);

        // Transport API endpoints
        Route::get('/student/transport', [\App\Http\Controllers\Api\V1\Transport\TransportApiController::class, 'studentTransport']);
    });
});
