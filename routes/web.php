<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Student\FeePaymentController;
use App\Http\Controllers\SuperAdmin\InstituteController;
use App\Http\Controllers\SuperAdmin\PlanController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\SeoLandingController;
use App\Http\Controllers\ContactController;

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
    $planName = request('plan', 'EduNex Platform');
    return view('trial_request', compact('planName'));
})->name('trial.request');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/blogs', function () {
    return view('blogs');
})->name('blogs');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Legal Pages
Route::get('/privacy-policy', function () {
    return view('legal.privacy');
})->name('legal.privacy');

Route::get('/terms-and-conditions', function () {
    return view('legal.terms');
})->name('legal.terms');

Route::get('/refund-policy', function () {
    return view('legal.refund');
})->name('legal.refund');

// SEO Landing Pages, Sitemap & Robots
Route::get('/robots.txt', function () {
    return response()->view('robots')->header('Content-Type', 'text/plain');
});
Route::get('/institute-management-software-in-{city}', [SeoLandingController::class, 'landing'])->name('seo.landing');
Route::get('/sitemap.xml', [SeoLandingController::class, 'sitemap'])->name('sitemap');

Route::middleware(['auth'])->group(function () {

    // Super Admin Routes
    Route::middleware(['role:Super Admin'])->prefix('superadmin')->name('superadmin.')->group(
        function () {
            Route::get('/dashboard', [InstituteController::class, 'dashboard'])->name('dashboard');
            Route::resource('institutes', InstituteController::class);
        }
    );

    // Subscription Expired Route
    Route::get(
        '/subscription-expired',
        function () {
            return view('subscription.expired');
        }
    )->name('subscription.expired');

    // Institute Admin / Staff Routes (protected by tenant & subscription middlewares)
    Route::middleware(['tenant', 'subscription'])->group(
        function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::resource('principals', \App\Http\Controllers\PrincipalController::class)->middleware('can:manage-principals');
            Route::resource('students', StudentController::class)->middleware('can:manage-students');
            Route::resource('staff', \App\Http\Controllers\StaffController::class)->middleware('can:manage-staff');

            Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index')->middleware('can:manage-attendance');
            Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store')->middleware('can:manage-attendance');

            Route::resource('payments', PaymentController::class)->middleware('can:manage-payments');
            Route::get('/payments/{payment}/receipt', [PaymentController::class, 'receipt'])->name('payments.receipt')->middleware('can:manage-payments');
            Route::resource('fee-categories', FeeCategoryController::class)->middleware('can:manage-payments');
            Route::resource('fee-structures', FeeStructureController::class)->middleware('can:manage-payments');
            Route::get('/fee-allocations/create', [\App\Http\Controllers\FeeAllocationController::class, 'create'])->name('fee-allocations.create')->middleware('can:manage-payments');
            Route::post('/fee-allocations', [\App\Http\Controllers\FeeAllocationController::class, 'store'])->name('fee-allocations.store')->middleware('can:manage-payments');

            Route::get('/payment-gateways/settings', [PaymentGatewayController::class, 'settings'])->name('payment-gateways.settings')->middleware('can:manage-payments');
            Route::put('/payment-gateways/settings', [PaymentGatewayController::class, 'updateSettings'])->name('payment-gateways.update')->middleware('can:manage-payments');

            // Academics Module
            Route::resource('batches', \App\Http\Controllers\BatchController::class)->except(['create', 'edit', 'show'])->middleware('can:manage-batches');
            Route::resource('subjects', \App\Http\Controllers\SubjectController::class)->except(['create', 'edit', 'show'])->middleware('can:manage-academics');
            Route::resource('homework', \App\Http\Controllers\HomeworkController::class)->middleware('can:manage-academics');
            Route::resource('tests', \App\Http\Controllers\TestController::class)->middleware('can:manage-academics');
            Route::resource('live-lectures', \App\Http\Controllers\LiveLectureController::class)->middleware('can:manage-academics');
            Route::post('live-lectures/{liveLecture}/start', [\App\Http\Controllers\LiveLectureController::class, 'start'])->name('live-lectures.start')->middleware('can:manage-academics');
            Route::post('live-lectures/{liveLecture}/end', [\App\Http\Controllers\LiveLectureController::class, 'end'])->name('live-lectures.end')->middleware('can:manage-academics');
            Route::get('tests/{test}/marks', [\App\Http\Controllers\TestController::class, 'marks'])->name('tests.marks')->middleware('can:manage-academics');
            Route::post('tests/{test}/marks', [\App\Http\Controllers\TestController::class, 'storeMarks'])->name('tests.store_marks')->middleware('can:manage-academics');

            // Notifications
            Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
            Route::post('/notifications/send', [\App\Http\Controllers\NotificationController::class, 'send'])->name('notifications.send');

            // Advanced Analytics / Reports
            Route::prefix('reports')->name('reports.')->group(
                function () {
                Route::get('/attendance', [\App\Http\Controllers\ReportController::class, 'attendance'])->name('attendance')->middleware('can:manage-attendance');
                Route::get('/attendance/pdf', [\App\Http\Controllers\ReportController::class, 'exportAttendancePdf'])->name('attendance.pdf')->middleware('can:manage-attendance');

                Route::get('/defaulters', [\App\Http\Controllers\ReportController::class, 'defaulters'])->name('defaulters')->middleware('can:manage-payments');
                Route::get('/defaulters/pdf', [\App\Http\Controllers\ReportController::class, 'exportDefaultersPdf'])->name('defaulters.pdf')->middleware('can:manage-payments');

                Route::post('/defaulters/notify/{student}', [\App\Http\Controllers\NotificationController::class, 'sendPortalAlert'])->name('notify')->middleware('can:manage-payments');

                Route::get('/students/{student}', [\App\Http\Controllers\ReportController::class, 'studentReport'])->name('student')->middleware('can:manage-academics');
                Route::get('/students/{student}/pdf', [\App\Http\Controllers\ReportController::class, 'exportStudentReportPdf'])->name('student.pdf')->middleware('can:manage-academics');
                Route::get('/erp-guide/pdf', [\App\Http\Controllers\ReportController::class, 'exportErpGuidePdf'])->name('erp-guide.pdf');
            }
            );
            // Leave Management (Staff)
            Route::get('leaves/students', [\App\Http\Controllers\LeaveRequestController::class, 'studentLeaves'])->name('leaves.students');
            Route::post('leaves/{id}/revert', [\App\Http\Controllers\LeaveRequestController::class, 'revert'])->name('leaves.revert');
            Route::resource('leaves', \App\Http\Controllers\LeaveRequestController::class)->only(['index', 'create', 'store', 'update']);
        }
    );
});

