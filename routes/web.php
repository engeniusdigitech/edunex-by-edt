<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SuperAdmin\InstituteController;
use App\Http\Controllers\SuperAdmin\PlanController;

// Register middleware aliases directly to bypass bootstrap/app.php reset issues
Route::aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
Route::aliasMiddleware('tenant', \App\Http\Middleware\IdentifyTenant::class);
Route::aliasMiddleware('subscription', \App\Http\Middleware\CheckSubscription::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pricing', function () {
    $plans = \App\Models\Plan::where('is_active', 1)->get();
    return view('pricing', compact('plans'));
})->name('pricing');

Route::get('/trial-request', function () {
    $planName = request('plan', 'Basic Plan');
    return view('trial_request', compact('planName'));
})->name('trial.request');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware(['auth'])->group(function () {

    // Super Admin Routes
    Route::middleware(['role:Super Admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
            Route::get('/dashboard', [InstituteController::class , 'dashboard'])->name('dashboard');
            Route::resource('institutes', InstituteController::class);
            Route::resource('plans', PlanController::class);
        }
        );

        // Institute Admin / Staff Routes (protected by tenant & subscription middlewares)
        Route::middleware(['tenant', 'subscription'])->group(function () {
            Route::get('/dashboard', [DashboardController::class , 'index'])->name('dashboard');

            Route::resource('students', StudentController::class)->middleware('can:manage-students');
            Route::resource('staff', \App\Http\Controllers\StaffController::class)->middleware('can:manage-staff');

            Route::get('/attendance', [AttendanceController::class , 'index'])->name('attendance.index')->middleware('can:manage-attendance');
            Route::post('/attendance', [AttendanceController::class , 'store'])->name('attendance.store')->middleware('can:manage-attendance');

            Route::resource('payments', PaymentController::class)->middleware('can:manage-payments');

            // Academics Module
            Route::resource('homework', \App\Http\Controllers\HomeworkController::class);
            Route::resource('tests', \App\Http\Controllers\TestController::class);
            Route::get('tests/{test}/marks', [\App\Http\Controllers\TestController::class , 'marks'])->name('tests.marks');
            Route::post('tests/{test}/marks', [\App\Http\Controllers\TestController::class , 'storeMarks'])->name('tests.store_marks');

            // Advanced Analytics / Reports
            Route::prefix('reports')->name('reports.')->group(function () {
                    Route::get('/attendance', [\App\Http\Controllers\ReportController::class , 'attendance'])->name('attendance');
                    Route::get('/attendance/pdf', [\App\Http\Controllers\ReportController::class , 'exportAttendancePdf'])->name('attendance.pdf');

                    Route::get('/defaulters', [\App\Http\Controllers\ReportController::class , 'defaulters'])->name('defaulters');
                    Route::get('/defaulters/pdf', [\App\Http\Controllers\ReportController::class , 'exportDefaultersPdf'])->name('defaulters.pdf');

                    Route::post('/defaulters/notify/{student}', [\App\Http\Controllers\NotificationController::class , 'sendPortalAlert'])->name('notify');
                }
                );
            }
            );        });

require __DIR__ . '/auth.php'; // assuming Laravel Breeze

// Student Portal Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest:student')->group(function () {
            Route::get('login', [\App\Http\Controllers\Student\AuthController::class , 'showLoginForm'])->name('login');
            Route::post('login', [\App\Http\Controllers\Student\AuthController::class , 'login']);
        }
        );

        Route::middleware('auth:student')->group(function () {
            Route::get('dashboard', [\App\Http\Controllers\Student\DashboardController::class , 'index'])->name('dashboard');
            Route::post('notifications/{id}/read', [\App\Http\Controllers\Student\DashboardController::class , 'markAsRead'])->name('notifications.read');
            Route::post('logout', [\App\Http\Controllers\Student\AuthController::class , 'logout'])->name('logout');
        }
        );
    });
