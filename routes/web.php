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
    $content = view('robots')->render();
    return response($content, 200)
        ->header('Content-Type', 'text/plain')
        ->header('X-Robots-Tag', 'index, follow');
});
Route::get('/institute-erp/{city}', [SeoLandingController::class, 'landing'])->name('seo.landing');
Route::get('/school-erp/{city}', [SeoLandingController::class, 'schoolLanding'])->name('seo.school.landing');
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

            // Timetable Management
            Route::get('timetables/my-schedule', [\App\Http\Controllers\TimetableController::class, 'mySchedule'])->name('timetables.my-schedule');
            Route::resource('timetables', \App\Http\Controllers\TimetableController::class)->only(['index', 'store', 'destroy']);

            // Profile
            Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

            // Image Gallery
            Route::resource('gallery', \App\Http\Controllers\GalleryMediaController::class)->only(['index', 'store', 'destroy']);

            // Discipline
            Route::resource('discipline', \App\Http\Controllers\DisciplineRecordController::class)->only(['index', 'store']);


            // Staff Group Chat
            Route::get('/chat/messages', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
            Route::post('/chat/messages', [\App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');

            // Class Chatroom (Staff/Admin)
            Route::get('/class-chat', [\App\Http\Controllers\ClassChatroomController::class, 'index'])->name('class-chat.index');
            Route::get('/class-chat/messages/{batch}', [\App\Http\Controllers\ClassChatroomController::class, 'fetchMessages'])->name('class-chat.messages');
            Route::post('/class-chat/messages/{batch}', [\App\Http\Controllers\ClassChatroomController::class, 'sendMessage'])->name('class-chat.send');

            // Transport Management (Staff/Admin)
            Route::prefix('transport')->name('transport.')->group(function () {
                Route::get('/dashboard', [\App\Http\Controllers\TransportController::class, 'dashboard'])->name('dashboard');
                
                // Vehicles
                Route::get('/vehicles', [\App\Http\Controllers\TransportController::class, 'vehicles'])->name('vehicles');
                Route::post('/vehicles', [\App\Http\Controllers\TransportController::class, 'storeVehicle'])->name('vehicles.store');
                Route::put('/vehicles/{vehicle}', [\App\Http\Controllers\TransportController::class, 'updateVehicle'])->name('vehicles.update');
                Route::delete('/vehicles/{vehicle}', [\App\Http\Controllers\TransportController::class, 'deleteVehicle'])->name('vehicles.delete');
                
                // Routes
                Route::get('/routes', [\App\Http\Controllers\TransportController::class, 'routes'])->name('routes');
                Route::post('/routes', [\App\Http\Controllers\TransportController::class, 'storeRoute'])->name('routes.store');
                Route::put('/routes/{route}', [\App\Http\Controllers\TransportController::class, 'updateRoute'])->name('routes.update');
                Route::delete('/routes/{route}', [\App\Http\Controllers\TransportController::class, 'deleteRoute'])->name('routes.delete');
                
                // Stops
                Route::get('/stops', [\App\Http\Controllers\TransportController::class, 'stops'])->name('stops');
                Route::post('/stops', [\App\Http\Controllers\TransportController::class, 'storeStop'])->name('stops.store');
                Route::put('/stops/{stop}', [\App\Http\Controllers\TransportController::class, 'updateStop'])->name('stops.update');
                Route::delete('/stops/{stop}', [\App\Http\Controllers\TransportController::class, 'deleteStop'])->name('stops.delete');
                
                // Drivers
                Route::get('/drivers', [\App\Http\Controllers\TransportController::class, 'drivers'])->name('drivers');
                Route::post('/drivers', [\App\Http\Controllers\TransportController::class, 'storeDriver'])->name('drivers.store');
                Route::put('/drivers/{driver}', [\App\Http\Controllers\TransportController::class, 'updateDriver'])->name('drivers.update');
                Route::delete('/drivers/{driver}', [\App\Http\Controllers\TransportController::class, 'deleteDriver'])->name('drivers.delete');
                
                // Student Allocations
                Route::get('/allocations', [\App\Http\Controllers\TransportController::class, 'allocations'])->name('allocations');
                Route::post('/allocations', [\App\Http\Controllers\TransportController::class, 'storeAllocation'])->name('allocations.store');
                Route::put('/allocations/{allocation}', [\App\Http\Controllers\TransportController::class, 'updateAllocation'])->name('allocations.update');
                Route::delete('/allocations/{allocation}', [\App\Http\Controllers\TransportController::class, 'deleteAllocation'])->name('allocations.delete');
                
                // Reports
                Route::get('/reports', [\App\Http\Controllers\TransportController::class, 'reports'])->name('reports');
            });

            // Staff biometric attendance (self mark in/out)
            Route::get('/staff-attendance/mark', [\App\Http\Controllers\StaffBiometricAttendanceController::class, 'index'])->name('staff-attendance.mark');
            Route::post('/staff-attendance/mark', [\App\Http\Controllers\StaffBiometricAttendanceController::class, 'mark'])->name('staff-attendance.mark.store');

            // Institute attendance location (admin only)
            Route::get('/institute/attendance-settings', [\App\Http\Controllers\InstituteAttendanceSettingController::class, 'edit'])
                ->name('institute.attendance-settings.edit')->middleware('can:manage-institute-settings');
            Route::put('/institute/attendance-settings', [\App\Http\Controllers\InstituteAttendanceSettingController::class, 'update'])
                ->name('institute.attendance-settings.update')->middleware('can:manage-institute-settings');

            // Staff attendance reports (admin only)
            Route::get('/staff-attendance', [\App\Http\Controllers\StaffAttendanceAdminController::class, 'index'])
                ->name('staff-attendance.admin')->middleware('can:manage-institute-settings');

            // Staff salary & payroll (admin only)
            Route::get('/staff-salaries', [\App\Http\Controllers\StaffSalaryController::class, 'index'])->name('staff-salaries.index')->middleware('can:manage-staff-payroll');
            Route::get('/staff-salaries/create', [\App\Http\Controllers\StaffSalaryController::class, 'create'])->name('staff-salaries.create')->middleware('can:manage-staff-payroll');
            Route::post('/staff-salaries', [\App\Http\Controllers\StaffSalaryController::class, 'store'])->name('staff-salaries.store')->middleware('can:manage-staff-payroll');
            Route::get('/staff-salaries/{staffSalary}/edit', [\App\Http\Controllers\StaffSalaryController::class, 'edit'])->name('staff-salaries.edit')->middleware('can:manage-staff-payroll');
            Route::put('/staff-salaries/{staffSalary}', [\App\Http\Controllers\StaffSalaryController::class, 'update'])->name('staff-salaries.update')->middleware('can:manage-staff-payroll');

            Route::get('/staff-payrolls', [\App\Http\Controllers\StaffPayrollController::class, 'index'])->name('staff-payrolls.index')->middleware('can:manage-staff-payroll');
            Route::post('/staff-payrolls/generate', [\App\Http\Controllers\StaffPayrollController::class, 'generate'])->name('staff-payrolls.generate')->middleware('can:manage-staff-payroll');
            Route::patch('/staff-payrolls/{staffPayroll}', [\App\Http\Controllers\StaffPayrollController::class, 'updateStatus'])->name('staff-payrolls.update')->middleware('can:manage-staff-payroll');

            // --- Library Management System (Admin) ---
            Route::prefix('library')->name('library.')->middleware('can:manage-library')->group(function () {
                Route::get('dashboard', [\App\Http\Controllers\Library\DashboardController::class, 'index'])->name('dashboard');
                
                // Books
                Route::post('books/bulk-delete', [\App\Http\Controllers\Library\BookController::class, 'bulkDelete'])->name('books.bulk-delete');
                Route::get('books/export/csv', [\App\Http\Controllers\Library\BookController::class, 'exportCsv'])->name('books.export.csv');
                Route::get('books/export/excel', [\App\Http\Controllers\Library\BookController::class, 'exportExcel'])->name('books.export.excel');
                Route::get('books/{book}/print-qr', [\App\Http\Controllers\Library\BookController::class, 'printQR'])->name('books.print-qr');
                Route::get('books/{book}/print-barcode', [\App\Http\Controllers\Library\BookController::class, 'printBarcode'])->name('books.print-barcode');
                Route::post('books/scan-search', [\App\Http\Controllers\Library\BookController::class, 'scanSearch'])->name('books.scan-search');
                Route::resource('books', \App\Http\Controllers\Library\BookController::class);
                
                // Masters
                Route::resource('categories', \App\Http\Controllers\Library\CategoryController::class)->except(['create', 'show', 'edit']);
                Route::resource('authors', \App\Http\Controllers\Library\AuthorController::class)->except(['create', 'show', 'edit']);
                Route::resource('publishers', \App\Http\Controllers\Library\PublisherController::class)->except(['create', 'show', 'edit']);
                
                // Issues & Returns
                Route::post('issues/scan-issue', [\App\Http\Controllers\Library\BookIssueController::class, 'scanIssue'])->name('issues.scan-issue');
                Route::resource('issues', \App\Http\Controllers\Library\BookIssueController::class)->only(['index', 'create', 'store', 'show']);
                
                Route::get('returns', [\App\Http\Controllers\Library\BookReturnController::class, 'index'])->name('returns.index');
                Route::post('returns/scan-return', [\App\Http\Controllers\Library\BookReturnController::class, 'scanReturn'])->name('returns.scan-return');
                Route::get('returns/{issue}', [\App\Http\Controllers\Library\BookReturnController::class, 'returnBook'])->name('returns.returnBook');
                Route::post('returns/{issue}', [\App\Http\Controllers\Library\BookReturnController::class, 'store'])->name('returns.store');
                
                // Fines
                Route::post('fines/{fine}/collect', [\App\Http\Controllers\Library\FineController::class, 'collectFine'])->name('fines.collect');
                Route::resource('fines', \App\Http\Controllers\Library\FineController::class)->only(['index', 'store']);
                
                // Reservations
                Route::post('reservations/{reservation}/cancel', [\App\Http\Controllers\Library\ReservationController::class, 'cancel'])->name('reservations.cancel');
                Route::post('reservations/{reservation}/fulfill', [\App\Http\Controllers\Library\ReservationController::class, 'fulfill'])->name('reservations.fulfill');
                Route::resource('reservations', \App\Http\Controllers\Library\ReservationController::class)->only(['index', 'store']);
                
                // Digital Library
                Route::get('digital-resources/{digitalResource}/download', [\App\Http\Controllers\Library\DigitalResourceController::class, 'download'])->name('digital-resources.download');
                Route::get('digital-resources/{digitalResource}/preview', [\App\Http\Controllers\Library\DigitalResourceController::class, 'preview'])->name('digital-resources.preview');
                Route::resource('digital-resources', \App\Http\Controllers\Library\DigitalResourceController::class);
                
                // Settings & Reports
                Route::get('settings', [\App\Http\Controllers\Library\SettingController::class, 'edit'])->name('settings.edit');
                Route::put('settings', [\App\Http\Controllers\Library\SettingController::class, 'update'])->name('settings.update');
                
                Route::get('reports', [\App\Http\Controllers\Library\ReportController::class, 'index'])->name('reports.index');
                Route::get('reports/{type}', [\App\Http\Controllers\Library\ReportController::class, 'generate'])->name('reports.generate');
                Route::get('reports/{type}/export/{format}', [\App\Http\Controllers\Library\ReportController::class, 'export'])->name('reports.export');
            });

            // --- Teacher Library Views ---
            Route::prefix('teacher/library')->name('teacher.library.')->group(function () {
                Route::get('/', [\App\Http\Controllers\TeacherLibraryController::class, 'index'])->name('index');
                Route::get('/my-books', [\App\Http\Controllers\TeacherLibraryController::class, 'myBooks'])->name('my-books');
                Route::get('/history', [\App\Http\Controllers\TeacherLibraryController::class, 'history'])->name('history');
                Route::post('/reserve/{book}', [\App\Http\Controllers\TeacherLibraryController::class, 'reserve'])->name('reserve');
                Route::get('/digital', [\App\Http\Controllers\TeacherLibraryController::class, 'digitalLibrary'])->name('digital');
            });
        }
    );
});

