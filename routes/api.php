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

        // Assignments
        Route::get('/assignments', [\App\Http\Controllers\Api\V1\Student\AssignmentController::class, 'index']);
        Route::post('/assignments/{assignment}/submit', [\App\Http\Controllers\Api\V1\Student\AssignmentController::class, 'submit']);

        // Examinations
        Route::get('/examinations', [\App\Http\Controllers\Api\V1\Student\ExaminationController::class, 'index']);

        // Hostel
        Route::get('/student/hostel', [\App\Http\Controllers\Api\V1\Student\HostelController::class, 'studentHostel']);

        // Downloads (report cards, certificates, documents)
        Route::get('/downloads', [\App\Http\Controllers\Api\V1\Student\DownloadController::class, 'index']);

        // Profile photo
        Route::post('/profile/photo', [\App\Http\Controllers\Api\V1\Student\ProfileController::class, 'updatePhoto']);

        // Parent routes
        Route::prefix('parent')->group(function () {
            Route::get('/children', [\App\Http\Controllers\Api\V1\Parent\ParentController::class, 'children']);
            Route::get('/children/{student}/profile', [\App\Http\Controllers\Api\V1\Parent\ParentController::class, 'childProfile']);
            Route::get('/children/{student}/attendance', [\App\Http\Controllers\Api\V1\Parent\ParentController::class, 'childAttendance']);
            Route::get('/children/{student}/fees', [\App\Http\Controllers\Api\V1\Parent\ParentController::class, 'childFees']);
            Route::get('/children/{student}/homework', [\App\Http\Controllers\Api\V1\Parent\ParentController::class, 'childHomework']);
        });

        // Staff routes
        Route::prefix('staff')->group(function () {
            Route::get('/profile', [\App\Http\Controllers\Api\V1\Staff\StaffProfileController::class, 'show']);
            Route::get('/dashboard', [\App\Http\Controllers\Api\V1\Staff\StaffDashboardController::class, 'index']);
            Route::get('/timetable', [\App\Http\Controllers\Api\V1\Staff\StaffTimetableController::class, 'index']);

            // Attendance
            Route::get('/attendance/students', [\App\Http\Controllers\Api\V1\Staff\AttendanceController::class, 'students']);
            Route::post('/attendance', [\App\Http\Controllers\Api\V1\Staff\AttendanceController::class, 'store']);

            // Leave approvals
            Route::get('/leave-approvals', [\App\Http\Controllers\Api\V1\Staff\LeaveApprovalController::class, 'index']);
            Route::post('/leave-approvals/{leave}/approve', [\App\Http\Controllers\Api\V1\Staff\LeaveApprovalController::class, 'approve']);
            Route::post('/leave-approvals/{leave}/reject', [\App\Http\Controllers\Api\V1\Staff\LeaveApprovalController::class, 'reject']);

            // Marks
            Route::get('/marks', [\App\Http\Controllers\Api\V1\Staff\MarksController::class, 'index']);
            Route::post('/marks', [\App\Http\Controllers\Api\V1\Staff\MarksController::class, 'store']);

            // Homework
            Route::get('/homework', [\App\Http\Controllers\Api\V1\Staff\HomeworkController::class, 'index']);
            Route::post('/homework', [\App\Http\Controllers\Api\V1\Staff\HomeworkController::class, 'store']);

            // Library
            Route::get('/library', [\App\Http\Controllers\Api\V1\Staff\LibraryController::class, 'index']);
            Route::post('/library/issue', [\App\Http\Controllers\Api\V1\Staff\LibraryController::class, 'issue']);
            Route::post('/library/return', [\App\Http\Controllers\Api\V1\Staff\LibraryController::class, 'returnBook']);

            // Visitors (Receptionist)
            Route::get('/visitors', [\App\Http\Controllers\Api\V1\Staff\VisitorController::class, 'index']);
            Route::post('/visitors', [\App\Http\Controllers\Api\V1\Staff\VisitorController::class, 'store']);

            // Hostel (Warden)
            Route::get('/hostel/overview', [\App\Http\Controllers\Api\V1\Staff\HostelController::class, 'overview']);
            Route::get('/hostel/leaves', [\App\Http\Controllers\Api\V1\Staff\HostelController::class, 'leaves']);

            // Announcements
            Route::get('/announcements', [\App\Http\Controllers\Api\V1\Staff\AnnouncementController::class, 'index']);
            Route::post('/announcements', [\App\Http\Controllers\Api\V1\Staff\AnnouncementController::class, 'store']);
        });
    });

    // Forgot password (public)
    Route::post('/forgot-password', [\App\Http\Controllers\Api\V1\Auth\ForgotPasswordController::class, 'send']);
});
