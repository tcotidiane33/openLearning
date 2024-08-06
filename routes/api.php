<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ForumController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Courses
    Route::apiResource('courses', CourseController::class);
    Route::get('courses/{course}/lessons', [CourseController::class, 'lessons']);

    // Lessons
    Route::apiResource('lessons', LessonController::class)->except(['index']);

    // Enrollments
    Route::post('courses/{course}/enroll', [EnrollmentController::class, 'enroll']);
    Route::delete('courses/{course}/unenroll', [EnrollmentController::class, 'unenroll']);

    // Progress
    Route::post('lessons/{lesson}/complete', [ProgressController::class, 'completeLesson']);
    Route::get('courses/{course}/progress', [ProgressController::class, 'getCourseProgress']);

    // Quizzes
    Route::get('lessons/{lesson}/quiz', [QuizController::class, 'getQuiz']);
    Route::post('quizzes/{quiz}/submit', [QuizController::class, 'submitQuiz']);

    // Forum
    Route::get('courses/{course}/forum', [ForumController::class, 'getThreads']);
    Route::post('courses/{course}/forum', [ForumController::class, 'createThread']);
    Route::get('forum/threads/{thread}', [ForumController::class, 'getThread']);
    Route::post('forum/threads/{thread}/posts', [ForumController::class, 'createPost']);
});
