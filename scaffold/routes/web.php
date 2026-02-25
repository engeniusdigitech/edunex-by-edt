<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SuperAdmin\InstituteController;
use App\Http\Controllers\SuperAdmin\PlanController;

Route::get('/', function () {
    return view('welcome');
});

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

            Route::resource('students', StudentController::class);

            Route::get('/attendance', [AttendanceController::class , 'index'])->name('attendance.index');
            Route::post('/attendance', [AttendanceController::class , 'store'])->name('attendance.store');

            Route::resource('payments', PaymentController::class);
        }
        );
    });

require __DIR__ . '/auth.php'; // assuming Laravel Breeze
