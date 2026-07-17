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

// ── Brand Search Routes ──────────────────────────────────────────────────
Route::get('/edunex', function () {
    return view('welcome');
})->name('brand.edunex');

Route::get('/edunex-erp', function () {
    return view('welcome');
})->name('brand.edunex-erp');

Route::get('/edunexerp', function () {
    return redirect()->route('brand.edunex-erp', [], 301);
})->name('brand.edunexerp');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pricing', function () {
    $plans = \App\Models\Plan::where('is_active', 1)->get();
    return view('pricing', compact('plans'));
})->name('pricing');


Route::get('/trial-request', function () {
    $planName = request('plan', 'EduNex ERP Platform');
    return view('trial_request', compact('planName'));
})->name('trial.request');

Route::get('/digital-assessment', function () {
    return view('digital-assessment');
})->name('digital.assessment.landing');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/blogs', function () {
    return view('blogs');
})->name('blogs');

Route::get('/login-hub', function () {
    if (auth()->guard('student')->check()) {
        return redirect()->route('student.dashboard');
    }
    if (auth()->check()) {
        if (auth()->user()->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        }
        return redirect()->to('/dashboard');
    }
    return view('login_hub');
})->name('login.hub');

Route::get('/portal', function () {
    return redirect()->route('login.hub');
});


Route::get('/digital-assessment-platform', function () {
    return view('digital-assessment');
})->name('digital.assessment');

Route::get('/features/visitor-management', function () {
    return view('features.visitor-management');
})->name('features.visitor-management');

Route::get('/features/tally-accounting', function () {
    return view('features.tally-accounting');
})->name('features.tally-accounting');

Route::get('/features/transit-tracking', function () {
    return view('features.transit-tracking');
})->name('features.transit-tracking');

Route::get('/features/statutory-payroll', function () {
    return view('features.statutory-payroll');
})->name('features.statutory-payroll');

Route::get('/features/inventory-management', function () {
    return view('features.inventory-management');
})->name('features.inventory-management');

Route::get('/features/hostel-management', function () {
    return view('features.hostel-management');
})->name('features.hostel-management');

Route::get('/features/library-management', function () {
    return view('features.library-management');
})->name('features.library-management');

Route::get('/features/accounting-tally', function () {
    return view('features.accounting-tally');
})->name('features.accounting-tally');

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

// Robots.txt
Route::get('/robots.txt', function () {
    $content = view('robots')->render();
    return response($content, 200)
        ->header('Content-Type', 'text/plain')
        ->header('X-Robots-Tag', 'index, follow');
});

// ═══════════════════════════════════════════════════════════════════════
// SEO Landing Pages — school-erp & institute-erp location hierarchy
//
// CANONICAL URL FORMAT:
//   /{prefix}/{country}                    → country page
//   /{prefix}/{country}/{state}            → state page
//   /{prefix}/{country}/{state}/{city}     → city page
//
// ORDER MATTERS: 3-segment routes registered before 2-segment and 1-segment.
// Legacy (old-format) routes issue 301 redirects to canonical URLs.
// ═══════════════════════════════════════════════════════════════════════

// ── Location Directory Hub Pages ─────────────────────────────────────
Route::get('/school-erp-locations',    [SeoLandingController::class, 'locations'])->name('seo.locations.school');
Route::get('/institute-erp-locations', [SeoLandingController::class, 'locations'])->name('seo.locations.institute');

// ── School ERP — Canonical Hierarchy ─────────────────────────────────
// 3-segment (most specific) must be registered first
Route::get('/school-erp/{country}/{state}/{city}', [SeoLandingController::class, 'schoolCity'])
    ->name('seo.school.city');

Route::get('/school-erp/{country}/{state}', [SeoLandingController::class, 'schoolState'])
    ->name('seo.school.state');

Route::get('/school-erp/{country}', [SeoLandingController::class, 'schoolCountry'])
    ->name('seo.school.country');

// ── Institute ERP — Canonical Hierarchy ──────────────────────────────
Route::get('/institute-erp/{country}/{state}/{city}', [SeoLandingController::class, 'instituteCity'])
    ->name('seo.institute.city');

Route::get('/institute-erp/{country}/{state}', [SeoLandingController::class, 'instituteState'])
    ->name('seo.institute.state');

