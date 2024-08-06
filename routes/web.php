<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Course routes
    Route::resource('courses', CourseController::class);

    // Lesson routes
    Route::resource('courses.lessons', LessonController::class)->shallow();

    // Enrollment routes
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'unenroll'])->name('courses.unenroll');

    // Progress routes
    Route::post('/courses/{course}/lessons/{lesson}/complete', [ProgressController::class, 'completeLesson'])->name('lessons.complete');

    // Review routes
    Route::post('/courses/{course}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/courses/{course}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/courses/{course}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Payment routes
    Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');
    Route::get('/payments/success', [PaymentController::class, 'success'])->name('payments.success');
    Route::get('/payments/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');

    // Quiz routes
    Route::get('/lessons/{lesson}/quiz', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

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

    // Subscription routes
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
    Route::delete('/subscriptions', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');

    // Report routes (for instructors and admins)
    Route::middleware(['can:view-reports'])->group(function () {
        Route::get('/reports/course-enrollments/{course}', [ReportController::class, 'courseEnrollments'])->name('reports.courseEnrollments');
        Route::get('/reports/course-revenue/{course}', [ReportController::class, 'courseRevenue'])->name('reports.courseRevenue');
        Route::get('/reports/instructor-dashboard', [ReportController::class, 'instructorDashboard'])->name('reports.instructorDashboard');
    });

    // Admin routes
    Route::middleware(['can:access-admin'])->group(function () {
        Route::get('/admin/dashboard', [ReportController::class, 'adminDashboard'])->name('admin.dashboard');
        // Add other admin routes as needed
    });
});

// Webhook for payment provider (not behind auth middleware)
Route::post('/webhook/payment', [PaymentController::class, 'webhook'])->name('webhook.payment');

require __DIR__.'/auth.php';