require __DIR__ . '/auth.php'; // assuming Laravel Breeze

// Student Portal Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest:student')->group(
        function () {
            Route::get('login', [\App\Http\Controllers\Student\AuthController::class, 'showLoginForm'])->name('login');
            Route::post('login', [\App\Http\Controllers\Student\AuthController::class, 'login']);
        }
    );

    Route::middleware('auth:student')->group(
        function () {
            Route::get('dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

            // Student Fees
            Route::get('fees', [FeePaymentController::class, 'index'])->name('fees.index');
            Route::post('fees/{fee}/pay', [FeePaymentController::class, 'pay'])->name('fees.pay');
            Route::get('fees/stripe-success', [FeePaymentController::class, 'stripeSuccess'])->name('fees.stripe.success');
            Route::post('fees/razorpay-verify', [FeePaymentController::class, 'razorpayVerify'])->name('fees.razorpay.verify');
            Route::get('fees/cancel', [FeePaymentController::class, 'cancel'])->name('fees.cancel');
            Route::get('fees/receipt/{payment}', [FeePaymentController::class, 'receipt'])->name('fees.receipt');

            // Live Lectures
            Route::get('lectures', [\App\Http\Controllers\Student\LectureController::class, 'index'])->name('lectures.index');
            Route::get('lectures/{liveLecture}/join', [\App\Http\Controllers\Student\LectureController::class, 'join'])->name('lectures.join');
            Route::get('lectures/{liveLecture}/download', [\App\Http\Controllers\Student\LectureController::class, 'download'])->name('lectures.download');
            Route::post('notifications/{id}/read', [\App\Http\Controllers\Student\DashboardController::class, 'markAsRead'])->name('notifications.read');
            Route::post('logout', [\App\Http\Controllers\Student\AuthController::class, 'logout'])->name('logout');

            // Leave Management (Student)
            Route::post('leaves/{id}/revert', [\App\Http\Controllers\LeaveRequestController::class, 'revert'])->name('leaves.revert');
            Route::resource('leaves', \App\Http\Controllers\Student\LeaveController::class)->only(['index', 'create', 'store']);
        }
    );
});

// Webhook routes for payment gateways (bypassing CSRF in bootstrap/app.php)
use App\Http\Controllers\WebhookController;
Route::post('webhooks/stripe', [WebhookController::class, 'handleStripe'])->name('webhooks.stripe');
Route::post('webhooks/razorpay', [WebhookController::class, 'handleRazorpay'])->name('webhooks.razorpay');