Route::get('/institute-erp/{country}', [SeoLandingController::class, 'instituteCountry'])
    ->name('seo.institute.country');

// ── Sitemap ───────────────────────────────────────────────────────────
Route::get('/sitemap.xml', [SeoLandingController::class, 'sitemapIndex'])->name('sitemap');
Route::get('/sitemap-main.xml', [SeoLandingController::class, 'sitemapMain'])->name('sitemap.main');
Route::get('/sitemap-blog.xml', [SeoLandingController::class, 'sitemapBlog'])->name('sitemap.blog');
Route::get('/sitemap-home-country.xml', [SeoLandingController::class, 'sitemapCountry'])->name('sitemap.country');
Route::get('/sitemap-home-state.xml', [SeoLandingController::class, 'sitemapState'])->name('sitemap.state');
Route::get('/sitemap-home-city.xml', [SeoLandingController::class, 'sitemapCity'])->name('sitemap.city');



// Public Visitor Registration & Check-in status
Route::get('/visitors/register/{institute}', [\App\Http\Controllers\VisitorController::class, 'publicRegisterForm'])->name('visitors.public-register');
Route::post('/visitors/register/{institute}', [\App\Http\Controllers\VisitorController::class, 'publicRegisterStore'])->name('visitors.public-store');
Route::get('/visitors/register-status/{visitor}', [\App\Http\Controllers\VisitorController::class, 'publicRegisterStatus'])->name('visitors.public-status');
Route::get('/visitors/register-status/{visitor}/check', [\App\Http\Controllers\VisitorController::class, 'checkStatus'])->name('visitors.check-status');

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
            Route::post('students/import', [StudentController::class, 'import'])->name('students.import')->middleware('can:manage-students');
            Route::resource('students', StudentController::class)->middleware('can:manage-students');
            Route::post('staff/import', [\App\Http\Controllers\StaffController::class, 'import'])->name('staff.import')->middleware('can:manage-staff');
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
            Route::post('batches/import', [\App\Http\Controllers\BatchController::class, 'import'])->name('batches.import')->middleware('can:manage-batches');
            Route::resource('batches', \App\Http\Controllers\BatchController::class)->except(['create', 'edit', 'show'])->middleware('can:manage-batches');
            Route::post('subjects/import', [\App\Http\Controllers\SubjectController::class, 'import'])->name('subjects.import')->middleware('can:manage-academics');
            Route::resource('subjects', \App\Http\Controllers\SubjectController::class)->except(['create', 'edit', 'show'])->middleware('can:manage-academics');
            Route::resource('homework', \App\Http\Controllers\HomeworkController::class)->middleware('can:manage-academics');
            Route::resource('tests', \App\Http\Controllers\TestController::class)->middleware('can:manage-academics');
            Route::resource('live-lectures', \App\Http\Controllers\LiveLectureController::class)->middleware('can:manage-academics');
            Route::post('live-lectures/{liveLecture}/start', [\App\Http\Controllers\LiveLectureController::class, 'start'])->name('live-lectures.start')->middleware('can:manage-academics');
            Route::post('live-lectures/{liveLecture}/end', [\App\Http\Controllers\LiveLectureController::class, 'end'])->name('live-lectures.end')->middleware('can:manage-academics');
            Route::get('tests/{test}/marks', [\App\Http\Controllers\TestController::class, 'marks'])->name('tests.marks')->middleware('can:manage-academics');
            Route::post('tests/{test}/marks', [\App\Http\Controllers\TestController::class, 'storeMarks'])->name('tests.store_marks')->middleware('can:manage-academics');

            // Online Exam & Question Bank Module
            Route::resource('online-exams', \App\Http\Controllers\OnlineExamController::class)->middleware('can:manage-academics');
            Route::get('online-exams/{onlineExam}/questions', [\App\Http\Controllers\OnlineExamController::class, 'questions'])->name('online-exams.questions')->middleware('can:manage-academics');
            Route::post('online-exams/{onlineExam}/questions', [\App\Http\Controllers\OnlineExamController::class, 'addQuestion'])->name('online-exams.questions.store')->middleware('can:manage-academics');
            Route::delete('online-exams/{onlineExam}/questions/{question}', [\App\Http\Controllers\OnlineExamController::class, 'removeQuestion'])->name('online-exams.questions.destroy')->middleware('can:manage-academics');
            Route::post('online-exams/{onlineExam}/publish', [\App\Http\Controllers\OnlineExamController::class, 'publish'])->name('online-exams.publish')->middleware('can:manage-academics');
            Route::post('online-exams/{onlineExam}/close', [\App\Http\Controllers\OnlineExamController::class, 'close'])->name('online-exams.close')->middleware('can:manage-academics');
            Route::get('online-exams/{onlineExam}/results', [\App\Http\Controllers\OnlineExamController::class, 'results'])->name('online-exams.results')->middleware('can:manage-academics');
            Route::post('question-bank/import', [\App\Http\Controllers\QuestionBankController::class, 'import'])->name('question-bank.import')->middleware('can:manage-academics');
            Route::get('question-bank/download-template', [\App\Http\Controllers\QuestionBankController::class, 'downloadTemplate'])->name('question-bank.download-template')->middleware('can:manage-academics');
            Route::resource('question-bank', \App\Http\Controllers\QuestionBankController::class)->middleware('can:manage-academics');

            // Hostel Management Module
            Route::get('hostels/dashboard', [\App\Http\Controllers\HostelController::class, 'dashboard'])->name('hostels.dashboard')->middleware('can:manage-hostels');
            Route::resource('hostels', \App\Http\Controllers\HostelController::class)->middleware('can:manage-hostels');
            Route::post('hostels/{hostel}/rooms', [\App\Http\Controllers\HostelController::class, 'storeRoom'])->name('hostels.rooms.store')->middleware('can:manage-hostels');
            Route::delete('hostels/{hostel}/rooms/{room}', [\App\Http\Controllers\HostelController::class, 'destroyRoom'])->name('hostels.rooms.destroy')->middleware('can:manage-hostels');

            Route::resource('hostel-allocations', \App\Http\Controllers\HostelAllocationController::class)->middleware('can:manage-hostels');
            Route::post('hostel-allocations/{allocation}/checkout', [\App\Http\Controllers\HostelAllocationController::class, 'checkout'])->name('hostel-allocations.checkout')->middleware('can:manage-hostels');
            Route::post('hostel-allocations/bills/generate', [\App\Http\Controllers\HostelAllocationController::class, 'generateBills'])->name('hostel-allocations.bills.generate')->middleware('can:manage-hostels');
            Route::resource('hostel-bills', \App\Http\Controllers\HostelBillController::class)->only(['index', 'update'])->middleware('can:manage-hostels');

            Route::resource('hostel-messes', \App\Http\Controllers\HostelMessController::class)->middleware('can:manage-hostels');
            Route::post('hostel-messes/{mess}/menu', [\App\Http\Controllers\HostelMessController::class, 'updateMenu'])->name('hostel-messes.menu.update')->middleware('can:manage-hostels');
            Route::post('hostel-messes/{mess}/subscribe', [\App\Http\Controllers\HostelMessController::class, 'subscribeStudent'])->name('hostel-messes.subscribe')->middleware('can:manage-hostels');

            // Inventory & Store Management Module
            Route::get('inventory/dashboard', [\App\Http\Controllers\InventoryItemController::class, 'dashboard'])->name('inventory.dashboard')->middleware('can:manage-inventory');
            Route::post('inventory-items/import', [\App\Http\Controllers\InventoryItemController::class, 'import'])->name('inventory-items.import')->middleware('can:manage-inventory');
            Route::resource('inventory-items', \App\Http\Controllers\InventoryItemController::class)->middleware('can:manage-inventory');
            Route::resource('inventory-suppliers', \App\Http\Controllers\InventorySupplierController::class)->middleware('can:manage-inventory');
            Route::resource('purchase-orders', \App\Http\Controllers\PurchaseOrderController::class)->middleware('can:manage-inventory');
            Route::post('purchase-orders/{purchase_order}/items', [\App\Http\Controllers\PurchaseOrderController::class, 'storeItem'])->name('purchase-orders.items.store')->middleware('can:manage-inventory');
            Route::delete('purchase-orders/{purchase_order}/items/{item}', [\App\Http\Controllers\PurchaseOrderController::class, 'destroyItem'])->name('purchase-orders.items.destroy')->middleware('can:manage-inventory');
            Route::post('purchase-orders/{purchase_order}/status', [\App\Http\Controllers\PurchaseOrderController::class, 'updateStatus'])->name('purchase-orders.status.update')->middleware('can:manage-inventory');

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
                Route::post('/defaulters/whatsapp-bulk', [\App\Http\Controllers\ReportController::class, 'sendBulkWhatsAppReminders'])->name('defaulters.whatsapp-bulk')->middleware('can:manage-payments');

                Route::get('/students/{student}', [\App\Http\Controllers\ReportController::class, 'studentReport'])->name('student')->middleware('can:manage-academics');
                Route::get('/students/{student}/pdf', [\App\Http\Controllers\ReportController::class, 'exportStudentReportPdf'])->name('student.pdf')->middleware('can:manage-academics');
                Route::get('/erp-guide/pdf', [\App\Http\Controllers\ReportController::class, 'exportErpGuidePdf'])->name('erp-guide.pdf');

                Route::get('/lms', [\App\Http\Controllers\ReportController::class, 'lmsReport'])->name('lms')->middleware('can:manage-academics');
                Route::get('/exams', [\App\Http\Controllers\ReportController::class, 'examsReport'])->name('exams')->middleware('can:manage-academics');
            }
            );

            // WhatsApp Automation Center
            Route::get('/whatsapp-center', [\App\Http\Controllers\WhatsAppController::class, 'index'])->name('whatsapp.index');
            Route::post('/whatsapp-center/settings', [\App\Http\Controllers\WhatsAppController::class, 'saveSettings'])->name('whatsapp.settings');
            Route::post('/whatsapp-center/clear', [\App\Http\Controllers\WhatsAppController::class, 'clearLogs'])->name('whatsapp.clear');
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
            Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

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

                // Advanced Transport Tracking
                Route::get('/tracking', [\App\Http\Controllers\TransportTrackingController::class, 'index'])->name('tracking.index');
                Route::post('/trips', [\App\Http\Controllers\TransportTrackingController::class, 'startTrip'])->name('trips.start');
                Route::post('/trips/{trip}/location', [\App\Http\Controllers\TransportTrackingController::class, 'updateLocation'])->name('trips.location');
                Route::get('/trips/{trip}/status', [\App\Http\Controllers\TransportTrackingController::class, 'tripStatus'])->name('trips.status');
                Route::post('/trips/{trip}/board', [\App\Http\Controllers\TransportTrackingController::class, 'boardStudent'])->name('trips.board');
                Route::post('/trips/{trip}/complete', [\App\Http\Controllers\TransportTrackingController::class, 'completeTrip'])->name('trips.complete');
                Route::post('/routes/{route}/optimize', [\App\Http\Controllers\TransportTrackingController::class, 'optimizeRoute'])->name('routes.optimize');
            });

            // Accounting & Tally Integration
            Route::resource('expenses', \App\Http\Controllers\ExpenseController::class)->middleware('can:manage-payments');
            Route::prefix('accounting')->name('accounting.')->group(function () {
                Route::get('/dashboard', [\App\Http\Controllers\AccountingController::class, 'dashboard'])->name('dashboard');
                Route::get('/ledgers', [\App\Http\Controllers\AccountingController::class, 'ledgers'])->name('ledgers.index');
                Route::post('/ledgers', [\App\Http\Controllers\AccountingController::class, 'storeLedger'])->name('ledgers.store');
                Route::get('/gst-reports', [\App\Http\Controllers\AccountingController::class, 'gstReports'])->name('gst.reports');
                Route::get('/tally-export', [\App\Http\Controllers\AccountingController::class, 'tallyExport'])->name('tally.export');
                Route::get('/vouchers', [\App\Http\Controllers\AccountingController::class, 'vouchers'])->name('vouchers.index');
                Route::get('/vouchers/create', [\App\Http\Controllers\AccountingController::class, 'createVoucher'])->name('vouchers.create');
                Route::post('/vouchers', [\App\Http\Controllers\AccountingController::class, 'storeVoucher'])->name('vouchers.store');
            })->middleware('can:manage-payments');

            // Study Materials (LMS)
            Route::resource('study-materials', \App\Http\Controllers\StudyMaterialController::class)->only(['index', 'store', 'destroy']);
            Route::get('study-materials/{studyMaterial}/download', [\App\Http\Controllers\StudyMaterialController::class, 'download'])->name('study-materials.download');

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
            Route::get('/staff-payrolls/{staffPayroll}/payslip', [\App\Http\Controllers\StaffPayrollController::class, 'payslip'])->name('staff-payrolls.payslip')->middleware('can:manage-staff-payroll');

            // Visitor Gate Register (Admin, Principal, Receptionist)
            Route::resource('visitors', \App\Http\Controllers\VisitorController::class)->except(['destroy'])->middleware('can:manage-visitors');
            Route::post('/visitors/{visitor}/checkout', [\App\Http\Controllers\VisitorController::class, 'checkout'])->name('visitors.checkout')->middleware('can:manage-visitors');
            Route::get('/visitors/{visitor}/pass', [\App\Http\Controllers\VisitorController::class, 'pass'])->name('visitors.pass')->middleware('can:manage-visitors');
            Route::post('/visitors/{visitor}/approve', [\App\Http\Controllers\VisitorController::class, 'approve'])->name('visitors.approve')->middleware('can:manage-visitors');
            Route::post('/visitors/{visitor}/reject', [\App\Http\Controllers\VisitorController::class, 'reject'])->name('visitors.reject')->middleware('can:manage-visitors');

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

            // Student Study Materials (LMS)
            Route::get('study-materials', [\App\Http\Controllers\StudyMaterialController::class, 'studentIndex'])->name('study-materials.index');
            Route::get('study-materials/{studyMaterial}/download', [\App\Http\Controllers\StudyMaterialController::class, 'download'])->name('study-materials.download');

            // Timetable
            Route::get('timetable', [\App\Http\Controllers\Student\TimetableController::class, 'index'])->name('timetable.index');

            // Tests, Homework, Attendance, Gallery, Discipline
            Route::get('attendance', [\App\Http\Controllers\Student\AttendanceController::class, 'index'])->name('attendance.index');
            Route::get('tests', [\App\Http\Controllers\Student\TestController::class, 'index'])->name('tests.index');
            Route::get('online-exams', [\App\Http\Controllers\Student\OnlineExamController::class, 'index'])->name('online-exams.index');
            Route::post('online-exams/{onlineExam}/start', [\App\Http\Controllers\Student\OnlineExamController::class, 'start'])->name('online-exams.start');
            Route::get('online-exams/{onlineExam}/take', [\App\Http\Controllers\Student\OnlineExamController::class, 'take'])->name('online-exams.take');
            Route::post('online-exams/{onlineExam}/answer', [\App\Http\Controllers\Student\OnlineExamController::class, 'saveAnswer'])->name('online-exams.save-answer');
            Route::post('online-exams/{onlineExam}/track-tab', [\App\Http\Controllers\Student\OnlineExamController::class, 'trackTabSwitch'])->name('online-exams.track-tab');
            Route::post('online-exams/{onlineExam}/submit', [\App\Http\Controllers\Student\OnlineExamController::class, 'submit'])->name('online-exams.submit');
            Route::get('online-exams/{onlineExam}/result', [\App\Http\Controllers\Student\OnlineExamController::class, 'result'])->name('online-exams.result');
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
            Route::get('transport/tracking', [\App\Http\Controllers\Student\StudentTrackingController::class, 'tracking'])->name('transport.tracking');

            // Student Hostel Routes
            Route::get('hostel/my-room', [\App\Http\Controllers\Student\HostelController::class, 'myRoom'])->name('hostel.my-room');
            Route::get('hostel/mess-menu', [\App\Http\Controllers\Student\HostelController::class, 'messMenu'])->name('hostel.mess-menu');
            Route::get('hostel/bills', [\App\Http\Controllers\Student\HostelBillController::class, 'index'])->name('hostel.bills');
        }
    );
});

// Webhook routes for payment gateways (bypassing CSRF in bootstrap/app.php)
use App\Http\Controllers\WebhookController;
Route::post('webhooks/stripe', [WebhookController::class, 'handleStripe'])->name('webhooks.stripe');
Route::post('webhooks/razorpay', [WebhookController::class, 'handleRazorpay'])->name('webhooks.razorpay');
