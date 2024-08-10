<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubscriptionController;

Route::get('/about', function () {
    return view('welcome');
});
Route::get('/breeze', function () {
    return view('dashboard');
});

Route::resource('/', HomeController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   
     // Instructor routes
     Route::middleware(['auth', 'role:student'])->group(function () {
        Route::get('/student/dashboard', [HomeController::class, 'studentDashboard'])->name('student.dashboard');
        Route::get('/student/courses', [CourseController::class, 'studentCourses'])->name('student.courses');
        Route::get('/student/progress', [ProgressController::class, 'index'])->name('student.progress');
        Route::get('/student/certificates', [CertificateController::class, 'index'])->name('student.certificates');
        // Autres routes pour les étudiants...
    });

    Route::middleware(['auth', 'role:instructor'])->group(function () {
        Route::get('/instructor/dashboard', [HomeController::class, 'instructorDashboard'])->name('instructor.dashboard');
        Route::get('/instructor/courses', [CourseController::class, 'instructorCourses'])->name('instructor.courses');
        Route::get('/instructor/reports/course-enrollments/{course}', [ReportController::class, 'courseEnrollments'])->name('instructor.reports.courseEnrollments');
        Route::get('/instructor/reports/course-revenue/{course}', [ReportController::class, 'courseRevenue'])->name('instructor.reports.courseRevenue');
        // Autres routes pour les instructeurs...
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        // users 
        Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::patch('/admin/users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    
        // Courses
        Route::get('/admin/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/admin/courses/{course}/edit', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::put('/admin/courses/{course}', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('admin.courses.update');
        Route::patch('/admin/courses/{course}/toggle-approval', [App\Http\Controllers\Admin\CourseController::class, 'toggleApproval'])->name('admin.courses.toggle-approval');
        Route::patch('/admin/courses/{course}/toggle-featured', [App\Http\Controllers\Admin\CourseController::class, 'toggleFeatured'])->name('admin.courses.toggle-featured');

        // Category
        Route::get('/admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Rôles permissions
    Route::get('/admin/roles', [App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('admin.roles.index');
    Route::post('/admin/roles', [App\Http\Controllers\Admin\RolePermissionController::class, 'createRole'])->name('admin.roles.create');
    Route::post('/admin/roles/{role}/permissions', [App\Http\Controllers\Admin\RolePermissionController::class, 'assignPermissions'])->name('admin.roles.assign-permissions');
    Route::post('/admin/users/assign-role', [App\Http\Controllers\Admin\RolePermissionController::class, 'assignRoleToUser'])->name('admin.users.assign-role');

    // admin function
    
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses.index');
    Route::post('/admin/users/{user}/change-role', [App\Http\Controllers\Admin\UserController::class, 'changeRole'])->name('admin.users.change-role');
    // Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
        // Autres routes pour les administrateurs...
    });

    Route::get('/components-showcase', function () {
        return view('components/components-showcase');
    })->name('components.showcase');

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Course routes
    Route::resource('courses', CourseController::class);
    Route::post('/courses/{course}/reviews', [CourseController::class, 'storeReview'])->name('courses.reviews.store');

    // Lesson routes
    Route::resource('courses.lessons', LessonController::class)->shallow();

    // Course routes
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

    // Enrollment routes
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'unenroll'])->name('courses.unenroll');

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Progress routes
    Route::post('/courses/{course}/lessons/{lesson}/complete', [ProgressController::class, 'completeLesson'])->name('lessons.complete');

    // Quiz routes
    Route::get('/lessons/{lesson}/quiz', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

    // Review routes
    Route::post('/courses/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/courses/{course}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/courses/{course}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Subscription routes
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
    Route::delete('/subscriptions', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');

    // Forum routes
    Route::get('/courses/{course}/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/courses/{course}/forum/{thread}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/courses/{course}/forum', [ForumController::class, 'storeThread'])->name('forum.storeThread');
    Route::post('/courses/{course}/forum/{thread}/posts', [ForumController::class, 'storePost'])->name('forum.storePost');

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    // Certificate routes
    Route::get('/courses/{course}/certificate', [CertificateController::class, 'generate'])->name('certificates.generate');
    Route::get('/certificates/verify', [CertificateController::class, 'verify'])->name('certificates.verify');

    // Search route
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Anoucements routes
    Route::resource('announcements', AnnouncementController::class);
    Route::post('/announcements/{announcement}/publish', [AnnouncementController::class, 'publish'])->name('announcements.publish');
   
});

// Payment routes (some might need to be outside auth middleware)
Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');
Route::get('/payments/success', [PaymentController::class, 'success'])->name('payments.success');
Route::get('/payments/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
Route::post('/webhook/payment', [PaymentController::class, 'webhook'])->name('webhook.payment');

require __DIR__ . '/auth.php';