require __DIR__ . '/auth.php'; // assuming Laravel Breeze

// Student Portal Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/magic-checkout/{student}/{fee}', function (\App\Models\Student $student, \App\Models\StudentFee $fee) {
        if (!request()->hasValidSignature()) {
            abort(401, 'This checkout link has expired or is invalid.');
        }
        
        \Illuminate\Support\Facades\Auth::guard('student')->login($student);
        return redirect()->route('student.fees.index')->with('success', 'Securely logged in. You can now pay your fee.');
    })->name('magic_checkout');

    Route::middleware('guest:student')->group(
        function () {
            Route::get('login', [\App\Http\Controllers\Student\AuthController::class, 'showLoginForm'])->name('login');
            Route::post('login', [\App\Http\Controllers\Student\AuthController::class, 'login']);
        }
    );

    Route::middleware('auth:student')->group(
        function () {
            Route::get('dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

            // --- Student Library ---
            Route::prefix('library')->name('library.')->group(function () {
                Route::get('/', [\App\Http\Controllers\Student\LibraryController::class, 'index'])->name('index');
                Route::get('/my-books', [\App\Http\Controllers\Student\LibraryController::class, 'myBooks'])->name('my-books');
                Route::get('/history', [\App\Http\Controllers\Student\LibraryController::class, 'history'])->name('history');
                Route::get('/fines', [\App\Http\Controllers\Student\LibraryController::class, 'fines'])->name('fines');
                Route::post('/reserve/{book}', [\App\Http\Controllers\Student\LibraryController::class, 'reserve'])->name('reserve');
                Route::get('/digital', [\App\Http\Controllers\Student\LibraryController::class, 'digitalLibrary'])->name('digital');
                Route::get('/digital/{digitalResource}/download', [\App\Http\Controllers\Student\LibraryController::class, 'downloadResource'])->name('digital.download');
                Route::get('/digital/{digitalResource}/preview', [\App\Http\Controllers\Student\LibraryController::class, 'previewResource'])->name('digital.preview');
            });

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
            Route::get('logout', [\App\Http\Controllers\Student\AuthController::class, 'logout']);

            // Leave Management (Student)
            Route::post('leaves/{id}/revert', [\App\Http\Controllers\LeaveRequestController::class, 'revert'])->name('leaves.revert');
            Route::resource('leaves', \App\Http\Controllers\Student\LeaveController::class)->only(['index', 'create', 'store']);

            // Timetable
            Route::get('timetable', [\App\Http\Controllers\Student\TimetableController::class, 'index'])->name('timetable.index');

            // Tests, Homework, Attendance, Gallery, Discipline
            Route::get('attendance', [\App\Http\Controllers\Student\AttendanceController::class, 'index'])->name('attendance.index');
            Route::get('tests', [\App\Http\Controllers\Student\TestController::class, 'index'])->name('tests.index');
            Route::get('homework', [\App\Http\Controllers\Student\HomeworkController::class, 'index'])->name('homework.index');
            Route::get('gallery', [\App\Http\Controllers\Student\GalleryController::class, 'index'])->name('gallery.index');
            Route::get('discipline', [\App\Http\Controllers\Student\DisciplineController::class, 'index'])->name('discipline.index');

            // Notifications
            Route::get('notifications', [\App\Http\Controllers\Student\DashboardController::class, 'notifications'])->name('notifications.index');

            // Profile
            Route::get('profile', [\App\Http\Controllers\Student\ProfileController::class, 'edit'])->name('profile.edit');
            Route::post('profile', [\App\Http\Controllers\Student\ProfileController::class, 'update'])->name('profile.update');

            // Student Class Chatroom
            Route::get('class-chat', [\App\Http\Controllers\Student\StudentClassChatController::class, 'index'])->name('class-chat.index');
            Route::get('class-chat/messages', [\App\Http\Controllers\Student\StudentClassChatController::class, 'fetchMessages'])->name('class-chat.messages');
            Route::post('class-chat/messages', [\App\Http\Controllers\Student\StudentClassChatController::class, 'sendMessage'])->name('class-chat.send');

            // Student Transport
            Route::get('transport', [\App\Http\Controllers\Student\StudentTransportController::class, 'index'])->name('transport.index');
        }
    );
});

// Webhook routes for payment gateways (bypassing CSRF in bootstrap/app.php)
use App\Http\Controllers\WebhookController;
Route::post('webhooks/stripe', [WebhookController::class, 'handleStripe'])->name('webhooks.stripe');
Route::post('webhooks/razorpay', [WebhookController::class, 'handleRazorpay'])->name('webhooks.razorpay');
